@extends('producteur.layout')

@section('title', 'Mes commandes')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Mes commandes</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Commandes pour mes produits</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Client</th>
                            <th>Date</th>
                            <th>Statut</th>
                            <th>Montant</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($commandes as $commande)
                        <tr>
                            <td>{{ $commande->id }}</td>
                            <td>{{ $commande->user->prenom ?? 'N/A' }} {{ $commande->user->nom ?? '' }}</td>
                            <td>{{ $commande->date_commande->format('d/m/Y H:i') }}</td>
                            <td>
                                <span class="badge bg-{{ 
                                    $commande->statut_en_attente_valide_annule_etc == 'en_attente' ? 'warning' : 
                                    ($commande->statut_en_attente_valide_annule_etc == 'en_cours' ? 'info' : 
                                    ($commande->statut_en_attente_valide_annule_etc == 'delivre' ? 'success' : 'danger')) 
                                }}">
                                    {{ str_replace(['en_attente', 'en_cours', 'delivre', 'annule'], ['En attente', 'En cours', 'Livrée', 'Annulée'], $commande->statut_en_attente_valide_annule_etc) }}
                                </span>
                            </td>
                            <td>
                                @if($commande->paiements->first())
                                    {{ number_format($commande->paiements->first()->montant, 2) }} Fcfa
                                @else
                                    0.00 Fcfa
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('producteur.orders.edit', $commande->id) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-eye"></i>
                                </a>
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