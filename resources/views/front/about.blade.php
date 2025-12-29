@extends('layouts.front')

@section('contentPage')



    <!-- About Header -->
    <section class="about-header">
        <div class="container">
            <h1>À Propos de TawumiConfirm</h1>
            <p>Votre marché local de confiance pour des produits frais et de qualité</p>
        </div>
    </section>

    <!-- About Story -->
    <section class="about-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="about-img">
                        <img src="{{ asset('assets/images/propos_img.png') }}" alt="Notre histoire">
                    </div>
                </div>
                <div class="col-lg-6">
                    <h2>Notre Histoire</h2>
                    <p>Fondé en 2015, TawumiConfirm a commencé comme un petit marché local avec une vision claire : fournir des produits frais et de qualité à des prix abordables à notre communauté.</p>
                    <p>Au fil des ans, nous avons élargi notre gamme de produits tout en maintenant notre engagement envers l'excellence et le service client. Aujourd'hui, nous sommes fiers de servir des milliers de clients dans toute le pays.</p>
                    <p>Notre succès repose sur des relations solides avec les agriculteurs locaux et les fournisseurs, garantissant ainsi que chaque produit qui arrive dans nos rayons répond à nos normes strictes de qualité.</p>
                    <div class="mission-vision">
                        <h3>Notre Mission</h3>
                        <p>Fournir des produits alimentaires frais, sains et de qualité à des prix compétitifs tout en soutenant les agriculteurs locaux et en promouvant une alimentation responsable.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission & Vision -->
    <section class="about-section bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="mission-vision">
                        <h3>Notre Vision</h3>
                        <p>Devenir le marché de référence dans le pays, reconnu pour notre engagement envers la durabilité, la qualité des produits et l'excellence du service client.</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mission-vision">
                        <h3>Nos Valeurs</h3>
                        <ul class="values-list">
                            <li>
                                <i class="fa fa-check-circle value-icon"></i>
                                <div>
                                    <strong>Qualité</strong>
                                    <p>Nous ne compromettons jamais sur la qualité de nos produits.</p>
                                </div>
                            </li>
                            <li>
                                <i class="fa fa-check-circle value-icon"></i>
                                <div>
                                    <strong>Intégrité</strong>
                                    <p>Nous menons nos affaires avec honnêteté et transparence.</p>
                                </div>
                            </li>
                            <li>
                                <i class="fa fa-check-circle value-icon"></i>
                                <div>
                                    <strong>Communauté</strong>
                                    <p>Nous soutenons activement les producteurs locaux.</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Counter -->
    <section class="about-section">
        <div class="container">
            <div class="section-title">
                <h2>En Chiffres</h2>
                <p>Notre parcours jusqu'à aujourd'hui</p>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="counter-box">
                        <div class="counter-icon">
                            <i class="fa fa-users"></i>
                        </div>
                        <div class="counter-number">5000+</div>
                        <h4>Clients Satisfaits</h4>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="counter-box">
                        <div class="counter-icon">
                            <i class="fa fa-leaf"></i>
                        </div>
                        <div class="counter-number">200+</div>
                        <h4>Producteurs Locaux</h4>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="counter-box">
                        <div class="counter-icon">
                            <i class="fa fa-store"></i>
                        </div>
                        <div class="counter-number">15</div>
                        <h4>Années d'Existence</h4>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="counter-box">
                        <div class="counter-icon">
                            <i class="fa fa-box"></i>
                        </div>
                        <div class="counter-number">2000+</div>
                        <h4>Produits Disponibles</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="about-section bg-light">
        <div class="container">
            <div class="section-title">
                <h2>Notre Équipe</h2>
                <p>Les personnes derrière notre succès</p>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="team-member">
                        <div class="member-img">
                            <img src="{{ asset('assets/images/dg_general.jpg') }}" alt="Chef d'équipe">
                        </div>
                        <h3 class="member-name">Ingénieur GBÊ</h3>
                        <div class="member-position">Directeur Générale</div>
                        <p>Avec plus de 15 ans d'expérience dans le secteur alimentaire, Marie dirige notre entreprise avec passion et dévouement.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="team-member">
                        <div class="member-img">
                            <img src="{{ asset('assets/images/resp_achat.jpg') }}" alt="Responsable achats">
                        </div>
                        <h3 class="member-name">Clentine BILL</h3>
                        <div class="member-position">Responsable Achats</div>
                        <p>Jean travaille en étroite collaboration avec nos fournisseurs locaux pour garantir la meilleure qualité de produits.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="team-member">
                        <div class="member-img">
                            <img src="{{ asset('assets/images/cusinière.jpg') }}" alt="Cheffe cuisinière">
                        </div>
                        <h3 class="member-name">Loriane ELLA</h3>
                        <div class="member-position">Cheffe Cuisinière</div>
                        <p>Sophie supervise la préparation de nos plats préparés et assure la formation de notre équipe culinaire.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="testimonials">
        <div class="container">
            <div class="section-title">
                <h2>Témoignages Clients</h2>
                <p>Ce que disent nos clients</p>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="testimonial-card">
                        <div class="client-img">
                            <img src="{{ asset('assets/images/pk_test.jpg') }}" alt="Client">
                        </div>
                        <h4>Pierre KOFFI</h4>
                        <div class="stars">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <p>"Les produits sont toujours frais et de très bonne qualité. Le service client est exceptionnel!"</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="testimonial-card">
                        <div class="client-img">
                            <img src="{{ asset('assets/images/ad_test.jpg') }}" alt="Client">
                        </div>
                        <h4>Amina TRAORE</h4>
                        <div class="stars">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-alt"></i>
                        </div>
                        <p>"J'apprécie particulièrement leur sélection de produits locaux. Cela soutient notre communauté!"</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="testimonial-card">
                        <div class="client-img">
                            <img src="{{ asset('assets/images/fp_test.jpg') }}" alt="Client">
                        </div>
                        <h4>Koffi ADJO</h4>
                        <div class="stars">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <p>"Livraison rapide et produits toujours conformes à mes attentes. Je recommande vivement!"</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    

   
 
@endsection