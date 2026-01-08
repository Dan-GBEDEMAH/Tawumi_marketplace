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
                                <input class="form-check-input" type="radio" name="delivery" id="delivery1" value="standard" checked onchange="handleDeliveryChange()">
                                <label class="form-check-label" for="delivery1">
                                    <strong>Livraison standard (2-3 jours ouvrables)</strong> <span class="float-end">Gratuite</span>
                                </label>
                                <p class="text-muted small">Livraison à domicile standard</p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="delivery" id="delivery2" value="express" onchange="handleDeliveryChange()">
                                <label class="form-check-label" for="delivery2">
                                    <strong>Livraison express (1 jour ouvrable)</strong> <span class="float-end">500 Fcfa</span>
                                </label>
                                <p class="text-muted small">Livraison express le lendemain</p>
                            </div>
                        </div>
                        
                        <h4 class="mt-4">Méthode de paiement</h4>
                        <div class="payment-options">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment" id="payment1" value="cash" checked onchange="handlePaymentChange()">
                                <label class="form-check-label" for="payment1">
                                    <i class="fas fa-money-bill-wave"></i> Paiement à la livraison
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment" id="payment2" value="card" onchange="handlePaymentChange()">
                                <label class="form-check-label" for="payment2">
                                    <i class="fas fa-credit-card"></i> Carte bancaire
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment" id="payment3" value="mobile" onchange="handlePaymentChange()">
                                <label class="form-check-label" for="payment3">
                                    <i class="fas fa-mobile-alt"></i> Paiement mobile (Flooz, Mixx By Yas)
                                </label>
                            </div>
                        </div>
                        
                        <!-- Options de carte bancaire (cachées par défaut) -->
                        <div id="bank-options" class="mt-3" style="display: none;">
                            <h5>Choisissez votre banque</h5>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="bank" id="bank1" value="UTB" disabled>
                                <label class="form-check-label" for="bank1">
                                    <img src="{{ asset('assets/images/-UTB-VISA.jpg') }}" alt="UTB Logo" width="30" height="30" class="me-2" onerror="this.onerror=null; this.src='data:image/svg+xml;utf8,<svg xmlns=&quot;http://www.w3.org/2000/svg&quot; width=&quot;30&quot; height=&quot;30&quot; viewBox=&quot;0 0 30 30&quot;><rect width=&quot;30&quot; height=&quot;30&quot; fill=&quot;%23003366&quot;/><text x=&quot;15&quot; y=&quot;19&quot; font-family=&quot;Arial&quot; font-size=&quot;10&quot; fill=&quot;white&quot; text-anchor=&quot;middle&quot;>UTB</text></svg>';">
                                    UTB (Union Togolaise de Banque)
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="bank" id="bank2" value="Ecobank" disabled>
                                <label class="form-check-label" for="bank2">
                                    <img src="{{ asset('assets/images/ecobank.png') }}" alt="Ecobank Logo" width="30" height="30" class="me-2" onerror="this.onerror=null; this.src='data:image/svg+xml;utf8,<svg xmlns=&quot;http://www.w3.org/2000/svg&quot; width=&quot;30&quot; height=&quot;30&quot; viewBox=&quot;0 0 30 30&quot;><rect width=&quot;30&quot; height=&quot;30&quot; fill=&quot;%230066CC&quot;/><text x=&quot;15&quot; y=&quot;19&quot; font-family=&quot;Arial&quot; font-size=&quot;8&quot; fill=&quot;white&quot; text-anchor=&quot;middle&quot;>ECOBANK</text></svg>';">
                                    Ecobank Togo
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="bank" id="bank3" value="Orabank" disabled>
                                <label class="form-check-label" for="bank3">
                                    <img src="{{ asset('assets/images/orabank.jpg') }}" alt="Orabank Logo" width="30" height="30" class="me-2" onerror="this.onerror=null; this.src='data:image/svg+xml;utf8,<svg xmlns=&quot;http://www.w3.org/2000/svg&quot; width=&quot;30&quot; height=&quot;30&quot; viewBox=&quot;0 0 30 30&quot;><rect width=&quot;30&quot; height=&quot;30&quot; fill=&quot;%23FF6600&quot;/><text x=&quot;15&quot; y=&quot;19&quot; font-family=&quot;Arial&quot; font-size=&quot;8&quot; fill=&quot;white&quot; text-anchor=&quot;middle&quot;>ORABANK</text></svg>';">
                                    Orabank Togo
                                </label>
                            </div>
                        </div>
                        
                        <!-- Options de paiement mobile (cachées par défaut) -->
                        <div id="mobile-options" class="mt-3" style="display: none;">
                            <h5>Choisissez votre méthode de paiement mobile</h5>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="mobile" id="mobile1" value="Flooz" disabled>
                                <label class="form-check-label" for="mobile1">
                                    <img src="{{ asset('assets/images/flooz.jpg') }}" alt="Flooz Logo" width="30" height="30" class="me-2" onerror="this.onerror=null; this.src='data:image/svg+xml;utf8,<svg xmlns=&quot;http://www.w3.org/2000/svg&quot; width=&quot;30&quot; height=&quot;30&quot; viewBox=&quot;0 0 30 30&quot;><rect width=&quot;30&quot; height=&quot;30&quot; fill=&quot;%2300AA00&quot;/><text x=&quot;15&quot; y=&quot;19&quot; font-family=&quot;Arial&quot; font-size=&quot;10&quot; fill=&quot;white&quot; text-anchor=&quot;middle&quot;>FLOOZ</text></svg>';">
                                    Flooz
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="mobile" id="mobile2" value="Mixx" disabled>
                                <label class="form-check-label" for="mobile2">
                                    <img src="{{ asset('assets/images/yas.jpg') }}" alt="Mixx By Yas Logo" width="30" height="30" class="me-2" onerror="this.onerror=null; this.src='data:image/svg+xml;utf8,<svg xmlns=&quot;http://www.w3.org/2000/svg&quot; width=&quot;30&quot; height=&quot;30&quot; viewBox=&quot;0 0 30 30&quot;><rect width=&quot;30&quot; height=&quot;30&quot; fill=&quot;%23CC0000&quot;/><text x=&quot;15&quot; y=&quot;19&quot; font-family=&quot;Arial&quot; font-size=&quot;8&quot; fill=&quot;white&quot; text-anchor=&quot;middle&quot;>MIXX</text></svg>';">
                                    Mixx By Yas
                                </label>
                            </div>
                        </div>
                    </form>
                </div>
                
                <script>
                    function handleDeliveryChange() {
                        const deliveryValue = document.querySelector('input[name="delivery"]:checked').value;
                        const cashOption = document.getElementById('payment1');
                        
                        // Si livraison à domicile sélectionnée, sélectionner automatiquement le paiement en espèces
                        if (deliveryValue === 'standard' || deliveryValue === 'express') {
                            cashOption.checked = true;
                            
                            // Mettre à jour l'affichage des options de paiement
                            handlePaymentChange();
                        }
                    }
                    
                    function handlePaymentChange() {
                        const paymentValue = document.querySelector('input[name="payment"]:checked').value;
                        
                        // Réinitialiser les options bancaires et mobile
                        document.querySelectorAll('input[name="bank"]').forEach(radio => {
                            radio.disabled = true;
                        });
                        document.querySelectorAll('input[name="mobile"]').forEach(radio => {
                            radio.disabled = true;
                        });
                        
                        // Afficher/masquer les options selon le mode de paiement
                        if (paymentValue === 'card') {
                            document.getElementById('bank-options').style.display = 'block';
                            document.getElementById('mobile-options').style.display = 'none';
                            
                            // Activer les options de banque
                            document.querySelectorAll('input[name="bank"]').forEach(radio => {
                                radio.disabled = false;
                            });
                        } else if (paymentValue === 'mobile') {
                            document.getElementById('bank-options').style.display = 'none';
                            document.getElementById('mobile-options').style.display = 'block';
                            
                            // Activer les options de paiement mobile
                            document.querySelectorAll('input[name="mobile"]').forEach(radio => {
                                radio.disabled = false;
                            });
                        } else if (paymentValue === 'cash') {
                            document.getElementById('bank-options').style.display = 'none';
                            document.getElementById('mobile-options').style.display = 'none';
                        }
                    }
                    
                    // Initialiser au chargement de la page
                    document.addEventListener('DOMContentLoaded', function() {
                        handlePaymentChange();
                    });
                </script>
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