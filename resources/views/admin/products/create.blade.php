@extends('admin.layout')

@section('title', 'Créer produit')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Créer nouveau produit</h1>
        <a href="{{ route('admin.products') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
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
                                <form method="POST" action="{{ route('admin.products.store') }}">
                                    @csrf
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
                                            <input type="number" class="form-control form-control-user" id="stock_disponible" name="stock_disponible" value="{{ old('stock_disponible', 0) }}" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <label for="id_categorie_fk">Catégorie</label>
                                            <select class="form-control" id="id_categorie_fk" name="id_categorie_fk" required>
                                                @foreach($categories as $categorie)
                                                    <option value="{{ $categorie->id }}">{{ $categorie->nom }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="id_producteur_fk">Producteur</label>
                                            <select class="form-control" id="id_producteur_fk" name="id_producteur_fk" required>
                                                @foreach($producteurs as $producteur)
                                                    <option value="{{ $producteur->id }}">{{ $producteur->prenom }} {{ $producteur->nom }}</option>
                                                @endforeach
                                            </select>
                                        </div>
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
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Créer le produit
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection