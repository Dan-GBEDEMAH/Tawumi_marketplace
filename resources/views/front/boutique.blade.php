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
                                <li><a href=""><i class="fa-solid fa-user"></i></a></li>
                                <li><a href=""><i class="fa-solid fa-heart"></i></a></li>
                                <li><a href=""><i class="fa-solid fa-eye"></i></a></li>
                            </ul>
                        </div>
                        <div class="pr-img">
                            <img src="{{ $produit->image }}" alt="{{ $produit->nom }}">
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