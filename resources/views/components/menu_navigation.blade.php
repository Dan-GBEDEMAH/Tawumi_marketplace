<!-- ========== HEADER - TOP BAR ================== -->
       <main>
        <div class="top-header">
            <div class="container">
                <div class="top-content">
                    <div class="top-flex">
                        <li>
                            <a href=""><i class="fa-solid fa-envelope"></i>tawumi@gmail.com</a>
                            <a href=""><i class="fa-solid fa-phone"></i>+22879768043</a>
                        </li>
                    </div>
                    <div class="top-social">
                        <ul>
                            <li><a href="https://www.facebook.com/profile.php?id=61576033483462" target="_blank"><i class="fa-brands fa-facebook-f"></i></a></li>
                            <li><a href=""><i class="fa-brands fa-instagram"></i></a></li>
                            <li><a href=""><i class="fa-brands fa-twitter"></i></a></li>
                            <li><a href="https://www.linkedin.com/in/kodjo-daniel-loïc-gbedemah-55a913371" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
              
 
        <!-- ========== HEADER - LOGO & SEARCH ============ -->

        <header class="header-main">
            <div class="container">
                <div class="logo"><img src="{{ asset('assets/images/logo.png') }}" alt=""></div>
                <div class="head-search">
                    <form action="{{ route('search') }}" method="GET">
                        <input type="text" name="q" placeholder="Recherche" value="{{ request()->input('q') }}">
                        <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                </div>
                <div class="header-icons">
                    <ul>
                        <li><a href="{{ route('login') }}"><i class="fa-solid fa-user"></i></a></li>
                        <li><a href="{{ route('favorite') }}">
                            <i class="fa-solid fa-heart"></i>
                            <span class="badge badge-danger" id="favorite-count" 
                                  style="display: {{ count(session()->get('favorites', [])) == 0 ? 'none' : 'inline-block' }};">
                                {{ count(session()->get('favorites', [])) > 0 ? count(session()->get('favorites', [])) : '' }}
                            </span>
                        </a></li>
                        <li><a href="{{ route('cart') }}"><i class="fa-solid fa-cart-shopping"></i></a></li>
                    </ul>
                </div>
            </div>
        </header>

        <!-- ========== NAVIGATION MENU =================== -->

        <nav class="navbar">
            <div class="container text-center">
                <ul>
                    <li><a href="{{ route('home') }}">Accueil</a></li>
                    <li><a href="{{ route('boutique') }}">Boutique</a></li>
                    <li><a href="{{ route('nouveautes') }}">Nouveautés</a></li>
                    <li><a href="{{ route('blogs') }}">Blogs</a></li>
                    <li><a href="{{ route('offres') }}">Offres</a></li>
                    <li><a href="{{ route('about') }}">À propos</a></li>
                    <li><a href="{{ route('contact') }}">Contact</a></li>
                </ul>
            </div>
        </nav>
