@extends('layouts.front')

@section('contentPage')

<!-- Banner Section -->
    <section class="banner-sec banner-bg-image-3">
        <div class="banner-overlay"></div>
        <div class="container" style="position: relative; z-index: 1;">
            <div class="header-main-text">
                <h5>Nouveautés de la semaine</h5>
                <h1>Découvrez nos dernières arrivées</h1>
                <p>Ne manquez pas nos dernières nouveautés sélectionnées avec soin.
                   Des produits de qualité, pensés pour répondre à vos besoins et à vos envies.
                </p>
                <div class="nav-btn mt-4"><a href="">Voir toutes les nouveautés</a></div>
            </div>
        </div>
    </section>

    <!-- New Arrivals Section -->
    <section class="product-sec pb-5">
        <div class="container">
            <h2 class="title text-center">Nouveaux Produits</h2>
            
            <div class="row mt-5">
                @if(isset($produits) && $produits->count() > 0)
                    @foreach($produits as $produit)
                <div class="col-md-3 mb-4">
                    <div class="product-box">
                        <span class="product-badge new">Nouveau</span>
                        <div class="pr-icons">
                            <ul>
                                <li><a href=""><i class="fa-solid fa-user"></i></a></li>
                                <li><a href=""><i class="fa-solid fa-heart"></i></a></li>
                                <li><a href=""><i class="fa-solid fa-eye"></i></a></li>
                            </ul>
                        </div>
                        <div class="pr-img">
                            <img src="{{ asset($produit->image) }}" alt="{{ $produit->nom }}">
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

    <!-- Weekend Specials -->
    <section class="weekend-sec py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="weekend-main weekend-bg-3">
                        <div class="weekend-text">
                            <h5>Réduction du week-end 30%</h5>
                            <h3>Fruits de saison</h3>
                            <div class="nav-btn mt-4"><a href="{{ route('checkout') }}">Acheter maintenant</a></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="weekend-main weekend-bg-2">
                        <div class="weekend-text">
                            <h5>Réduction du week-end 25%</h5>
                            <h3>Légumes bio</h3>
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


    
@endsection