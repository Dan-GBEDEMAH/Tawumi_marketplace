@extends('producteur.layout')

@section('title', 'Gestion des produits')

@section('content')
<div class="w-full p-4">
    <div class="flex flex-col sm:flex-row items-center justify-between mb-4">
        <h1 class="text-lg font-medium mb-2 sm:mb-0 text-gray-800">Mes produits</h1>
        <a href="{{ route('producteur.products.create') }}" class="hidden sm:inline-block bg-blue-500 hover:bg-blue-700 text-white font-normal py-2 px-4 rounded shadow-sm">
            <i class="fas fa-plus text-xs text-white"></i> Nouveau produit
        </a>
    </div>

    <div class="bg-white shadow rounded mb-4">
        <div class="py-3 px-4 border-b">
            <h6 class="m-0 font-bold text-blue-500">Liste de mes produits</h6>
        </div>
        <div class="p-4">
            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-200" id="dataTable" width="100%" cellspacing="0">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 border-b border-gray-200 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                            <th class="px-4 py-3 border-b border-gray-200 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th class="px-4 py-3 border-b border-gray-200 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                            <th class="px-4 py-3 border-b border-gray-200 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Catégorie</th>
                            <th class="px-4 py-3 border-b border-gray-200 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ferme</th>
                            <th class="px-4 py-3 border-b border-gray-200 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prix</th>
                            <th class="px-4 py-3 border-b border-gray-200 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock</th>
                            <th class="px-4 py-3 border-b border-gray-200 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($produits as $produit)
                        <tr>
                            <td>
                                @if($produit->image_produit)
                                    <img src="{{ $produit->image }}" alt="{{ $produit->nom }}" style="width: 50px; height: 50px; object-fit: cover;">
                                @else
                                    <span>Aucune image</span>
                                @endif
                            </td>
                            <td>{{ $produit->id }}</td>
                            <td>{{ $produit->nom }}</td>
                            <td>{{ $produit->categorie->nom ?? 'N/A' }}</td>
                            <td>{{ Auth::user()->nom_domaine ?? 'N/A' }}</td>
                            <td>{{ number_format($produit->prix_unitaire, 2) }} Fcfa</td>
                            <td>{{ $produit->stock_disponible }}</td>
                            <td class="whitespace-nowrap px-4 py-4 text-sm font-medium">
                                <a href="{{ route('producteur.products.edit', $produit->id) }}" class="inline-block bg-blue-500 hover:bg-blue-700 text-white text-sm py-1 px-2 rounded">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('producteur.products.delete', $produit->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-block bg-red-500 hover:bg-red-700 text-white text-sm py-1 px-2 rounded" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection