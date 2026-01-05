@extends('layouts.front')

@section('contentPage')
<!-- Favorite Section -->
<section class="favorite-sec py-5">
    <div class="container">
        <h2 class="title text-center mb-5">Mes Favoris</h2>
        
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
                <li class="breadcrumb-item active" aria-current="page">Favoris</li>
            </ol>
        </nav>

        @if($favoriteProducts->count() > 0)
        <div class="row">
            @foreach($favoriteProducts as $produit)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="product-card">
                    <div class="product-img">
                        <img src="{{ asset($produit->image) }}" alt="{{ $produit->nom }}" class="img-fluid">
                        <div class="product-overlay">
                            <button class="btn btn-light add-to-fav" data-product-id="{{ $produit->id }}">
                                <i class="fas fa-heart active"></i>
                            </button>
                            <a href="javascript:void(0)" class="btn btn-light view-product" data-product-id="{{ $produit->id }}">
                                <i class="fas fa-eye"></i>
                            </a>
                        </div>
                    </div>
                    <div class="product-info">
                        <h5 class="product-title">{{ $produit->nom }}</h5>

                        <p class="product-price">{{ $produit->prix }} Fcfa</p>
                        <p class="product-stock">
                            @if($produit->stock_disponible > 0)
                                <span class="text-success">En stock ({{ $produit->stock_disponible }})</span>
                            @else
                                <span class="text-danger">Épuisé</span>
                            @endif
                        </p>
                        <a href="{{ route('cart.add', ['id' => $produit->id]) }}" class="btn btn-success btn-sm">Ajouter au panier</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="empty-favorite text-center py-5">
            <i class="fas fa-heart text-muted fa-3x mb-3"></i>
            <h4>Votre liste de favoris est vide</h4>
            <p>Ajoutez des produits à vos favoris pour les retrouver facilement</p>
            <a href="{{ route('boutique') }}" class="btn btn-success">Découvrir les produits</a>
        </div>
        @endif
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle favorite toggle
    const favoriteButtons = document.querySelectorAll('.add-to-fav');
    
    favoriteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            const productId = this.getAttribute('data-product-id');
            const icon = this.querySelector('i');
            
            fetch('/favorite/toggle', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    product_id: productId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update icon based on action
                    if (data.action === 'added') {
                        icon.classList.add('active');
                        icon.style.color = '#e74c3c';
                    } else {
                        icon.classList.remove('active');
                        icon.style.color = '';
                    }
                    
                    // Optional: Show a subtle notification instead of alert
                    // alert(data.message);
                    
                    // Update favorite count in navbar
                    const favoriteBadge = document.getElementById('favorite-count');
                    favoriteBadge.textContent = data.count;
                    
                    // Show/hide badge based on count
                    if (data.count > 0) {
                        favoriteBadge.classList.remove('hidden');
                    } else {
                        favoriteBadge.classList.add('hidden');
                    }
                    
                    // Optionally reload the page to update the list
                    if (data.action === 'removed') {
                        location.reload();
                    }
                } else {
                    alert(data.message || 'Une erreur est survenue');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Une erreur est survenue lors de la mise à jour des favoris');
            });
        });
    });
});
</script>

<script>
// Product detail modal functionality
document.addEventListener('DOMContentLoaded', function() {
    const viewProductButtons = document.querySelectorAll('.view-product');
    const modal = document.createElement('div');
    modal.className = 'product-detail-modal';
    modal.innerHTML = `
        <div class="product-detail-content">
            <div class="product-detail-header">
                <h3>Détails du produit</h3>
                <button class="close-modal">&times;</button>
            </div>
            <div class="product-detail-body">
                <div class="text-center py-5">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Chargement...</span>
                    </div>
                    <p>Chargement des détails du produit...</p>
                </div>
            </div>
        </div>
    `;
    document.body.appendChild(modal);
    
    const closeModalButton = modal.querySelector('.close-modal');
    
    // Open modal when clicking on eye icon
    viewProductButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const productId = this.getAttribute('data-product-id');
            
            // Show modal
            modal.classList.add('active');
            
            // Fetch product details
            fetch('/product/detail', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ id: productId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const produit = data.produit;
                    const producteur = data.producteur;
                    
                    const isFavorite = data.is_favorite;
                    modal.querySelector('.product-detail-body').innerHTML = `
                        <div class="row">
                            <div class="col-md-6">
                                <img src="${produit.image.startsWith('http') ? produit.image : '/' + produit.image}" alt="${produit.nom}" class="img-fluid">
                            </div>
                            
                            <div class="col-md-6">
                                <div class="product-info">
                                    <h4>${produit.nom}</h4>
                                    
                                    <div class="product-price">
                                        <span class="current-price">${produit.prix} Fcfa</span>
                                        ${produit.est_en_promo ? `<span class="old-price">${produit.prix_original} Fcfa</span>` : ''}
                                    </div>
                                    
                                    <p class="product-description">${produit.description}</p>
                                    
                                    <div class="product-meta">
                                        <p><strong>Catégorie:</strong> ${produit.categorie ? produit.categorie.nom : 'Non spécifiée'}</p>
                                        <p><strong>Stock disponible:</strong> ${produit.stock_disponible}</p>
                                    </div>
                                    
                                    <div class="product-producer-info">
                                        <h5>Informations sur le producteur</h5>
                                        <p><i class="fa-solid fa-user"></i> <strong>Nom:</strong> ${producteur ? producteur.prenom + ' ' + producteur.nom : 'Producteur inconnu'}</p>
                                        <p><i class="fa-solid fa-location-dot"></i> <strong>Adresse:</strong> ${producteur ? producteur.addresse : 'Adresse inconnue'}</p>
                                        <p><i class="fa-solid fa-phone"></i> <strong>Téléphone:</strong> ${producteur ? producteur.telephone : 'Téléphone inconnu'}</p>
                                    </div>
                                    
                                    <div class="product-actions">
                                        <button class="btn btn-outline-danger add-to-fav" data-product-id="${produit.id}" onclick="toggleFavorite(event, ${produit.id})">
                                            <i class="fa-solid fa-heart ${isFavorite ? 'active' : ''}" ${isFavorite ? 'style="color: #e74c3c;"' : ''}></i>
                                            Favoris
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                modal.querySelector('.product-detail-body').innerHTML = `
                    <div class="alert alert-danger text-center">
                        <p>Erreur lors du chargement des détails du produit</p>
                    </div>
                `;
            });
        });
    });
    
    // Close modal when clicking on close button or outside the modal
    closeModalButton.addEventListener('click', function() {
        modal.classList.remove('active');
    });
    
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            modal.classList.remove('active');
        }
    });
    
    // Function to add to cart
    window.addToCart = function(event, productId) {
        event.preventDefault();
        
        fetch('/cart/add', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ produit_id: productId })
        })
        .then(async response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            
            // Check if response is JSON or HTML
            const contentType = response.headers.get('content-type');
            if (contentType && contentType.includes('application/json')) {
                return response.json();
            } else {
                // If not JSON, it's probably an HTML error page
                const text = await response.text();
                throw new Error('Server returned HTML instead of JSON: ' + text.substring(0, 200));
            }
        })
        .then(data => {
            if (data.success) {
                alert('Produit ajouté au panier avec succès!');
                
                // Update cart count in navbar
                if (data.cart_count !== undefined) {
                    const cartCountElement = document.querySelector('.cart-count');
                    if (cartCountElement) {
                        cartCountElement.textContent = data.cart_count;
                        cartCountElement.style.display = data.cart_count > 0 ? 'inline-block' : 'none';
                    }
                }
            } else {
                alert('Erreur: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Une erreur est survenue lors de l\'ajout au panier: ' + error.message);
        });
        
        return false;
    };
    
    // Function to toggle favorite
    window.toggleFavorite = function(event, productId) {
        event.preventDefault();
        
        fetch('/favorite/toggle', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ product_id: productId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update favorite count in navbar
                const favoriteBadge = document.getElementById('favorite-count');
                favoriteBadge.textContent = data.count;
                
                // Show/hide badge based on count
                if (data.count > 0) {
                    favoriteBadge.classList.remove('hidden');
                } else {
                    favoriteBadge.classList.add('hidden');
                }
                
                // Update the heart icon in the modal if it's open
                const heartIcon = document.querySelector(`.product-detail-body .add-to-fav[data-product-id="${productId}"] i`);
                if (heartIcon) {
                    if (data.action === 'added') {
                        heartIcon.classList.add('active');
                        heartIcon.style.color = '#e74c3c';
                    } else {
                        heartIcon.classList.remove('active');
                        heartIcon.style.color = '';
                    }
                }
                
                alert(data.message);
            } else {
                alert(data.message || 'Une erreur est survenue');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Une erreur est survenue lors de la mise à jour des favoris');
        });
    };
    
    // Function to get favorites from session
    window.getFavorites = function() {
        // This would typically get favorites from session or localStorage
        // For now, we'll return an empty object
        return {};
    };
    
    // Function to clear all favorites and reset count to 0
    window.clearFavorites = function() {
        if (confirm('Êtes-vous sûr de vouloir effacer tous vos favoris ?')) {
            fetch('/favorite/clear', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update favorite count in navbar
                    const favoriteBadge = document.getElementById('favorite-count');
                    if (favoriteBadge) {
                        favoriteBadge.textContent = data.count;
                        // Hide the badge if count is 0
                        if (data.count === 0) {
                            favoriteBadge.classList.add('hidden');
                        }
                    }
                    alert(data.message);
                } else {
                    alert(data.message || 'Une erreur est survenue');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Une erreur est survenue lors de l\'effacement des favoris');
            });
        }
    };
});
</script>

@endsection