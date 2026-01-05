@extends('layouts.front')

@section('contentPage')

<!-- Cart Section -->
<section class="cart-sec py-5">
    <div class="container">
        <h2 class="title text-center mb-5">Votre Panier</h2>
        
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
                <li class="breadcrumb-item active" aria-current="page">Panier</li>
            </ol>
        </nav>

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

        <div class="row">
            <div class="col-lg-12">
                @if(isset($cartItems) && $cartItems->count() > 0)
                    <!-- Cart Table -->
                    <div class="table-responsive">
                        <table class="table cart-table">
                            <thead>
                                <tr>
                                    <th>Produit</th>
                                    <th>Prix</th>
                                    <th>Quantité</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cartItems as $item)
                                @if($item->produit)
                                <tr>
                                    <td>
                                        <div class="cart-product">
                                            <img src="{{ asset($item->produit->image) }}" alt="{{ $item->produit->nom }}" class="img-fluid" style="max-width: 80px; max-height: 80px; object-fit: cover;">
                                            <div class="product-info">
                                                <h5>{{ $item->produit->nom }}</h5>
                                                <p>{{ $item->produit->description }}</p>
                                                
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $item->produit->prix }} Fcfa</td>
                                    <td>
                                        <div class="quantity-control">
                                            <button type="button" class="btn btn-sm btn-outline-secondary" data-item-id="{{ $item->id ?? $item->produit->id }}" data-action="remove" onclick="updateQuantity(this)">-</button>
                                            <span class="mx-2" id="quantity-{{ $item->id ?? $item->produit->id }}">{{ $item->quantite ?? 1 }}</span>
                                            <button type="button" class="btn btn-sm btn-outline-secondary" data-item-id="{{ $item->id ?? $item->produit->id }}" data-action="add" onclick="updateQuantity(this)">+</button>
                                        </div>
                                    </td>
                                    <td id="item-total-{{ $item->id ?? $item->produit->id }}">{{ $item->produit->prix * ($item->quantite ?? 1) }} Fcfa</td>
                                    <td>
                                        <form action="{{ route('cart.remove', $item->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('POST')
                                            <button type="submit" class="btn btn-danger btn-sm remove-item" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @else
                                <tr>
                                    <td colspan="5" class="text-center">
                                        <div class="alert alert-warning mb-0">
                                            Ce produit n'est plus disponible. <a href="{{ route('cart.remove', $item->id) }}" onclick="event.preventDefault(); document.getElementById('remove-form-{{ $item->id }}').submit();">Supprimer du panier</a>.
                                            <form id="remove-form-{{ $item->id }}" action="{{ route('cart.remove', $item->id) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('POST')
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-cart text-center py-5">
                        <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
                        <h4>Votre panier est vide</h4>
                        <p>Ajoutez des produits à votre panier pour commencer vos achats</p>
                        <a href="{{ route('boutique') }}" class="btn btn-success">Explorer les produits</a>
                    </div>
                @endif
            </div>
        </div>

        @if(isset($cartItems) && $cartItems->count() > 0)
        <div class="row mt-5">
            <div class="col-lg-6">
                <div class="cart-actions">
                    <a href="{{ route('boutique') }}" class="btn btn-outline-success">
                        <i class="fas fa-arrow-left"></i> Continuer les achats
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="cart-summary">
                    <h4>Récapitulatif de la commande</h4>
                    <div class="summary-item">
                        <span>Sous-total</span>
                        <span>{{ $total }} Fcfa</span>
                    </div>
                    <div class="summary-item">
                        <span>Livraison</span>
                        <span>Gratuite</span>
                    </div>
                    <div class="summary-item total">
                        <span>Total</span>
                        <span>{{ $total }} Fcfa</span>
                    </div>
                    <a href="{{ route('checkout') }}" class="btn btn-success btn-block mt-3">
                        Passer à la caisse <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
        @endif
    </div>
</section>

<script>
function updateQuantity(button) {
    const itemId = button.getAttribute('data-item-id');
    const action = button.getAttribute('data-action');
    
    fetch('/cart/update', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            item_id: itemId,
            action: action
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Mettre à jour l'affichage de la quantité
            const quantitySpan = document.querySelector(`#quantity-${itemId}`);
            if (quantitySpan) {
                // Mettre à jour la quantité affichée
                fetch(window.location.href)
                .then(response => response.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const newQuantitySpan = doc.querySelector(`#quantity-${itemId}`);
                    if (newQuantitySpan) {
                        quantitySpan.textContent = newQuantitySpan.textContent;
                    }
                    // Mettre à jour le prix total de l'article
                    const currentItemTotal = document.querySelector(`#item-total-${itemId}`);
                    const newItemTotal = doc.querySelector(`#item-total-${itemId}`);
                    if (currentItemTotal && newItemTotal) {
                        currentItemTotal.textContent = newItemTotal.textContent;
                    }
                    // Mettre à jour le total du panier
                    const currentCartTotal = document.querySelector('.summary-item.total span:last-child');
                    const newCartTotal = doc.querySelector('.summary-item.total span:last-child');
                    if (currentCartTotal && newCartTotal) {
                        currentCartTotal.textContent = newCartTotal.textContent;
                    }
                });
            }
        } else {
            alert('Erreur: ' + (data.message || 'Impossible de mettre à jour la quantité'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Une erreur est survenue lors de la mise à jour de la quantité');
    });
}
</script>

@endsection