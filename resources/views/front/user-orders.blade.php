@extends('layouts.front')

@section('contentPage')

<!-- User Orders Section -->
<section class="user-orders-sec py-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="title mb-4">Mes Commandes</h2>
                
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                
                @if($orders->isEmpty())
                    <div class="text-center py-5">
                        <i class="fas fa-shopping-bag" style="font-size: 4rem; color: #ccc;"></i>
                        <h4 class="mt-3">Aucune commande</h4>
                        <p class="text-muted">Vous n'avez pas encore passé de commande.</p>
                        <a href="{{ route('boutique') }}" class="btn btn-primary">Commencer vos achats</a>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>ID Commande</th>
                                    <th>Date</th>
                                    <th>Statut</th>
                                    <th>Montant</th>
                                    <th>Mode de paiement</th>
                                    <th>Statut de paiement</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                <tr>
                                    <td>#{{ $order->id }}</td>
                                    <td>{{ $order->date_commande->format('d/m/Y H:i') }}</td>
                                    <td>
                                        @switch($order->statut_en_attente_valide_annule_etc)
                                            @case('en_attente')
                                                <span class="badge bg-warning">En attente</span>
                                                @break
                                            @case('validee')
                                                <span class="badge bg-success">Validée</span>
                                                @break
                                            @case('annulee')
                                                <span class="badge bg-danger">Annulée</span>
                                                @break
                                            @default
                                                <span class="badge bg-secondary">{{ $order->statut_en_attente_valide_annule_etc }}</span>
                                        @endswitch
                                    </td>
                                    <td>
                                        @if($order->paiements && $order->paiements->first())
                                            {{ number_format($order->paiements->first()->montant, 2) }} Fcfa
                                        @else
                                            0.00 Fcfa
                                        @endif
                                    </td>
                                    <td>
                                        @if($order->paiements && $order->paiements->first())
                                            @switch($order->paiements->first()->mode_paiement)
                                                @case('cash')
                                                    Paiement à la livraison
                                                    @break
                                                @case('card')
                                                    Carte bancaire
                                                    @break
                                                @case('mobile')
                                                    Paiement mobile
                                                    @break
                                                @default
                                                    {{ $order->paiements->first()->mode_paiement }}
                                            @endswitch
                                        @else
                                            Non spécifié
                                        @endif
                                    </td>
                                    <td>
                                        @if($order->paiements && $order->paiements->first())
                                            @switch($order->paiements->first()->statut_paiement)
                                                @case('complet')
                                                    <span class="badge bg-success">Complet</span>
                                                    @break
                                                @case('partiel')
                                                    <span class="badge bg-warning">Partiel</span>
                                                    @break
                                                @case('en_attente')
                                                    <span class="badge bg-info">En attente</span>
                                                    @break
                                                @case('echec')
                                                    <span class="badge bg-danger">Échec</span>
                                                    @break
                                                @default
                                                    <span class="badge bg-secondary">{{ $order->paiements->first()->statut_paiement }}</span>
                                            @endswitch
                                        @else
                                            <span class="badge bg-secondary">Non spécifié</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('checkout.success', $order->id) }}" class="btn btn-sm btn-primary me-1">
                                            <i class="fas fa-eye"></i> Détails
                                        </a>
                                        <a href="{{ route('invoice.download', $order->id) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-file-invoice"></i> Facture
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

@endsection