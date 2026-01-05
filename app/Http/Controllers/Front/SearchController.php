<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Produit;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('q');
        
        if (empty($query)) {
            return redirect()->route('boutique');
        }
        
        $products = Produit::where('nom', 'LIKE', '%' . $query . '%')
            ->orWhere('description', 'LIKE', '%' . $query . '%')
            ->orWhereHas('categorie', function($q) use ($query) {
                $q->where('nom', 'LIKE', '%' . $query . '%');
            })
            ->paginate(12);
        
        return view('front.search-results', compact('products', 'query'));
    }
}