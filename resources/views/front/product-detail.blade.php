<div class="product-detail-modal">
    <div class="product-detail-content">
        <div class="product-detail-header">
            <h3>{{ $produit->nom }}</h3>
            <button class="close-modal">&times;</button>
        </div>
        
        <div class="product-detail-body">
            <div class="row">
                <div class="col-md-6">
                    <img src="{{ asset($produit->image) }}" alt="{{ $produit->nom }}" class="img-fluid">
                </div>
                
                <div class="col-md-6">
                    <div class="product-info">
                        <h4>{{ $produit->nom }}</h4>
                        
                        <div class="product-price">
                            <span class="current-price">{{ $produit->prix }} Fcfa</span>
                            @if($produit->est_en_promo)
                                <span class="old-price">{{ $produit->prix_original }} Fcfa</span>
                            @endif
                        </div>
                        
                        <p class="product-description">{{ $produit->description }}</p>
                        
                        <div class="product-meta">
                            <p><strong>Catégorie:</strong> {{ $produit->categorie ? $produit->categorie->nom : 'Non spécifiée' }}</p>
                            <p><strong>Stock disponible:</strong> {{ $produit->stock_disponible }}</p>
                        </div>
                        
                        <div class="product-producer-info">
                            <h5>Informations sur le producteur</h5>
                            <p><i class="fa-solid fa-user"></i> <strong>Nom:</strong> {{ $produit->producteur ? $produit->producteur->prenom . ' ' . $produit->producteur->nom : 'Producteur inconnu' }}</p>
                            <p><i class="fa-solid fa-location-dot"></i> <strong>Adresse:</strong> {{ $produit->producteur ? $produit->producteur->addresse : 'Adresse inconnue' }}</p>
                            <p><i class="fa-solid fa-phone"></i> <strong>Téléphone:</strong> {{ $produit->producteur ? $produit->producteur->telephone : 'Téléphone inconnu' }}</p>
                        </div>
                        
                        <div class="product-actions">
                            <form method="POST" action="{{ route('cart.add') }}" class="d-inline">
                                @csrf
                                <input type="hidden" name="produit_id" value="{{ $produit->id }}">
                                <button type="submit" class="btn btn-success">
                                    Ajouter au panier <i class="fa-solid fa-cart-shopping"></i>
                                </button>
                            </form>
                            
                            <button class="btn btn-outline-danger add-to-fav" data-product-id="{{ $produit->id }}">
                                <i class="fa-solid fa-heart {{ in_array($produit->id, session()->get('favorites', [])) ? 'active' : '' }}"></i>
                                Favoris
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>