@extends('layouts.front')

@section('contentPage')

   <!-- Blog Header -->
    <section class="blog-header">
        <div class="container">
            <h1>Nos Articles et Actualités</h1>
            <p>Découvrez nos conseils nutritionnels et actualités sur l'alimentation</p>
        </div>
    </section>

    <!-- Blog Content -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <!-- Blog Posts -->
                <div class="col-lg-8">
                    <!-- Blog Post 1 -->
                    <div class="blog-card">
                        <div class="blog-img">
                            <img src="{{ asset('assets/images/legumes_vert.jpg') }}" alt="Nutrition">
                        </div>
                        <div class="blog-content">
                            <div class="blog-meta">
                                <span><i class="fa fa-calendar"></i> 15 Juin 2026</span>
                                <span><i class="fa fa-user"></i> Custo</span>
                                <span><i class="fa fa-tags"></i> Nutrition</span>
                            </div>
                            <h3>Les bienfaits des légumes verts pour votre santé</h3>
                            <p>Les légumes verts sont riches en vitamines, minéraux et antioxydants essentiels à une bonne santé.</p>
                            <a href="javascript:void(0)" class="read-more" onclick="toggleContent('post1-content')">Lire la suite <i class="fa fa-arrow-right"></i></a>
                            <div id="post1-content" class="extended-content" style="display: none;">
                                <p>Les légumes verts sont parmi les aliments les plus nutritifs que vous puissiez consommer. Ils sont riches en vitamines A, C, K, en folate, en fibres et en antioxydants. La consommation régulière de légumes verts comme les épinards, le chou frisé, la laitue, le brocoli et les haricots verts peut contribuer à réduire le risque de maladies cardiovasculaires, certains cancers et à améliorer la santé digestive. Le fer contenu dans ces légumes aide à prévenir l'anémie, tandis que la vitamine K est essentielle pour la santé osseuse. Intégrez-les à vos repas quotidiens sous forme de salades, smoothies ou plats cuisinés pour profiter pleinement de leurs bienfaits.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Blog Post 2 -->
                    <div class="blog-card">
                        <div class="blog-img">
                            <img src="{{ asset('assets/images/reccette_togolaise.jpg') }}" alt="Recettes">
                        </div>
                        <div class="blog-content">
                            <div class="blog-meta">
                                <span><i class="fa fa-calendar"></i> 10 Juin 2026</span>
                                <span><i class="fa fa-user"></i> Chef Pierre</span>
                                <span><i class="fa fa-tags"></i> Recettes</span>
                            </div>
                            <h3>5 recettes faciles avec des ingrédients locaux</h3>
                            <p>Envie de cuisiner local et gourmand ? Chef Pierre vous propose cinq recettes faciles,
                               préparées avec des ingrédients frais et de saison, pour régaler toute la famille sans
                                passer des heures en cuisine.
                            </p>    
                            <a href="javascript:void(0)" class="read-more" onclick="toggleContent('post2-content')">Lire la suite <i class="fa fa-arrow-right"></i></a>
                            <div id="post2-content" class="extended-content" style="display: none;">
                                <p>Découvrez cinq recettes simples et savoureuses à base d'ingrédients locaux du Togo. Ces recettes mettent en valeur les saveurs authentiques de nos produits locaux tout en restant accessibles à tous les cuisiniers, même débutants. De la fameuse sauce d'arachide revisitée avec des légumes frais, au poisson frais grillé avec des herbes aromatiques locales, en passant par une délicieuse salade de fruits de saison. Chaque recette est pensée pour être préparée en moins de 30 minutes, avec des ingrédients facilement trouvables sur les marchés locaux. Ces plats vous permettront de découvrir ou redécouvrir les richesses gastronomiques de notre terroir.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Blog Post 3 -->
                    <div class="blog-card">
                        <div class="blog-img">
                            <img src="{{ asset('assets/images/saison.jpg') }}" alt="Saison">
                        </div>
                        <div class="blog-content">
                            <div class="blog-meta">
                                <span><i class="fa fa-calendar"></i> 5 Juin 2026</span>
                                <span><i class="fa fa-user"></i> Eli'shama</span>
                                <span><i class="fa fa-tags"></i> Saison</span>
                            </div>
                            <h3>Les fruits et légumes de saison en été</h3>
                            <p>L'été offre une grande variété de fruits et légumes riches en vitamines et en eau.
                                Apprenez à reconnaître les produits de saison pour mieux les intégrer dans votre
                                alimentation quotidienne.
                            </p>   
                            <a href="javascript:void(0)" class="read-more" onclick="toggleContent('post3-content')">Lire la suite <i class="fa fa-arrow-right"></i></a>
                            <div id="post3-content" class="extended-content" style="display: none;">
                                <p>Pendant la saison estivale, de nombreux fruits et légumes atteignent leur pleine maturité et offrent une saveur exceptionnelle. C'est le moment idéal pour consommer des produits frais et riches en eau, comme les melons, les pastèques, les tomates, les courgettes et les aubergines. Ces aliments sont non seulement délicieux mais aussi très bénéfiques pour l'organisme car ils aident à rester hydraté pendant les journées chaudes. Les fruits d'été sont riches en vitamine C et en antioxydants, tandis que les légumes d'été fournissent des fibres, des vitamines et minéraux essentiels. Profitez de cette abondance pour varier vos repas et adopter une alimentation colorée et équilibrée.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Blog Post 4 -->
                    <div class="blog-card">
                        <div class="blog-img">
                            <img src="{{ asset('assets/images/bio.jpg') }}" alt="Organic">
                        </div>
                        <div class="blog-content">
                            <div class="blog-meta">
                                <span><i class="fa fa-calendar"></i> 1 Juin 2026</span>
                                <span><i class="fa fa-user"></i> Dr. Martin</span>
                                <span><i class="fa fa-tags"></i> Bio</span>
                            </div>
                            <h3>Pourquoi choisir des produits biologiques ?</h3>
                            <p>Choisir des produits biologiques, c'est privilégier une alimentation plus saine,
                               sans pesticides chimiques, tout en respectant le cycle naturel des aliments.
                            </p> 
                            <a href="javascript:void(0)" class="read-more" onclick="toggleContent('post4-content')">Lire la suite <i class="fa fa-arrow-right"></i></a>
                            <div id="post4-content" class="extended-content" style="display: none;">
                                <p>Les produits biologiques offrent de nombreux avantages par rapport aux produits conventionnels. Ils sont cultivés sans pesticides chimiques de synthèse, herbicides ou engrais artificiels, ce qui réduit votre exposition à des substances potentiellement nocives. Les aliments biologiques contiennent souvent plus d'antioxydants et moins de résidus chimiques. De plus, l'agriculture biologique favorise la biodiversité, préserve les sols et les nappes phréatiques. Bien que les produits bio puissent être légèrement plus coûteux, leur impact positif sur la santé et l'environnement en fait un choix judicieux. La consommation de produits biologiques peut contribuer à réduire les risques d'allergies, de problèmes digestifs et d'exposition à des toxines.</p>
                            </div>
                        </div>
                    </div>

                    
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <!-- Search Widget -->
                    <div class="sidebar-widget">
                        <h4>Rechercher</h4>
                        <form action="{{ route('search') }}" method="GET">
                            <div class="input-group">
                                <input type="text" class="form-control" name="query" placeholder="Rechercher...">
                                <button class="btn btn-success" type="submit"><i class="fa fa-search"></i></button>
                            </div>
                        </form>
                    </div>

                    <!-- Categories Widget -->
                    <div class="sidebar-widget">
                        <h4>Catégories</h4>
                        <ul class="list-unstyled">
                            <li class="mb-2"><a href="{{ route('search') }}?category=nutrition" class="text-decoration-none text-dark">Nutrition <span class="float-end">(12)</span></a></li>
                            <li class="mb-2"><a href="{{ route('search') }}?category=recettes" class="text-decoration-none text-dark">Recettes <span class="float-end">(8)</span></a></li>
                            <li class="mb-2"><a href="{{ route('search') }}?category=saison" class="text-decoration-none text-dark">Saison <span class="float-end">(5)</span></a></li>
                            <li class="mb-2"><a href="{{ route('search') }}?category=bio" class="text-decoration-none text-dark">Bio <span class="float-end">(7)</span></a></li>
                            <li class="mb-2"><a href="{{ route('search') }}?category=conseils" class="text-decoration-none text-dark">Conseils <span class="float-end">(9)</span></a></li>
                        </ul>
                    </div>

                    <!-- Popular Posts Widget -->
                    <div class="sidebar-widget">
                        <h4>Articles Populaires</h4>
                        <div class="popular-post">
                            <div class="popular-post-img">
                                <img src="{{ asset('assets/images/legumes_vert.jpg') }}" alt="">
                            </div>
                            <div class="popular-post-content">
                                <h5>Les bienfaits des légumes verts</h5>
                                <div class="post-date">15 Juin 2026</div>
                            </div>
                        </div>
                        <div class="popular-post">
                            <div class="popular-post-img">
                                <img src="{{ asset('assets/images/reccette_togolaise.jpg') }}" alt="">
                            </div>
                            <div class="popular-post-content">
                                <h5>5 recettes faciles avec des ingrédients locaux</h5>
                                <div class="post-date">10 Juin 2026</div>
                            </div>
                        </div>
                        <div class="popular-post">
                            <div class="popular-post-img">
                                <img src="{{ asset('assets/images/saison.jpg') }}" alt="">
                            </div>
                            <div class="popular-post-content">
                                <h5>Les fruits et légumes de saison en été</h5>
                                <div class="post-date">5 Juin 2026</div>
                            </div>
                        </div>
                    </div>

                    <!-- Tags Widget -->
                    <div class="sidebar-widget">
                        <h4>Mots-clés</h4>
                        <div class="tag-cloud">
                            <a href="{{ route('search') }}?tag=nutrition">Nutrition</a>
                            <a href="{{ route('search') }}?tag=bio">Bio</a>
                            <a href="{{ route('search') }}?tag=recettes">Recettes</a>
                            <a href="{{ route('search') }}?tag=saison">Saison</a>
                            <a href="{{ route('search') }}?tag=legumes">Légumes</a>
                            <a href="{{ route('search') }}?tag=fruits">Fruits</a>
                            <a href="{{ route('search') }}?tag=sante">Santé</a>
                            <a href="{{ route('search') }}?tag=bien-etre">Bien-être</a>
                            <a href="{{ route('search') }}?tag=conseils">Conseils</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


<script>
    function toggleContent(contentId) {
        const content = document.getElementById(contentId);
        if (content.style.display === 'none') {
            content.style.display = 'block';
        } else {
            content.style.display = 'none';
        }
    }
</script>

@endsection