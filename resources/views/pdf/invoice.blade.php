<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Facture - Commande #{{ $order->id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .company-info {
            text-align: left;
        }
        .invoice-info {
            text-align: right;
        }
        .customer-info {
            margin-top: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .total-row {
            font-weight: bold;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1><i class="fas fa-file-invoice"></i> FACTURE</h1>
    </div>
    
    <div style="display: flex; justify-content: space-between;">
        <div class="company-info">
            <h3>TawumiConfirm</h3>
            <p>Adresse: Lomé</p>
            <p>Téléphone:+228 79768043</p>
            <p>Email: tawumi@gmail.com</p>
        </div>
        
        <div class="invoice-info">
            <p><strong>Facture #: </strong>INV-{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</p>
            <p><strong>Date: </strong>{{ $order->date_commande->format('d/m/Y') }}</p>
            <p><strong>Commande #: </strong>{{ $order->id }}</p>
        </div>
    </div>
    
    <div class="customer-info">
        <h4>Informations Client</h4>
        <p><strong>Nom complet: </strong>{{ $order->nom_client }}</p>
        <p><strong>Email: </strong>{{ $order->email_client }}</p>
        <p><strong>Téléphone: </strong>{{ $order->telephone_client }}</p>
        <p><strong>Adresse: </strong>{{ $order->adresse_livraison }}</p>
        <p><strong>Ville: </strong>{{ $order->ville_livraison }}</p>
        @if($order->code_postal_livraison)
        <p><strong>Code postal: </strong>{{ $order->code_postal_livraison }}</p>
        @endif
    </div>
    
    <table>
        <thead>
            <tr>
                <th>Produit</th>
                <th>Quantité</th>
                <th>Prix unitaire</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->produits as $produit)
            <tr>
                <td>{{ $produit->nom }}</td>
                <td>{{ $produit->pivot->quantite }}</td>
                <td>{{ $produit->pivot->prix_unitaire }} Fcfa</td>
                <td>{{ $produit->pivot->prix_unitaire * $produit->pivot->quantite }} Fcfa</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr class="total-row">
                <td colspan="3" style="text-align: right;">Sous-total:</td>
                <td>{{ $order->paiements->first()->montant - ($order->mode_livraison === 'express' ? 500 : 0) }} Fcfa</td>
            </tr>
            <tr class="total-row">
                <td colspan="3" style="text-align: right;">Frais de livraison:</td>
                <td>{{ $order->mode_livraison === 'express' ? '500 Fcfa' : 'Gratuit' }}</td>
            </tr>
            <tr class="total-row">
                <td colspan="3" style="text-align: right;">Total:</td>
                <td>{{ $order->paiements->first()->montant }} Fcfa</td>
            </tr>
        </tfoot>
    </table>
    
    <div class="payment-delivery-info" style="margin-top: 20px;">
        <div class="row" style="display: flex; justify-content: space-between;">
            <div class="payment-info" style="width: 48%;">
                <h4>Informations de paiement</h4>
                <p><strong>Mode de paiement: </strong>
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
            <div class="delivery-info" style="width: 48%;">
                <h4>Informations de livraison</h4>
                <p><strong>Mode de livraison: </strong>{{ ucfirst($order->mode_livraison) }}</p>
                <p><strong>Instructions: </strong>{{ $order->instructions_livraison ?? 'Aucune instruction spéciale' }}</p>
            </div>
        </div>
    </div>
    
    <div class="footer">
        <p>Merci pour votre confiance. Nous espérons vous revoir bientôt !</p>
        <p>Cette facture est valide sans signature.</p>
    </div>
</body>
</html>