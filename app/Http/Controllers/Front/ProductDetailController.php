<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductDetailController extends Controller
{
    public function show($id)
    {
        $produit = Produit::with('producteur', 'categorie')->findOrFail($id);
        
        return view('front.product-detail', compact('produit'));
    }
    
    public function getDetail(Request $request)
    {
        try {
            // Validate that id is provided
            if (!$request->id) {
                return response()->json([
                    'success' => false,
                    'message' => 'ID du produit manquant',
                ]);
            }
            
            $produit = Produit::with('producteur', 'categorie')->findOrFail($request->id);
            
            // Check if product is in favorites (using session-based favorites)
            $favorites = session()->get('favorites', []);
            $isFavorite = in_array($produit->id, $favorites);
            
            // Convert to array to avoid serialization issues with accessors
            $produitArray = [
                'id' => $produit->id,
                'nom' => $produit->nom,
                'description' => $produit->description,
                'prix' => $produit->prix,
                'prix_original' => $produit->prix_original,
                'est_en_promo' => $produit->est_en_promo,
                'stock_disponible' => $produit->stock_disponible,
                'image' => $produit->image,
                'est_nouveaute' => $produit->est_nouveaute,
                'est_offre' => $produit->est_offre,
                'reduction' => $produit->reduction,
                'est_en_avant' => $produit->est_en_avant,
                'categorie' => $produit->categorie ? [
                    'id' => $produit->categorie->id,
                    'nom' => $produit->categorie->nom,
                ] : null,
            ];
            
            return response()->json([
                'success' => true,
                'produit' => $produitArray,
                'producteur' => $produit->producteur, // This can be null if no producteur exists
                'is_favorite' => $isFavorite,
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Produit non trouvé',
            ]);
        } catch (Exception $e) {
            
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors du chargement des détails du produit: ' . $e->getMessage(),
            ]);
        }
    }
}