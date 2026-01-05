@extends('producteur.layout')

@section('title', 'Tableau de bord - Producteur')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h2><i class="fas fa-seedling me-2"></i>Bienvenue {{ $producteur->prenom ?? $producteur->nom ?? 'Producteur' }} dans votre Tableau de bord</h2>
            <p class="text-muted">Gérez vos produits agricoles locaux</p>
        </div>
    </div>

    <!-- Statistiques -->
    <div class="row mt-4">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card card-stat h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Vos Produits
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

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card card-stat h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Vos Commandes
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

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card card-stat h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Revenus
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

    <!-- Dernières commandes -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Vos Dernières Commandes Agricoles</h6>
                </div>
                <div class="card-body">
                    <p class="text-muted">Les commandes récentes pour vos produits agricoles</p>
                    <!-- Vous pouvez ajouter ici une table avec les dernières commandes -->
                </div>
            </div>
        </div>
    </div>

    <!-- Actions rapides -->
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Actions Rapides</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 text-center mb-3">
                            <a href="{{ route('producteur.products.create') }}" class="btn btn-primary btn-lg">
                                <i class="fas fa-plus-circle me-2"></i>Ajouter un produit
                            </a>
                        </div>
                        <div class="col-md-4 text-center mb-3">
                            <a href="{{ route('producteur.products') }}" class="btn btn-success btn-lg">
                                <i class="fas fa-apple-alt me-2"></i>Gérer les produits
                            </a>
                        </div>
                        <div class="col-md-4 text-center mb-3">
                            <a href="{{ route('producteur.orders') }}" class="btn btn-info btn-lg">
                                <i class="fas fa-truck me-2"></i>Voir les commandes
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection