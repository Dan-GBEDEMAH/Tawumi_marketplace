@extends('layouts.front')

@section('contentPage')
<div class="index-page">
    
   
         <!-- lets now create a banner  -->


        <section class="banner-sec banner-bg-image">

            <div class="container">
                <div class="header-main-text">
                    <h5>Offre exclusive -20% de réduction</h5>
                    <h1>Acheter local soutient l'économie locale</h1>
                    <p>Nous vous proposons une nouvelle façon de consommer, de vendre avec des produits sains,
                        naturels et responsables. Profitez de 20% de réduction sur une sélection exclusive!
                    </p>    
                    <div class="nav-btn mt-4"><a href="">Acheter maintenant</a></div>
                </div>
            </div>
        </section>

        <!-- lets make category  -->

       <section class="item-header-sec py-5">
    <div class="container">
        <div class="item-slider text-center">
            <div class="items-header">
                <img src="{{ asset('assets/images/icon-food-1.png') }}" alt="Légumes">
                <h4>Légumes</h4>
            </div>
            <div class="items-header">
                <img src="{{ asset('assets/images/icon-food-2.png') }}" alt="Fruits">
                <h4>Fruits</h4>
            </div>
            <div class="items-header">
                <img src="{{ asset('assets/images/icon-food-3.png') }}" alt="Tubercules">
                <h4>Tubercules</h4>
            </div>
            <div class="items-header">
                <img src="{{ asset('assets/images/icon-food-4.png') }}" alt="Céréales">
                <h4>Céréales</h4>
            </div>
            <div class="items-header">
                <img src="{{ asset('assets/images/icon-food-5.png') }}" alt="Plantes">
                <h4>Plantes</h4>
            </div>
        </div>
    </div>
</section>

<!-- Section produits mis en avant -->
<section class="product-sec pb-5">
    <div class="container">
        <h2 class="title text-center">Produits mis en avant</h2>
        <div class="product-slider mt-5">
            <div class="row">
                @if(isset($produits_en_avant) && $produits_en_avant->count() > 0)
                    @foreach($produits_en_avant as $produit)
                    <div class="col-md-3 mb-4">
                        <div class="product-box">
                            <div class="pr-icons">
                                <ul>
                                    <li><a href="#"><i class="fa-solid fa-user"></i></a></li>
                                    <li><a href="#"><i class="fa-solid fa-heart"></i></a></li>
                                    <li><a href="#"><i class="fa-solid fa-eye"></i></a></li>
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
                        <p class="text-center">Aucun produit mis en avant actuellement.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Section offres fraîches -->
<section class="product-item-sec">
    <div class="container">
        <h2 class="title text-center">Nouvelles offres fraîches</h2>
        <div class="row mt-5 align-items-center">
            <div class="col-lg-4">
                <div class="product-timer">
                    <img src="{{ asset('assets/images/back-img-2.png') }}" alt="Offres">
                    <div class="product-time">
                        <div class="pr-time-text">
                            <h4 class="text-white">Offres de la semaine</h4>
                        </div>
                        <div class="timer-flex">
                            <ul>
                                <li>25 <span>JOURS</span></li>
                                <li>16 <span>HRS</span></li>
                                <li>20 <span>MIN</span></li>
                                <li>12 <span>SEC</span></li>
                            </ul>
                        </div>
                        <p class="text-white mt-2">Dépêchez-vous ! Profitez de nos offres exceptionnelles avant la fin du compte à rebours. Des réductions limitées dans le temps à ne pas manquer!</p>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <!-- Produit offre 1 -->
                    <div class="col-md-4">
                        <div class="product-box">
                            <div class="pr-icons">
                                <ul>
                                    <li><a href="#"><i class="fa-solid fa-user"></i></a></li>
                                    <li><a href="#"><i class="fa-solid fa-heart"></i></a></li>
                                    <li><a href="#"><i class="fa-solid fa-eye"></i></a></li>
                                </ul>
                            </div>
                            <div class="pr-img">
                                <img src="{{ asset('assets/images/product-img.png') }}" alt="Concombre">
                            </div>
                            <div class="pr-text">
                                <h6>En stock</h6>
                                <h5>Concombre</h5>
                                <span class="price">500 Fcfa</span>
                                <div class="cart-btn"><a href="#">Ajouter au panier <i class="fa-solid fa-cart-shopping"></i></a></div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Produit offre 2 -->
                    <div class="col-md-4">
                        <div class="product-box">
                            <div class="pr-icons">
                                <ul>
                                    <li><a href="#"><i class="fa-solid fa-user"></i></a></li>
                                    <li><a href="#"><i class="fa-solid fa-heart"></i></a></li>
                                    <li><a href="#"><i class="fa-solid fa-eye"></i></a></li>
                                </ul>
                            </div>
                            <div class="pr-img">
                                <img src="{{ asset('assets/images/product-img-1.png') }}" alt="Taro">
                            </div>
                            <div class="pr-text">
                                <h6>En stock</h6>
                                <h5>Taro</h5>
                                <span class="price">200 Fcfa</span>
                                <div class="cart-btn"><a href="#">Ajouter au panier <i class="fa-solid fa-cart-shopping"></i></a></div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Produit offre 3 -->
                    <div class="col-md-4">
                        <div class="product-box">
                            <div class="pr-icons">
                                <ul>
                                    <li><a href="#"><i class="fa-solid fa-user"></i></a></li>
                                    <li><a href="#"><i class="fa-solid fa-heart"></i></a></li>
                                    <li><a href="#"><i class="fa-solid fa-eye"></i></a></li>
                                </ul>
                            </div>
                            <div class="pr-img">
                                <img src="{{ asset('assets/images/product-img-2.png') }}" alt="Épinard">
                            </div>
                            <div class="pr-text">
                                <h6>En stock</h6>
                                <h5>Épinard</h5>
                                <span class="price">220 Fcfa</span>
                                <div class="cart-btn"><a href="#">Ajouter au panier <i class="fa-solid fa-cart-shopping"></i></a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section weekend -->
<section class="weekend-sec py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="weekend-main weekend-bg-3">
                    <div class="weekend-text">
                        <h5>Réduction du week-end 40%</h5>
                        <h3>Mélange surprise de cacahuètes et pois chiches</h3>
                        <div class="nav-btn mt-4"><a href="#">Acheter maintenant</a></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="weekend-main weekend-bg-2">
                    <div class="weekend-text">
                        <h5>Réduction du week-end 40%</h5>
                        <h3>Cacahuètes salées</h3>
                        <div class="nav-btn mt-4"><a href="#">Acheter maintenant</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section nouveautés -->
<section class="product-sec pb-5">
    <div class="container">
        <h2 class="title text-center">Nouveautés aujourd'hui</h2>
        <div class="row mt-5">
            <div class="col-lg-4">
                <div class="product-timer">
                    <img src="{{ asset('assets/images/item-time-2.jpg') }}" alt="Offres">
                    <div class="product-time">
                        <div class="pr-time-text">
                            <h4 class="text-white">Offres de la semaine</h4>
                        </div>
                        <div class="timer-flex">
                            <ul>
                                <li>25 <span>JOURS</span></li>
                                <li>16 <span>HRS</span></li>
                                <li>20 <span>MIN</span></li>
                                <li>12 <span>SEC</span></li>
                            </ul>
                        </div>
                        <p class="text-white mt-2">Des produits de qualité sélectionnés avec soin, proposés à prix réduit pendant une durée limitée cette semaine!</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="product-slider-2 mt-5">
                    <!-- Produit nouveauté 1 -->
                    <div class="col-md-3 mb-4">
                        <div class="product-box">
                            <div class="pr-icons">
                                <ul>
                                    <li><a href="#"><i class="fa-solid fa-user"></i></a></li>
                                    <li><a href="#"><i class="fa-solid fa-heart"></i></a></li>
                                    <li><a href="#"><i class="fa-solid fa-eye"></i></a></li>
                                </ul>
                            </div>
                            <div class="pr-img">
                                <img src="{{ asset('assets/images/product-img-6.png') }}" alt="Banane">
                            </div>
                            <div class="pr-text">
                                <h6>En stock</h6>
                                <h5>Banane</h5>
                                <span class="price">320 Fcfa</span>
                                <div class="cart-btn"><a href="#">Ajouter au panier <i class="fa-solid fa-cart-shopping"></i></a></div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Produit nouveauté 2 -->
                    <div class="col-md-3 mb-4">
                        <div class="product-box">
                            <div class="pr-icons">
                                <ul>
                                    <li><a href="#"><i class="fa-solid fa-user"></i></a></li>
                                    <li><a href="#"><i class="fa-solid fa-heart"></i></a></li>
                                    <li><a href="#"><i class="fa-solid fa-eye"></i></a></li>
                                </ul>
                            </div>
                            <div class="pr-img">
                                <img src="{{ asset('assets/images/product-img-1.png') }}" alt="Taro">
                            </div>
                            <div class="pr-text">
                                <h6>En stock</h6>
                                <h5>Taro</h5>
                                <span class="price">520 Fcfa</span>
                                <div class="cart-btn"><a href="#">Ajouter au panier <i class="fa-solid fa-cart-shopping"></i></a></div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Produit nouveauté 3 -->
                    <div class="col-md-3 mb-4">
                        <div class="product-box">
                            <div class="pr-icons">
                                <ul>
                                    <li><a href="#"><i class="fa-solid fa-user"></i></a></li>
                                    <li><a href="#"><i class="fa-solid fa-heart"></i></a></li>
                                    <li><a href="#"><i class="fa-solid fa-eye"></i></a></li>
                                </ul>
                            </div>
                            <div class="pr-img">
                                <img src="{{ asset('assets/images/product-img-2.png') }}" alt="Épinard">
                            </div>
                            <div class="pr-text">
                                <h6>En stock</h6>
                                <h5>Épinard</h5>
                                <span class="price">220 Fcfa</span>
                                <div class="cart-btn"><a href="#">Ajouter au panier <i class="fa-solid fa-cart-shopping"></i></a></div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Produit nouveauté 4 -->
                    <div class="col-md-3 mb-4">
                        <div class="product-box">
                            <div class="pr-icons">
                                <ul>
                                    <li><a href="#"><i class="fa-solid fa-user"></i></a></li>
                                    <li><a href="#"><i class="fa-solid fa-heart"></i></a></li>
                                    <li><a href="#"><i class="fa-solid fa-eye"></i></a></li>
                                </ul>
                            </div>
                            <div class="pr-img">
                                <img src="{{ asset('assets/images/product-img-3.png') }}" alt="Lait">
                            </div>
                            <div class="pr-text">
                                <h6>En stock</h6>
                                <h5>Lait</h5>
                                <span class="price">220 Fcfa</span>
                                <div class="cart-btn"><a href="#">Ajouter au panier <i class="fa-solid fa-cart-shopping"></i></a></div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Produit nouveauté 5 -->
                    <div class="col-md-3 mb-4">
                        <div class="product-box">
                            <div class="pr-icons">
                                <ul>
                                    <li><a href="#"><i class="fa-solid fa-user"></i></a></li>
                                    <li><a href="#"><i class="fa-solid fa-heart"></i></a></li>
                                    <li><a href="#"><i class="fa-solid fa-eye"></i></a></li>
                                </ul>
                            </div>
                            <div class="pr-img">
                                <img src="{{ asset('assets/images/iten-1.jpg') }}" alt="Citron vert">
                            </div>
                            <div class="pr-text">
                                <h6>En stock</h6>
                                <h5>Citron vert</h5>
                                <span class="price">400 Fcfa</span>
                                <div class="cart-btn"><a href="#">Ajouter au panier <i class="fa-solid fa-cart-shopping"></i></a></div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Produit nouveauté 6 -->
                    <div class="col-md-3 mb-4">
                        <div class="product-box">
                            <div class="pr-icons">
                                <ul>
                                    <li><a href="#"><i class="fa-solid fa-user"></i></a></li>
                                    <li><a href="#"><i class="fa-solid fa-heart"></i></a></li>
                                    <li><a href="#"><i class="fa-solid fa-eye"></i></a></li>
                                </ul>
                            </div>
                            <div class="pr-img">
                                <img src="{{ asset('assets/images/iten-2.jpg') }}" alt="Oignon">
                            </div>
                            <div class="pr-text">
                                <h6>En stock</h6>
                                <h5>Oignon</h5>
                                <span class="price">300 Fcfa</span>
                                <div class="cart-btn"><a href="#">Ajouter au panier <i class="fa-solid fa-cart-shopping"></i></a></div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Produit nouveauté 7 -->
                    <div class="col-md-3 mb-4">
                        <div class="product-box">
                            <div class="pr-icons">
                                <ul>
                                    <li><a href="#"><i class="fa-solid fa-user"></i></a></li>
                                    <li><a href="#"><i class="fa-solid fa-heart"></i></a></li>
                                    <li><a href="#"><i class="fa-solid fa-eye"></i></a></li>
                                </ul>
                            </div>
                            <div class="pr-img">
                                <img src="{{ asset('assets/images/iten-3.jpg') }}" alt="Brocoli">
                            </div>
                            <div class="pr-text">
                                <h6>En stock</h6>
                                <h5>Brocoli</h5>
                                <span class="price">220 Fcfa</span>
                                <div class="cart-btn"><a href="#">Ajouter au panier <i class="fa-solid fa-cart-shopping"></i></a></div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Produit nouveauté 8 -->
                    <div class="col-md-3 mb-4">
                        <div class="product-box">
                            <div class="pr-icons">
                                <ul>
                                    <li><a href="#"><i class="fa-solid fa-user"></i></a></li>
                                    <li><a href="#"><i class="fa-solid fa-heart"></i></a></li>
                                    <li><a href="#"><i class="fa-solid fa-eye"></i></a></li>
                                </ul>
                            </div>
                            <div class="pr-img">
                                <img src="{{ asset('assets/images/iten-4.jpg') }}" alt="Poivron">
                            </div>
                            <div class="pr-text">
                                <h6>En stock</h6>
                                <h5>Poivron</h5>
                                <span class="price">250 Fcfa</span>
                                <div class="cart-btn"><a href="#">Ajouter au panier <i class="fa-solid fa-cart-shopping"></i></a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section avantages -->
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

<!-- Section message -->
<section class="bg-sec mt-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-6"></div>
            <div class="col-lg-6">
                <div class="bg-text">
                    <h3>Mangez sain, restez jeune, sentez-vous bien !</h3>
                    <p>Adopter une alimentation saine, c'est investir dans votre santé au quotidien. Des produits naturels et de qualité contribuent à renforcer votre énergie, préserver votre vitalité et améliorer votre bien-être général!</p>
                    <p>Nous sélectionnons avec soin des aliments riches en nutriments essentiels, pensés pour accompagner un mode de vie équilibré et durable, à tout âge.</p>
                    <div class="nav-btn mt-4"><a href="Boutique.html">Acheter maintenant</a></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section blog -->
<section class="blog-sec py-5">
    <div class="container">
        <h2 class="title text-center">Actualités et articles</h2>
        <div class="row mt-5">
            <div class="col-md-4">
                <div class="blog-box">
                    <div class="blog-img"><img src="{{ asset('assets/images/blog-1.jpg') }}" alt="Blog 1"></div>
                    <div class="blog-text">
                        <h3>Les meilleures façons de réduire votre graisse abdominale avec une alimentation saine !</h3>
                        <p>Découvrez des méthodes simples et efficaces pour diminuer la graisse abdominale. Apprenez à intégrer des aliments riches en fibres, protéines et nutriments essentiels dans vos repas quotidiens pour des résultats durables!</p>
                        <div class="blog-arrow">
                            <a href="{{ route('blogs') }}">Lire la suite <i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="blog-box">
                    <div class="blog-img"><img src="{{ asset('assets/images/blog-2.jpg') }}" alt="Blog 2"></div>
                    <div class="blog-text">
                        <h3>Les meilleures façons de réduire votre graisse abdominale avec une alimentation saine !</h3>
                        <p>Savourez des recettes faciles et nutritives qui aident à stimuler votre métabolisme et à brûler les graisses naturellement. Des idées simples à préparer pour des repas équilibrés toute la semaine!</p>
                        <div class="blog-arrow">
                            <a href="{{ route('blogs') }}">Lire la suite <i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="blog-box">
                    <div class="blog-img"><img src="{{ asset('assets/images/blog-3.jpg') }}" alt="Blog 3"></div>
                    <div class="blog-text">
                        <h3>Les meilleures façons de réduire votre graisse abdominale avec une alimentation saine !</h3>
                        <p>Adopter un mode de vie sain ne se limite pas à l'alimentation : découvrez les habitudes simples à mettre en place pour réduire la graisse abdominale, améliorer la digestion et rester en forme au quotidien!</p>
                        <div class="blog-arrow">
                            <a href="{{ route('blogs') }}">Lire la suite <i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section producteurs -->
<section class="producer-sec py-5 bg-light">
    <div class="container text-center">
        <h2 class="title mb-4">Vous êtes producteur ou commerçant ?</h2>
        <p class="mb-4">Rejoignez notre plateforme et faites connaître vos produits à notre communauté</p>
        <div class="producer-btn mb-4">
            <a href="{{ route('login') }}" class="btn btn-success btn-lg">
                <i class="fa-solid fa-user-plus"></i> Devenir membre
            </a>
        </div>
        <div class="producer-link">
            <a href="{{ route('boutique') }}" class="text-success fw-bold">
                <i class="fa-solid fa-users"></i> Voir les producteurs
            </a>
        </div>
    </div>
</section>

    </div>
@endsection