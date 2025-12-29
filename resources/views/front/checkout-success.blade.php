@extends('layouts.front')

@section('contentPage')

<!-- Checkout Success Section -->
<section class="checkout-success-sec py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="success-card text-center">
                    <div class="success-icon mb-4">
                        <i class="fas fa-check-circle text-success" style="font-size: 4rem;"></i>
                    </div>
                    
                    <h2 class="title mb-3">Commande passée avec succès!</h2>
                    <p class="text-muted mb-4">Merci pour votre commande. Voici les détails de votre commande.</p>
                    
                    <div class="order-details card p-4 mb-4">
                        <h4 class="card-title mb-3">Détails de la commande #{{ $order->id }}</h4>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h6>Informations client</h6>
                                <p class="mb-1">{{ $order->nom_client }}</p>
                                <p class="mb-1">{{ $order->email_client }}</p>
                                <p class="mb-1">{{ $order->telephone_client }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6>Informations de livraison</h6>
                                <p class="mb-1">{{ $order->adresse_livraison }}</p>
                                <p class="mb-1">{{ $order->ville_livraison }} 
                                    @if($order->code_postal_livraison)
                                        {{ $order->code_postal_livraison }}
                                    @endif
                                </p>
                                <p class="mb-1">Livraison: {{ ucfirst($order->mode_livraison) }}</p>
                            </div>
                        </div>
                        
                        <div class="order-items">
                            <h6>Produits commandés</h6>
                            @foreach($order->produits as $produit)
                            <div class="order-item d-flex justify-content-between align-items-center mb-2 p-2 border-bottom">
                                <div class="item-info d-flex align-items-center">
                                    @if($produit->image)
                                        <img src="{{ asset($produit->image) }}" alt="{{ $produit->nom }}" class="img-fluid me-2" style="max-width: 50px;">
                                    @endif
                                    <div>
                                        <h6 class="mb-0">{{ $produit->nom }}</h6>
                                        <small class="text-muted">Quantité: 1</small>
                                    </div>
                                </div>
                                <div class="item-price">
                                    {{ number_format($produit->pivot->prix_unitaire, 2) }} Fcfa
                                </div>
                            </div>
                            @endforeach
                        </div>
                        
                        <div class="order-totals mt-3">
                            <div class="total-item d-flex justify-content-between">
                                <span>Sous-total:</span>
                                <span>{{ number_format($order->paiements->first()->montant - ($order->mode_livraison === 'express' ? 500 : 0), 2) }} Fcfa</span>
                            </div>
                            <div class="total-item d-flex justify-content-between">
                                <span>Livraison:</span>
                                <span>{{ $order->mode_livraison === 'express' ? '500' : '0' }} Fcfa</span>
                            </div>
                            <div class="total-item d-flex justify-content-between font-weight-bold">
                                <strong>Total:</strong>
                                <strong>{{ number_format($order->paiements->first()->montant, 2) }} Fcfa</strong>
                            </div>
                        </div>
                    </div>
                    
                    <div class="payment-info card p-4 mb-4">
                        <h5 class="card-title mb-3">Informations de paiement</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <p class="mb-1"><strong>Mode de paiement:</strong> 
                                    @switch($order->paiements->first()->mode_paiement)
                                        @case('cash')
                                            Paiement à la livraison
                                            @break
                                        @case('card')
                                            Carte bancaire
                                            @break
                                        @case('mobile')
                                            Paiement mobile (Flooz, Mixx By Yas)
                                            @break
                                        @default
                                            {{ $order->paiements->first()->mode_paiement }}
                                    @endswitch
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-1"><strong>Statut de paiement:</strong> 
                                    @switch($order->paiements->first()->statut_paiement)
                                        @case('complet')
                                            <span class="text-success">Complet</span>
                                            @break
                                        @case('partiel')
                                            <span class="text-warning">Partiel</span>
                                            @break
                                        @case('en_attente')
                                            <span class="text-info">En attente</span>
                                            @break
                                        @case('echec')
                                            <span class="text-danger">Échec</span>
                                            @break
                                        @default
                                            <span class="text-muted">{{ $order->paiements->first()->statut_paiement }}</span>
                                    @endswitch
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="order-status card p-4 mb-4">
                        <h5 class="card-title mb-3">Statut de la commande</h5>
                        <div class="status-item d-flex align-items-center mb-2">
                            <span class="status-icon me-3">
                                @if($order->statut_en_attente_valide_annule_etc === 'en_attente')
                                    <i class="fas fa-clock text-info"></i>
                                @elseif($order->statut_en_attente_valide_annule_etc === 'validee')
                                    <i class="fas fa-check-circle text-success"></i>
                                @elseif($order->statut_en_attente_valide_annule_etc === 'annulee')
                                    <i class="fas fa-times-circle text-danger"></i>
                                @else
                                    <i class="fas fa-question-circle text-secondary"></i>
                                @endif
                            </span>
                            <span class="status-text">
                                @switch($order->statut_en_attente_valide_annule_etc)
                                    @case('en_attente')
                                        En attente
                                        @break
                                    @case('validee')
                                        Validée
                                        @break
                                    @case('annulee')
                                        Annulée
                                        @break
                                    @default
                                        {{ $order->statut_en_attente_valide_annule_etc }}
                                @endswitch
                            </span>
                        </div>
                    </div>
                    
                    <div class="action-buttons">
                        <a href="{{ route('home') }}" class="btn btn-primary me-2">
                            <i class="fas fa-home me-1"></i>Retour à l'accueil
                        </a>
                        <a href="{{ route('boutique') }}" class="btn btn-outline-primary me-2">
                            <i class="fas fa-shopping-cart me-1"></i>Continuer les achats
                        </a>
                        <a href="{{ route('user.orders') }}" class="btn btn-success me-2">
                            <i class="fas fa-eye me-1"></i>Voir mes commandes
                        </a>
                        <a href="{{ route('invoice.download', $order->id) }}" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-file-invoice me-1"></i>Télécharger la facture
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection