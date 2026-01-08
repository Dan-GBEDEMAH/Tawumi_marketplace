<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Dashboard - TawumiConfirm')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    
    <style>
        :root {
            --agricultural-green: #4CAF50;
            --agricultural-light-green: #287233;
            --agricultural-dark-green: #388E3C;
            --agricultural-leaf: #795548;
            --agricultural-brown: #5D4037;
        }
        
        body {
            background-color: #f9f9f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, var(--agricultural-green) 0%, var(--agricultural-light-green) 100%);
            color: white;
            border-right: 1px solid rgba(0,0,0,0.1);
        }
        
        .main-content {
            background-color: #f0f7f0;
        }
        
        .card-stat {
            border-left: 4px solid var(--agricultural-green);
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: transform 0.2s;
        }
        
        .card-stat:hover {
            transform: translateY(-5px);
        }
        
        .sidebar .nav-link {
            padding: 0.75rem 1.5rem;
            color: rgba(255, 255, 255, 0.85);
            border-radius: 0;
            transition: all 0.3s;
        }
        
        .sidebar .nav-link.active {
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
            border-left: 3px solid white;
        }
        
        .sidebar .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.15);
            color: white;
        }
        
        .dashboard-header {
            background: linear-gradient(90deg, var(--agricultural-green) 0%, var(--agricultural-light-green) 100%);
            color: white;
            padding: 15px 30px;
            border-radius: 0 0 10px 10px;
            margin-bottom: 20px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        
        .agricultural-icon {
            color: var(--agricultural-green);
            font-size: 1.5rem;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block sidebar collapse">
                <div class="position-sticky pt-3">
                    <div class="text-center mb-4 p-3">
                        <h5 class="text-white">TawumiConfirm</h5>
                        <p class="text-white-50 mb-0">Tableau de bord Admin</p>
                        <div class="mt-2">
                            <i class="fas fa-seedling agricultural-icon fa-2x"></i>
                        </div>
                    </div>
                    
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                                <i class="fas fa-tractor me-2"></i>Tableau de bord
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.users*') ? 'active' : '' }}" href="{{ route('admin.users') }}">
                                <i class="fas fa-people-carry me-2"></i>Gestion des utilisateurs
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.products*') ? 'active' : '' }}" href="{{ route('admin.products') }}">
                                <i class="fas fa-apple-alt me-2"></i>Gestion des produits
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.orders*') ? 'active' : '' }}" href="{{ route('admin.orders') }}">
                                <i class="fas fa-truck me-2"></i>Gestion des commandes
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.shops*') ? 'active' : '' }}" href="{{ route('admin.shops') }}">
                                <i class="fas fa-store-alt me-2"></i>Gestion des boutiques
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.reports*') ? 'active' : '' }}" href="{{ route('admin.reports') }}">
                                <i class="fas fa-chart-line me-2"></i>Statistiques & rapports
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.settings*') ? 'active' : '' }}" href="{{ route('admin.settings') }}">
                                <i class="fas fa-tools me-2"></i>Paramètres
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">
                                <i class="fas fa-arrow-left me-2"></i>Retour au site
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                <div class="dashboard-header">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                        <h1 class="h3 mb-0"><i class="fas fa-leaf me-2"></i>@yield('title', 'Tableau de bord')</h1>
                        <div class="btn-toolbar mb-2 mb-md-0">
                            <div class="btn-group me-2">
                                <a href="{{ route('home') }}" class="btn btn-sm btn-outline-light">
                                    <i class="fas fa-home me-1"></i>Voir le site
                                </a>
                                <a href="{{ route('logout') }}" class="btn btn-sm btn-outline-light">
                                    <i class="fas fa-sign-out-alt me-1"></i>Déconnexion
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/js/all.min.js"></script>
    
    @yield('scripts')
</body>
</html>