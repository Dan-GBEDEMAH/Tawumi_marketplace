@extends('layouts.front')


@section('contentPage')
<div class="boutique-page">


    <!-- Banner Section -->
    <section class="banner-sec banner-bg-image-2">
            <div class="banner-overlay"></div>
        <!-- Overlay for the banner background -->
        <div class="container" style="position: relative; z-index: 1;">
            <div class="header-main-text">
                <h5>Offre exclusive 20% de réduction</h5>
                <h1>Découvrez nos produits de qualité</h1>
                <p>Ne manquez pas cette offre exclusive : 20% de réduction sur nos produits de qualité.
                   Une occasion parfaite pour acheter mieux tout en faisant des économies!
                </p>
                <div class="nav-btn mt-4"><a href="{{ route('checkout') }}">Acheter maintenant</a></div>
            </div>
        </div>
    </section>

    <!-- Category Section -->
    <section class="item-header-sec py-5">
        <div class="container">
            <div class="item-slider text-center">
                <div class="items-header">
                    <img src="{{ asset('assets/images/icon-food-1.png') }}" alt="">
                    <h4>Légumes</h4>
                </div>
                <div class="items-header">
                    <img src="{{ asset('assets/images/icon-food-2.png') }}" alt="">
                    <h4>Fruits</h4>
                </div>
                <div class="items-header">
                    <img src="{{ asset('assets/images/icon-food-3.png') }}" alt="">
                    <h4>Tubercules</h4>
                </div>
                <div class="items-header">
                    <img src="{{ asset('assets/images/icon-food-4.png') }}" alt="">
                    <h4>Céréales</h4>
                </div>
                <div class="items-header">
                    <img src="{{ asset('assets/images/icon-food-5.png') }}" alt="">
                    <h4>Plantes</h4>
                </div>
            </div>
        </div>
    </section>

    <!-- Product Section -->
    <section class="product-sec pb-5">
        <div class="container">
            <h2 class="title text-center">Nos Produits</h2>
            
            <div class="row mt-5">
                @if(isset($produits) && $produits->count() > 0)
                    @foreach($produits as $produit)
                <div class="col-md-3 mb-4">
                    <div class="product-box">
                        <div class="pr-icons">
                            <ul>
                                
                                <li><a href="javascript:void(0)" class="add-to-fav" data-product-id="{{ $produit->id }}">
                                    <i class="fa-solid fa-heart {{ in_array($produit->id, session()->get('favorites', [])) ? 'active' : '' }}" 
                                       @if(in_array($produit->id, session()->get('favorites', []))) style="color: #e74c3c;" @endif></i>
                                </a></li>
                                <li><a href="javascript:void(0)" class="view-product" data-product-id="{{ $produit->id }}">
                                    <i class="fa-solid fa-eye"></i>
                                </a></li>
                            </ul>
                        </div>
                        <div class="pr-img">
                            <img src="{{ $produit->image }}" alt="{{ $produit->nom }}">
                            <!-- Badges d'offres spéciales -->
                            <div class="product-badges">
                                @if($produit->est_offre_weekend)
                                    <span class="badge badge-weekend">Week-end</span>
                                @elseif($produit->est_gratuit)
                                    <span class="badge badge-gratuit">Gratuit</span>
                                @elseif($produit->est_nouveaute)
                                    <span class="badge badge-nouveaute">Nouveauté</span>
                                @elseif($produit->est_offre && $produit->reduction)
                                    <span class="badge badge-offre">-{{ $produit->reduction }}%</span>
                                @endif
                            </div>
                        </div>
                        <div class="pr-text">
                            <h6>En stock</h6>
                            <h5>{{ $produit->nom }}</h5>
                            
                            <span class="price">{{ $produit->prix }} Fcfa</span>
                            <div class="cart-btn">
                                <form method="POST" action="{{ route('cart.add') }}" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="produit_id" value="{{ $produit->id }}">
                                    <button type="submit" class="btn btn-link p-0 text-decoration-none border-0 bg-transparent">
                                        Ajouter au panier <i class="fa-solid fa-cart-shopping"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                    @endforeach
                @else
                <div class="col-12">
                    <p class="text-center">Aucun produit disponible actuellement.</p>
                </div>
                @endif
            </div>
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
                        this.setAttribute('title', 'Retirer des favoris');
                    } else {
                        icon.classList.remove('active');
                        icon.style.color = '';
                        this.setAttribute('title', 'Ajouter aux favoris');
                    }
                    
                    // Update favorite count in navbar
                    const favoriteBadge = document.getElementById('favorite-count');
                    favoriteBadge.textContent = data.count;
                    
                    // Show/hide badge based on count
                    if (data.count > 0) {
                        favoriteBadge.classList.remove('hidden');
                    } else {
                        favoriteBadge.classList.add('hidden');
                    }
                    
                    // Optional: Show a subtle notification instead of alert
                    // alert(data.message);
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
});
</script>

    <!-- Featured Section -->
    <section class="featured-sec py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="featured-flex">
                        <i class="fa-solid fa-box"></i>
                        <p>Des produits frais tous les jours</p>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="featured-flex">
                        <i class="fa-solid fa-truck"></i>
                        <p>Livraison gratuite</p>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="featured-flex">
                        <i class="fa-solid fa-percent"></i>
                        <p>Meilleur prix du marché</p>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="featured-flex">
                        <i class="fa-solid fa-box"></i>
                        <p>Livraison en toute sécurité</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Producer Showcase Section -->
    <section class="producer-showcase py-5 bg-light">
        <div class="container">
            <h2 class="title text-center mb-5">Nos Producteurs</h2>
            <div class="row">
                <!-- Producer 1 -->
                <div class="col-md-4 mb-4">
                    <div class="producer-card text-center p-4 bg-white rounded shadow-sm h-100">
                        <div class="producer-img mx-auto mb-3">
                            <img src="{{ asset('assets/images/prod3.jpg') }}" alt="Producteur KOKOU" class="rounded-circle" width="100" height="100">
                        </div>
                        <h4 class="producer-name">Producteur KOKOU</h4>
                        <p class="producer-farm text-success fw-bold mb-2">Ferme: Mawunyo</p>
                        <div class="rating mb-2">
                            <i class="fa-solid fa-star text-warning"></i>
                            <i class="fa-solid fa-star text-warning"></i>
                            <i class="fa-solid fa-star text-warning"></i>
                            <i class="fa-solid fa-star text-warning"></i>
                            <i class="fa-solid fa-star text-warning"></i>
                        </div>
                        <p class="producer-location text-muted mb-2"><i class="fa-solid fa-location-dot"></i> Mawunyo, Togo</p>
                        <p class="producer-desc">Production de légumes et fruits biologiques de qualité supérieure. Spécialiste des tomates et poivrons.</p>
                        <div class="producer-products">
                            <span class="badge bg-success me-1">Tomates</span>
                            <span class="badge bg-success me-1">Poivrons</span>
                            <span class="badge bg-success">Laitues</span>
                        </div>
                    </div>
                </div>
                
                <!-- Producer 2 -->
                <div class="col-md-4 mb-4">
                    <div class="producer-card text-center p-4 bg-white rounded shadow-sm h-100">
                        <div class="producer-img mx-auto mb-3">
                            <img src="{{ asset('assets/images/prod2.jpg') }}" alt="Productrice Adjo" class="rounded-circle" width="100" height="100">
                        </div>
                        <h4 class="producer-name">Productrice Adjo</h4>
                        <p class="producer-farm text-success fw-bold mb-2">Ferme: Agbétiko</p>
                        <div class="rating mb-2">
                            <i class="fa-solid fa-star text-warning"></i>
                            <i class="fa-solid fa-star text-warning"></i>
                            <i class="fa-solid fa-star text-warning"></i>
                            <i class="fa-solid fa-star text-warning"></i>
                            <i class="fa-regular fa-star text-warning"></i>
                        </div>
                        <p class="producer-location text-muted mb-2"><i class="fa-solid fa-location-dot"></i> Agbétiko, Togo</p>
                        <p class="producer-desc">Spécialisée dans les produits laitiers artisanaux et les herbes aromatiques. Produits 100% bio.</p>
                        <div class="producer-products">
                            <span class="badge bg-success me-1">Fromage</span>
                            <span class="badge bg-success me-1">Yaourt</span>
                            <span class="badge bg-success">plantes médécinal</span>
                        </div>
                    </div>
                </div>
                
                <!-- Producer 3 -->
                <div class="col-md-4 mb-4">
                    <div class="producer-card text-center p-4 bg-white rounded shadow-sm h-100">
                        <div class="producer-img mx-auto mb-3">
                            <img src="{{ asset('assets/images/prod1.jpg') }}" alt="Producteur Koffi" class="rounded-circle" width="100" height="100">
                        </div>
                        <h4 class="producer-name">Producteur Koffi</h4>
                        <p class="producer-farm text-success fw-bold mb-2">Ferme: Sokode</p>
                        <div class="rating mb-2">
                            <i class="fa-solid fa-star text-warning"></i>
                            <i class="fa-solid fa-star text-warning"></i>
                            <i class="fa-solid fa-star text-warning"></i>
                            <i class="fa-solid fa-star text-warning"></i>
                            <i class="fa-solid fa-star-half-stroke text-warning"></i>
                        </div>
                        <p class="producer-location text-muted mb-2"><i class="fa-solid fa-location-dot"></i> Sokode, Togo</p>
                        <p class="producer-desc">Éleveur de volailles et production de miel biologique. Plante médécinal naturel et miel pur.</p>
                        <div class="producer-products">
                            <span class="badge bg-success me-1">Poulet</span>
                            <span class="badge bg-success me-1">Miel</span>
                            <span class="badge bg-success">Céréales</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


   
        </div>
    </section>
    </div>

@endsection