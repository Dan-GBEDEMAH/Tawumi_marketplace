<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index()
    {
        // Get user's favorite products from session
        $favoriteIds = session()->get('favorites', []);
        $favoriteProducts = Produit::whereIn('id', $favoriteIds)->get();
        
        return view('front.favorite', compact('favoriteProducts'));
    }

    public function toggle(Request $request)
    {
        $productId = $request->input('product_id');
        
        // Validate the product exists
        $product = Produit::find($productId);
        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Produit non trouvé']);
        }

        // Get current favorites from session
        $favorites = session()->get('favorites', []);
        
        // Check if product is already in favorites
        $key = array_search($productId, $favorites);
        
        if ($key !== false) {
            // Remove from favorites
            unset($favorites[$key]);
            $action = 'removed';
        } else {
            // Add to favorites
            $favorites[] = $productId;
            $action = 'added';
        }
        
        // Update session
        session()->put('favorites', array_values($favorites));
        
        return response()->json([
            'success' => true,
            'action' => $action,
            'message' => $action === 'added' ? 'Produit ajouté aux favoris' : 'Produit retiré des favoris',
            'count' => count($favorites)
        ]);
    }

    public function clear()
    {
        // Clear all favorites from session
        session()->forget('favorites');
        
        return response()->json([
            'success' => true,
            'message' => 'Favoris effacés avec succès',
            'count' => 0
        ]);
    }
}