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
            <div class="offer-category">
                <button class="category-btn active">Toutes les offres</button>
                <button class="category-btn">Réductions</button>
                <button class="category-btn">Produits gratuits</button>
                <button class="category-btn">Offres limitées</button>
                <button class="category-btn">Week-end</button>
            </div>

            <h2 class="section-title">Offres du Moment</h2>

            <div class="row">
                @if(isset($produits) && $produits->count() > 0)
                    @foreach($produits as $produit)
                <div class="col-lg-4 col-md-6">
                    <div class="offer-card">
                        <span class="offer-badge sale">-{{ $produit->reduction }}%</span>
                        <div class="offer-img">
                            <img src="{{ asset($produit->image) }}" alt="{{ $produit->nom }}">
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
                                        <div class="timer-value">02</div>
                                        <div class="timer-label">JOURS</div>
                                    </div>
                                    <div class="timer-box">
                                        <div class="timer-value">15</div>
                                        <div class="timer-label">HEURES</div>
                                    </div>
                                    <div class="timer-box">
                                        <div class="timer-value">30</div>
                                        <div class="timer-label">MIN</div>
                                    </div>
                                    <div class="timer-box">
                                        <div class="timer-value">45</div>
                                        <div class="timer-label">SEC</div>
                                    </div>
                                </div>
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

 
@endsection