<!DOCTYPE html>
<html>
<head>
    <title>Test Images TawumiConfirm</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        .product { border: 1px solid #ddd; padding: 20px; margin: 10px; }
        img { max-width: 200px; border: 2px solid #2ecc71; }
        .info { background: #f8f9fa; padding: 10px; margin: 10px 0; }
    </style>
</head>
<body>
    <h1>Test d'affichage des images</h1>
    @foreach($products as $product)
    <div class="product">
        <h3>{{ $product->nom }}</h3>
        <div class="info">
            <strong>Chemin BD:</strong> {{ $product->image_produit }}
        </div>
        <div class="info">
            <strong>URL générée:</strong> {{ asset('storage/' . $product->image_produit) }}
        </div>
        <div class="info">
            <strong>Fichier existe?</strong> {{ Storage::disk('public')->exists($product->image_produit) ? '✅ Oui' : '❌ Non' }}
        </div>
        <img src="{{ asset('storage/' . $product->image_produit) }}" alt="{{ $product->nom }}" onerror="this.src='https://via.placeholder.com/200x200?text=Image+Manquante'">
    </div>
    @endforeach
</body>
</html>