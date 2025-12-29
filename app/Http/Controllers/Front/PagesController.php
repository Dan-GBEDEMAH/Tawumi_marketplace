<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
        $produits_en_avant = \App\Models\Produit::with('categorie', 'producteur')->where('est_en_avant', true)->limit(8)->get();
        return view('front.index', compact('produits_en_avant'));
    }

    public function boutique()
    {
        $produits = \App\Models\Produit::with('categorie', 'producteur')->get();
        return view('front.boutique', compact('produits'));
    }

    public function nouveautes()
    {
        $produits = \App\Models\Produit::with('categorie', 'producteur')->where('est_nouveaute', true)->get();
        return view('front.nouveautes', compact('produits'));
    }

    public function offres()
    {
        $produits = \App\Models\Produit::with('categorie', 'producteur')
            ->where(function($query) {
                $query->where('est_offre', true)
                     ->orWhere('est_gratuit', true)
                     ->orWhere('est_offre_weekend', true);
            })
            ->where(function($query) {
                $query->whereNull('date_debut_offre')
                     ->orWhere('date_debut_offre', '<=', now());
            })
            ->where(function($query) {
                $query->whereNull('date_fin_offre')
                     ->orWhere('date_fin_offre', '>=', now());
            })
            ->get();
        return view('front.offres', compact('produits'));
    }

    public function blogs()
    {
        return view('front.blogs');
    }

    public function about()
    {
        return view('front.about');
    }

    public function contact()
    {
        return view('front.contact');
    }

    public function producteurs()
    {
        return view('front.producteurs');
    }
}