@extends('producteur.layout')

@section('title', 'Mes rapports')

@section('content')
<div class="w-full p-4">
    <div class="flex flex-row sm:flex-col md:flex-row items-center justify-between mb-4">
        <h1 class="text-lg md:text-xl font-medium mb-0 text-gray-800">Mes rapports et statistiques</h1>
    </div>

    <!-- Statistiques -->
    <div class="flex flex-wrap -mx-2">
        <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 p-2 mb-4">
            <div class="card bg-white border-l-4 border-blue-500 shadow rounded h-full py-2">
                <div class="p-4">
                    <div class="flex items-center">
                        <div class="flex-1 mr-2">
                            <div class="text-xs font-bold text-blue-500 uppercase mb-1">
                                Revenus totaux
                            </div>
                            <div class="text-lg font-bold text-gray-800">{{ number_format($statistiques['total_revenus'], 2) }} Fcfa</div>
                        </div>
                        <div class="flex-shrink-0">
                            <i class="fas fa-dollar-sign text-2xl text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 p-2 mb-4">
            <div class="card bg-white border-l-4 border-green-500 shadow rounded h-full py-2">
                <div class="p-4">
                    <div class="flex items-center">
                        <div class="flex-1 mr-2">
                            <div class="text-xs font-bold text-green-500 uppercase mb-1">
                                Total commandes
                            </div>
                            <div class="text-lg font-bold text-gray-800">{{ $statistiques['total_commandes'] }}</div>
                        </div>
                        <div class="flex-shrink-0">
                            <i class="fas fa-shopping-cart text-2xl text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 p-2 mb-4">
            <div class="card bg-white border-l-4 border-cyan-500 shadow rounded h-full py-2">
                <div class="p-4">
                    <div class="flex items-center">
                        <div class="flex-1 mr-2">
                            <div class="text-xs font-bold text-cyan-500 uppercase mb-1">
                                Commandes ce mois
                            </div>
                            <div class="text-lg font-bold text-gray-800">{{ $statistiques['commandes_ce_mois'] }}</div>
                        </div>
                        <div class="flex-shrink-0">
                            <i class="fas fa-calendar text-2xl text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 p-2 mb-4">
            <div class="card bg-white border-l-4 border-yellow-500 shadow rounded h-full py-2">
                <div class="p-4">
                    <div class="flex items-center">
                        <div class="flex-1 mr-2">
                            <div class="text-xs font-bold text-yellow-500 uppercase mb-1">
                                Mes produits
                            </div>
                            <div class="text-lg font-bold text-gray-800">{{ \App\Models\Produit::where('id_producteur_fk', auth()->id())->count() }}</div>
                        </div>
                        <div class="flex-shrink-0">
                            <i class="fas fa-box text-2xl text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

   
    <!-- Détails supplémentaires -->
    <div class="flex flex-wrap -mx-2">
        <div class="w-full md:w-1/2 p-2 mb-4">
            <div class="card bg-white shadow rounded mb-4">
                <div class="py-3 px-4 border-b">
                    <h6 class="m-0 font-bold text-blue-500">Mes produits les plus vendus</h6>
                </div>
                <div class="p-4">
                    <p class="mb-0">Vos produits les plus populaires.</p>
                    <!-- Vous pouvez ajouter une liste ou un graphique ici -->
                </div>
            </div>
        </div>
        
        <div class="w-full md:w-1/2 p-2 mb-4">
            <div class="card bg-white shadow rounded mb-4">
                <div class="py-3 px-4 border-b">
                    <h6 class="m-0 font-bold text-blue-500">Activité récente</h6>
                </div>
                <div class="p-4">
                    <p class="mb-0">Dernières activités pour vos produits.</p>
                    <!-- Vous pouvez ajouter une liste d'activités récentes ici -->
                </div>
            </div>
        </div>
    </div>
</div>

@endsection