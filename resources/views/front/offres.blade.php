@extends('layouts.front')

@section('contentPage')


  
    <!-- Offer Banner -->
    <section class="offer-banner">
        <div class="container">
            <h1>Offres Spéciales</h1>
            <p>Découvrez nos meilleures offres et promotions du moment</p>
        </div>
    </section>

    <!-- Offer Categories -->
    <section class="py-5">
        <div class="container">
            <div class="offer-category d-flex justify-content-center mb-4">
                <button class="category-btn active me-2" data-category="all">Toutes les offres</button>
                <button class="category-btn me-2" data-category="reduction">Réductions</button>
                <button class="category-btn me-2" data-category="gratuit">Produits gratuits</button>
                <button class="category-btn me-2" data-category="limitee">Offres limitées</button>
                <button class="category-btn" data-category="weekend">Week-end</button>
            </div>

            <div class="row">
                @if(isset($produits) && $produits->count() > 0)
                    @foreach($produits as $produit)
                <div class="col-lg-4 col-md-6">
                    <div class="offer-card" data-category="{{ $produit->est_gratuit ? 'gratuit' : ($produit->est_offre_weekend ? 'weekend' : ($produit->est_offre ? 'reduction' : 'limitee')) }}">
                        <div class="pr-icons">
                            <ul>
                                <li><a href=""><i class="fa-solid fa-user"></i></a></li>
                                <li><a href="javascript:void(0)" class="add-to-fav" data-product-id="{{ $produit->id }}">
                                    <i class="fa-solid fa-heart {{ in_array($produit->id, session()->get('favorites', [])) ? 'active' : '' }}" 
                                       @if(in_array($produit->id, session()->get('favorites', []))) style="color: #e74c3c;" @endif></i>
                                </a></li>
                                <li><a href="javascript:void(0)" class="view-product" data-product-id="{{ $produit->id }}">
                                    <i class="fa-solid fa-eye"></i>
                                </a></li>
                            </ul>
                        </div>
                        <div class="offer-img">
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
                        <div class="offer-content">
                            <h3>{{ $produit->nom }}</h3>

                            <div class="offer-price">
                                @php
                                    $prixReduit = $produit->prix * (1 - $produit->reduction / 100);
                                @endphp
                                <span class="current-price">{{ number_format($prixReduit, 0, '', '') }} Fcfa</span>
                                <span class="old-price">{{ $produit->prix }} Fcfa</span>
                                <span class="discount-percent">-{{ $produit->reduction }}%</span>
                            </div>
                            <div class="offer-timer">
                                <div class="timer-title">Offre valable jusqu'à :</div>
                                <div class="timer-flex">
                                    <div class="timer-box">
                                        <div class="timer-value days">--</div>
                                        <div class="timer-label">JOURS</div>
                                    </div>
                                    <div class="timer-box">
                                        <div class="timer-value hours">--</div>
                                        <div class="timer-label">HEURES</div>
                                    </div>
                                    <div class="timer-box">
                                        <div class="timer-value minutes">--</div>
                                        <div class="timer-label">MIN</div>
                                    </div>
                                    <div class="timer-box">
                                        <div class="timer-value seconds">--</div>
                                        <div class="timer-label">SEC</div>
                                    </div>
                                </div>
                                <input type="hidden" class="end-date" value="{{ $produit->date_fin_offre ? $produit->date_fin_offre->toISOString() : ($produit->created_at->addDays(7))->toISOString() }}">
                            </div>
                            <div class="cart-btn">
                                <form method="POST" action="{{ route('cart.add') }}" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="produit_id" value="{{ $produit->id }}">
                                    <button type="submit" class="cta-button">
                                        Ajouter au panier
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

    <!-- Weekend Specials -->
    <section class="weekend-sec py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="weekend-main weekend-bg-3">
                        <div class="weekend-text">
                            <h5>Réduction du week-end 40%</h5>
                            <h3>Mélange surprise de cacahuètes et pois chiches</h3>
                            <div class="nav-btn mt-4"><a href="{{ route('checkout') }}">Acheter maintenant</a></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="weekend-main weekend-bg-2">
                        <div class="weekend-text">
                            <h5>Réduction du week-end 40%</h5>
                            <h3>Cacahuètes salées</h3>
                            <div class="nav-btn mt-4"><a href="{{ route('checkout') }}">Acheter maintenant</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
        
    // Filter functionality for offer categories
    const categoryButtons = document.querySelectorAll('.category-btn');
    const offerProducts = document.querySelectorAll('.offer-card');
        
    categoryButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Remove active class from all buttons
            categoryButtons.forEach(btn => btn.classList.remove('active'));
                
            // Add active class to clicked button
            this.classList.add('active');
                
            const category = this.getAttribute('data-category');
                
            // Show/hide products based on category
            offerProducts.forEach(product => {
                const productCategory = product.getAttribute('data-category');
                    
                if (category === 'all' || productCategory === category) {
                    product.closest('.col-lg-4').style.display = 'block';
                } else {
                    product.closest('.col-lg-4').style.display = 'none';
                }
            });
        });
    });
        
    // Initialize countdown timers for products
    function initializeCountdownTimers() {
        const offerTimers = document.querySelectorAll('.offer-timer');
            
        offerTimers.forEach(timer => {
            const endDateInput = timer.querySelector('.end-date');
            if (endDateInput) {
                const endDate = new Date(endDateInput.value);
                    
                // Update timer immediately and then every second
                updateCountdown(timer, endDate);
                setInterval(() => {
                    updateCountdown(timer, endDate);
                }, 1000);
            }
        });
    }
        
    // Function to update the countdown
    function updateCountdown(timer, endDate) {
        const now = new Date();
        const timeDifference = endDate - now;
            
        if (timeDifference <= 0) {
            // If the timer has ended
            timer.querySelector('.days').textContent = '00';
            timer.querySelector('.hours').textContent = '00';
            timer.querySelector('.minutes').textContent = '00';
            timer.querySelector('.seconds').textContent = '00';
            return;
        }
            
        const days = Math.floor(timeDifference / (1000 * 60 * 60 * 24));
        const hours = Math.floor((timeDifference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((timeDifference % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((timeDifference % (1000 * 60)) / 1000);
            
        timer.querySelector('.days').textContent = days.toString().padStart(2, '0');
        timer.querySelector('.hours').textContent = hours.toString().padStart(2, '0');
        timer.querySelector('.minutes').textContent = minutes.toString().padStart(2, '0');
        timer.querySelector('.seconds').textContent = seconds.toString().padStart(2, '0');
    }
        
    // Initialize countdown timers when the page loads
    initializeCountdownTimers();
        
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
                        
                    // Initialize countdown timers for products
                    initializeCountdownTimers();
                        
                    const isFavorite = data.is_favorite;
                    modal.querySelector('.product-detail-body').innerHTML = `
                        <div class="row">
                            <div class="col-md-6">
                                <img src="${produit.image}" alt="${produit.nom}" class="img-fluid">
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