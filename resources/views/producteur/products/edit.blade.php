@extends('producteur.layout')

@section('title', 'Modifier produit')

@section('content')
<div class="w-full p-4">
    <div class="flex flex-col sm:flex-row items-center justify-between mb-4">
        <h1 class="text-lg font-medium mb-2 sm:mb-0 text-gray-800">Modifier produit</h1>
        <a href="{{ route('producteur.products') }}" class="hidden sm:inline-block bg-gray-500 hover:bg-gray-700 text-white font-normal py-2 px-4 rounded shadow-sm">
            <i class="fas fa-arrow-left text-xs text-white"></i> Retour
        </a>
    </div>

    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-10/12 max-w-2xl">
            <div class="bg-white border-0 shadow-lg rounded">
                <div class="p-0">
                    <div class="flex flex-wrap">
                        <div class="w-full">
                            <div class="p-5">
                                <form method="POST" action="{{ route('producteur.products.update', $produit->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-4">
                                        <label for="nom" class="block text-gray-700 text-sm font-bold mb-2">Nom du produit</label>
                                        <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nom" name="nom" value="{{ old('nom', $produit->nom) }}" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description</label>
                                        <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="description" name="description" rows="3" required>{{ old('description', $produit->description) }}</textarea>
                                    </div>
                                    <div class="flex flex-wrap -mx-2">
                                        <div class="w-full sm:w-1/2 px-2 mb-3 sm:mb-0">
                                            <label for="prix_unitaire" class="block text-gray-700 text-sm font-bold mb-2">Prix unitaire (Fcfa)</label>
                                            <input type="number" step="0.01" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="prix_unitaire" name="prix_unitaire" value="{{ old('prix_unitaire', $produit->prix_unitaire) }}" required>
                                        </div>
                                        <div class="w-full sm:w-1/2 px-2">
                                            <label for="stock_disponible" class="block text-gray-700 text-sm font-bold mb-2">Stock disponible</label>
                                            <input type="number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="stock_disponible" name="stock_disponible" value="{{ old('stock_disponible', $produit->stock_disponible) }}" required>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <label for="id_categorie_fk" class="block text-gray-700 text-sm font-bold mb-2">Catégorie</label>
                                        <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="id_categorie_fk" name="id_categorie_fk" required>
                                            @foreach($categories as $categorie)
                                                <option value="{{ $categorie->id }}" {{ $produit->id_categorie_fk == $categorie->id ? 'selected' : '' }}>{{ $categorie->nom }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label for="unite_mesure_douzaine" class="block text-gray-700 text-sm font-bold mb-2">Unité de mesure</label>
                                        <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="unite_mesure_douzaine" name="unite_mesure_douzaine" value="{{ old('unite_mesure_douzaine', $produit->unite_mesure_douzaine) }}">
                                    </div>
                                    <div class="mb-4">
                                        <label for="image_produit" class="block text-gray-700 text-sm font-bold mb-2">Image du produit</label>
                                        @if($produit->image_produit)
                                        <div class="mb-2">
                                            <img src="{{ asset('storage/' . $produit->image_produit) }}" alt="Image actuelle" class="max-w-xs border border-gray-300 rounded" style="max-width: 200px;">
                                        </div>
                                        @endif
                                        <input type="file" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="image_produit" name="image_produit" accept="image/*">
                                        <small class="text-gray-500">Formats acceptés: JPG, PNG, GIF. Taille maximale: 2MB.</small>
                                    </div>
                                    
                                    <!-- Nouveautés, Offres et Mise en avant -->
                                    <div class="flex flex-wrap -mx-2">
                                        <div class="w-full sm:w-1/3 px-2 mb-3 sm:mb-0">
                                            <div class="flex items-center">
                                                <input type="checkbox" class="form-checkbox h-4 w-4 text-green-600" id="est_nouveaute" name="est_nouveaute" value="1" {{ $produit->est_nouveaute ? 'checked' : '' }}>
                                                <label class="ml-2 block text-gray-700" for="est_nouveaute">Nouveauté</label>
                                            </div>
                                        </div>
                                        <div class="w-full sm:w-1/3 px-2 mb-3 sm:mb-0">
                                            <div class="flex items-center">
                                                <input type="checkbox" class="form-checkbox h-4 w-4 text-green-600" id="est_offre" name="est_offre" value="1" {{ $produit->est_offre ? 'checked' : '' }} onchange="toggleReduction(this)">
                                                <label class="ml-2 block text-gray-700" for="est_offre">Offre</label>
                                            </div>
                                        </div>
                                        <div class="w-full sm:w-1/3 px-2">
                                            <div class="flex items-center">
                                                <input type="checkbox" class="form-checkbox h-4 w-4 text-green-600" id="est_en_avant" name="est_en_avant" value="1" {{ $produit->est_en_avant ? 'checked' : '' }}>
                                                <label class="ml-2 block text-gray-700" for="est_en_avant">Mettre en avant</label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-4" id="reduction_field" style="display: none;">
                                        <label for="reduction" class="block text-gray-700 text-sm font-bold mb-2">Réduction (%)</label>
                                        <input type="number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="reduction" name="reduction" min="0" max="100" placeholder="Entrez le pourcentage de réduction" value="{{ old('reduction', $produit->reduction) }}">
                                    </div>
                                    
                                    <div class="mb-4" id="advanced_offer_options" style="display: none;">
                                        <div class="flex items-center mb-2">
                                            <input type="checkbox" class="form-checkbox h-4 w-4 text-green-600" id="est_gratuit" name="est_gratuit" value="1" {{ old('est_gratuit', $produit->est_gratuit) ? 'checked' : '' }}>
                                            <label class="ml-2 block text-gray-700" for="est_gratuit">Produit gratuit</label>
                                        </div>
                                        <div class="mb-2">
                                            <label for="quantite_limitee" class="block text-gray-700 text-sm font-bold mb-2">Quantité limitée (laisser vide pour illimité)</label>
                                            <input type="number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="quantite_limitee" name="quantite_limitee" min="1" placeholder="Nombre maximum à vendre" value="{{ old('quantite_limitee', $produit->quantite_limitee) }}">
                                        </div>
                                        <div class="flex items-center mb-2">
                                            <input type="checkbox" class="form-checkbox h-4 w-4 text-green-600" id="est_offre_weekend" name="est_offre_weekend" value="1" {{ old('est_offre_weekend', $produit->est_offre_weekend) ? 'checked' : '' }}>
                                            <label class="ml-2 block text-gray-700" for="est_offre_weekend">Offre week-end</label>
                                        </div>
                                        <div class="flex flex-wrap -mx-2">
                                            <div class="w-full md:w-1/2 px-2">
                                                <label for="date_debut_offre" class="block text-gray-700 text-sm font-bold mb-2">Date de début de l'offre</label>
                                                <input type="datetime-local" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="date_debut_offre" name="date_debut_offre" value="{{ old('date_debut_offre', $produit->date_debut_offre ? (is_string($produit->date_debut_offre) ? $produit->date_debut_offre : $produit->date_debut_offre->format('Y-m-d\TH:i')) : '') }}">
                                            </div>
                                            <div class="w-full md:w-1/2 px-2">
                                                <label for="date_fin_offre" class="block text-gray-700 text-sm font-bold mb-2">Date de fin de l'offre</label>
                                                <input type="datetime-local" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="date_fin_offre" name="date_fin_offre" value="{{ old('date_fin_offre', $produit->date_fin_offre ? (is_string($produit->date_fin_offre) ? $produit->date_fin_offre : $produit->date_fin_offre->format('Y-m-d\TH:i')) : '') }}">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full">
                                        Mettre à jour le produit
                                    </button>
                                </form>
                                <script>
                                    function toggleReduction(checkbox) {
                                        const reductionField = document.getElementById('reduction_field');
                                        const advancedOfferOptions = document.getElementById('advanced_offer_options');
                                        
                                        if (checkbox.checked) {
                                            reductionField.style.display = 'block';
                                            advancedOfferOptions.style.display = 'block';
                                        } else {
                                            reductionField.style.display = 'none';
                                            // Réinitialiser la valeur du champ
                                            document.getElementById('reduction').value = '';
                                        }
                                    }
                                    
                                    // Afficher les options avancées si "Offre" est déjà cochée au chargement
                                    document.addEventListener('DOMContentLoaded', function() {
                                        const offreCheckbox = document.getElementById('est_offre');
                                        if (offreCheckbox.checked) {
                                            toggleReduction(offreCheckbox);
                                        }
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection