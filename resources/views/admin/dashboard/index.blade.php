@extends('admin.layout')

@section('title', 'Tableau de bord - Admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h2><i class="fas fa-seedling me-2"></i>Bienvenue Admin</h2>
            <p class="text-muted">Vue d'ensemble de la plateforme TawumiConfirm pour les produits agricoles locaux</p>
        </div>
    </div>

    <!-- Statistiques -->
    <div class="row mt-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-stat h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Utilisateurs Total
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalUsers }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-stat h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Producteurs
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalProducteurs }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-tractor fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-stat h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Commerçants
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalCommercants }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-stat h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Revenus Totals
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($totalRevenus, 2) }} Fcfa</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Autres statistiques -->
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-stat h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                Produits
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalProduits }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-apple-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-stat h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Commandes
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalCommandes }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-truck fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-stat h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Commandes Validées
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalCommandesValidees }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-stat h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Commandes En Attente
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalCommandesEnAttente }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Dernières commandes -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Dernières Commandes Agricoles</h6>
                </div>
                <div class="card-body">
                    <p class="text-muted">Les commandes récentes de produits agricoles locaux</p>
                    <!-- Vous pouvez ajouter ici une table avec les dernières commandes -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection