@extends('producteur.layout')

@section('title', 'Détails commande')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Détails commande #{{ $commande->id }}</h1>
        <a href="{{ route('producteur.orders') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Retour
        </a>
    </div>

    <div class="row">
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Détails de la commande</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('producteur.orders.update', $commande->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="statut_en_attente_valide_annule_etc">Statut de la commande</label>
                            <select class="form-control" id="statut_en_attente_valide_annule_etc" name="statut_en_attente_valide_annule_etc" required>
                                <option value="en_attente" {{ $commande->statut_en_attente_valide_annule_etc == 'en_attente' ? 'selected' : '' }}>En attente</option>
                                <option value="en_cours" {{ $commande->statut_en_attente_valide_annule_etc == 'en_cours' ? 'selected' : '' }}>En cours</option>
                                <option value="delivre" {{ $commande->statut_en_attente_valide_annule_etc == 'delivre' ? 'selected' : '' }}>Livrée</option>
                                <option value="annule" {{ $commande->statut_en_attente_valide_annule_etc == 'annule' ? 'selected' : '' }}>Annulée</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            Mettre à jour le statut
                        </button>
                    </form>
                </div>
            </div>
            
            <!-- Produits de la commande -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Produits commandés (de ma boutique)</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Produit</th>
                                    <th>Quantité</th>
                                    <th>Prix unitaire</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($commande->produits->where('id_producteur_fk', auth()->id()) as $produit)
                                <tr>
                                    <td>{{ $produit->nom }}</td>
                                    <td>{{ $produit->pivot->quantite }}</td>
                                    <td>{{ number_format($produit->pivot->prix_unitaire, 2) }} Fcfa</td>
                                    <td>{{ number_format($produit->pivot->quantite * $produit->pivot->prix_unitaire, 2) }} Fcfa</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Informations client</h6>
                </div>
                <div class="card-body">
                    <p><strong>Nom:</strong> {{ $commande->user->prenom ?? 'N/A' }} {{ $commande->user->nom ?? '' }}</p>
                    <p><strong>Email:</strong> {{ $commande->user->email ?? 'N/A' }}</p>
                    <p><strong>Téléphone:</strong> {{ $commande->user->telephone ?? 'N/A' }}</p>
                    <p><strong>Adresse:</strong> {{ $commande->user->addresse ?? 'N/A' }}</p>
                    <p><strong>Date de commande:</strong> {{ $commande->date_commande->format('d/m/Y H:i') }}</p>
                </div>
            </div>
            
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Informations de paiement</h6>
                </div>
                <div class="card-body">
                    @if($commande->paiements->first())
                        <p><strong>Statut:</strong> 
                            <span class="badge bg-{{ $commande->paiements->first()->statut_paiement == 'complet' ? 'success' : 'warning' }}">
                                {{ ucfirst($commande->paiements->first()->statut_paiement) }}
                            </span>
                        </p>
                        <p><strong>Montant:</strong> {{ number_format($commande->paiements->first()->montant, 2) }} Fcfa</p>
                        <p><strong>Méthode:</strong> {{ $commande->paiements->first()->methode_TMoney_Flooz }}</p>
                        <p><strong>Date:</strong> {{ $commande->paiements->first()->date_paiement->format('d/m/Y H:i') }}</p>
                    @else
                        <p>Aucun paiement enregistré</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection