@extends('producteur.layout')

@section('title', 'Créer produit')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Créer nouveau produit</h1>
        <a href="{{ route('producteur.products') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Retour
        </a>
    </div>

    <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-10 col-md-12">
            <div class="card o-hidden border-0 shadow-lg">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-5">
                                <form method="POST" action="{{ route('producteur.products.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <!-- Champs cachés pour garantir que les valeurs booléennes sont envoyées -->
                                    <input type="hidden" name="est_nouveaute" value="0">
                                    <input type="hidden" name="est_offre" value="0">
                                    <input type="hidden" name="est_en_avant" value="0">
                                    <input type="hidden" name="est_gratuit" value="0">
                                    <input type="hidden" name="est_offre_weekend" value="0">
                                    @if (session('success'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <i class="fas fa-check-circle"></i> {{ session('success') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @endif
                                    
                                    @if ($errors->any())
                                        <div class="alert alert-danger alert-dismissible fade show">
                                            <i class="fas fa-exclamation-triangle"></i> <strong>Erreurs de validation :</strong>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            <ul class="mb-0 mt-2">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <label for="nom">Nom du produit</label>
                                        <input type="text" class="form-control form-control-user" id="nom" name="nom" value="{{ old('nom') }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description') }}</textarea>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <label for="prix_unitaire">Prix unitaire (Fcfa)</label>
                                            <input type="number" step="0.01" class="form-control form-control-user" id="prix_unitaire" name="prix_unitaire" value="{{ old('prix_unitaire') }}" required>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="stock_disponible">Stock disponible</label>
                                            <input type="number" class="form-control form-control-user" id="stock_disponible" name="stock_disponible" value="{{ old('stock_disponible', 1) }}" min="1" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="id_categorie_fk">Catégorie</label>
                                        <select class="form-control" id="id_categorie_fk" name="id_categorie_fk" required>
                                            <option value="">Sélectionnez une catégorie</option>
                                            @foreach($categories as $categorie)
                                                <option value="{{ $categorie->id }}" {{ old('id_categorie_fk') == $categorie->id ? 'selected' : '' }}>{{ $categorie->nom }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="unite_mesure_douzaine">Unité de mesure</label>
                                        <input type="text" class="form-control form-control-user" id="unite_mesure_douzaine" name="unite_mesure_douzaine" value="{{ old('unite_mesure_douzaine') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="image_produit">Image du produit</label>
                                        <input type="file" class="form-control form-control-user" id="image_produit" name="image_produit" accept="image/*">
                                        <small class="form-text text-muted">Formats acceptés: JPG, PNG, GIF. Taille maximale: 2MB.</small>
                                    </div>
                                    
                                    <!-- Nouveautés, Offres et Mise en avant -->
                                    <div class="form-group row">
                                        <div class="col-sm-4 mb-3 mb-sm-0">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="est_nouveaute" name="est_nouveaute" value="1">
                                                <label class="form-check-label" for="est_nouveaute">Nouveauté</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 mb-3 mb-sm-0">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="est_offre" name="est_offre" value="1" onchange="checkAdvancedOptions()">
                                                <label class="form-check-label" for="est_offre">Offre</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="est_en_avant" name="est_en_avant" value="1">
                                                <label class="form-check-label" for="est_en_avant">Mettre en avant</label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group" id="reduction_field" style="display: none;">
                                        <label for="reduction">Réduction (%)</label>
                                        <input type="number" class="form-control form-control-user" id="reduction" name="reduction" min="0" max="100" placeholder="Entrez le pourcentage de réduction">
                                    </div>
                                    
                                    <div class="form-group" id="advanced_offer_options">
                                        <div class="form-check mb-2">
                                            <input type="checkbox" class="form-check-input" id="est_gratuit" name="est_gratuit" value="1" onchange="checkAdvancedOptions()">
                                            <label class="form-check-label" for="est_gratuit">Produit gratuit</label>
                                        </div>
                                        <div class="form-group mb-2">
                                            <label for="quantite_limitee">Quantité limitée (laisser vide pour illimité)</label>
                                            <input type="number" class="form-control form-control-user" id="quantite_limitee" name="quantite_limitee" min="1" placeholder="Nombre maximum à vendre">
                                        </div>
                                        <div class="form-check mb-2">
                                            <input type="checkbox" class="form-check-input" id="est_offre_weekend" name="est_offre_weekend" value="1" onchange="checkAdvancedOptions()">
                                            <label class="form-check-label" for="est_offre_weekend">Offre week-end</label>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="date_debut_offre">Date de début de l'offre</label>
                                                <input type="datetime-local" class="form-control form-control-user" id="date_debut_offre" name="date_debut_offre">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="date_fin_offre">Date de fin de l'offre</label>
                                                <input type="datetime-local" class="form-control form-control-user" id="date_fin_offre" name="date_fin_offre">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Ajouter le produit
                                    </button>
                                </form>
                                <script>
                                    function checkAdvancedOptions() {
                                        const offreCheckbox = document.getElementById('est_offre');
                                        const gratuitCheckbox = document.getElementById('est_gratuit');
                                        const weekendCheckbox = document.getElementById('est_offre_weekend');
                                        
                                        const reductionField = document.getElementById('reduction_field');
                                        const reductionInput = document.getElementById('reduction');
                                        
                                        // Afficher le champ de réduction si 'Offre' est cochée
                                        if (offreCheckbox.checked) {
                                            reductionField.style.display = 'block';
                                        } else {
                                            reductionField.style.display = 'none';
                                            // Réinitialiser la valeur du champ
                                            reductionInput.value = '';
                                        }
                                    }
                                    
                                    // Initialiser l'affichage au chargement de la page
                                    document.addEventListener('DOMContentLoaded', function() {
                                        checkAdvancedOptions();
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