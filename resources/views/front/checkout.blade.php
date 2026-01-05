@extends('layouts.front')

@section('contentPage')

<!-- Checkout Section -->
<section class="checkout-sec py-5">
    <div class="container">
        <h2 class="title text-center mb-5">Passer la commande</h2>
        
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
                <li class="breadcrumb-item"><a href="{{ route('cart') }}">Panier</a></li>
                <li class="breadcrumb-item active" aria-current="page">Paiement</li>
            </ol>
        </nav>

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="row">
            <div class="col-lg-8">
                <div class="checkout-form">
                    <h4>Informations de livraison</h4>
                    
                    <form id="checkout-form" action="{{ route('checkout.process') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="firstName">Prénom *</label>
                                    <input type="text" class="form-control" id="firstName" name="first_name" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lastName">Nom *</label>
                                    <input type="text" class="form-control" id="lastName" name="last_name" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="email">Email *</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="phone">Téléphone *</label>
                            <input type="tel" class="form-control" id="phone" name="phone" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="address">Adresse *</label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="Numéro de rue, nom de la rue" required>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="city">Ville *</label>
                                    <input type="text" class="form-control" id="city" name="city" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="postalCode">Code postal</label>
                                    <input type="text" class="form-control" id="postalCode" name="postal_code">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="instructions">Instructions spéciales (facultatif)</label>
                            <textarea class="form-control" id="instructions" name="instructions" rows="3" placeholder="Notes de livraison, instructions spéciales..."></textarea>
                        </div>
                        
                        <h4 class="mt-4">Méthode de livraison</h4>
                        <div class="delivery-options">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="delivery" id="delivery1" value="standard" checked>
                                <label class="form-check-label" for="delivery1">
                                    <strong>Livraison standard (2-3 jours ouvrables)</strong> <span class="float-end">Gratuite</span>
                                </label>
                                <p class="text-muted small">Livraison à domicile standard</p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="delivery" id="delivery2" value="express">
                                <label class="form-check-label" for="delivery2">
                                    <strong>Livraison express (1 jour ouvrable)</strong> <span class="float-end">500 Fcfa</span>
                                </label>
                                <p class="text-muted small">Livraison express le lendemain</p>
                            </div>
                        </div>
                        
                        <h4 class="mt-4">Méthode de paiement</h4>
                        <div class="payment-options">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment" id="payment1" value="cash" checked>
                                <label class="form-check-label" for="payment1">
                                    <i class="fas fa-money-bill-wave"></i> Paiement à la livraison
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment" id="payment2" value="card">
                                <label class="form-check-label" for="payment2">
                                    <i class="fas fa-credit-card"></i> Carte bancaire
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment" id="payment3" value="mobile">
                                <label class="form-check-label" for="payment3">
                                    <i class="fas fa-mobile-alt"></i> Paiement mobile (Flooz, Mixx By Yas)
                                </label>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="order-summary">
                    <h4>Votre commande</h4>
                    
                    <div class="order-items">
                        @if(isset($cartItems))
                            @foreach($cartItems as $item)
                            @if($item->produit)
                            <div class="order-item">
                                <div class="item-info">
                                    <img src="{{ asset($item->produit->image) }}" alt="{{ $item->produit->nom }}" class="img-fluid" style="max-width: 60px; max-height: 60px; object-fit: cover;">
                                    <div>
                                        <h6>{{ $item->produit->nom }}</h6>
                                        <p>{{ $item->quantite ?? 1 }} x {{ $item->produit->prix }} Fcfa</p>

                                    </div>
                                </div>
                                <span>{{ ($item->produit->prix * ($item->quantite ?? 1)) }} Fcfa</span>
                            </div>
                            @else
                            <div class="order-item">
                                <div class="item-info">
                                    <div>
                                        <h6>Produit indisponible</h6>
                                        <p>Ce produit n'est plus disponible.</p>
                                    </div>
                                </div>
                                <span>0 Fcfa</span>
                            </div>
                            @endif
                            @endforeach
                        @endif
                    </div>
                    
                    <div class="order-totals">
                        <div class="total-item">
                            <span>Sous-total</span>
                            <span>{{ $total }} Fcfa</span>
                        </div>
                        <div class="total-item">
                            <span>Livraison</span>
                            <span>Gratuite</span>
                        </div>
                        <div class="total-item">
                            <span>Total</span>
                            <span>{{ $total }} Fcfa</span>
                        </div>
                    </div>
                    
                    <button type="submit" form="checkout-form" class="btn btn-success btn-block mt-3">
                        Passer la commande <i class="fas fa-lock"></i>
                    </button>
                    
                    <div class="secure-checkout">
                        <i class="fas fa-lock"></i> Paiement sécurisé
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection