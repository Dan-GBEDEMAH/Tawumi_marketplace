<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Produit;
use App\Models\Commande;
use App\Models\Paiement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProducteurDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Vérifier que l'utilisateur est un producteur
        if (Auth::user()->role !== 'producteur') {
            abort(403, 'Accès non autorisé');
        }

        $producteurId = Auth::id();
        
        // Calculer les indicateurs clés pour le producteur
        $totalProduits = Produit::where('id_producteur_fk', $producteurId)->count();
        $totalCommandes = Commande::whereHas('produits', function($query) use ($producteurId) {
            $query->where('id_producteur_fk', $producteurId);
        })->count();
        
        // Pour les commandes, on suppose qu'il y a une table pivot entre commandes et produits
        $totalRevenus = Paiement::whereHas('commande.produits', function($query) use ($producteurId) {
            $query->where('id_producteur_fk', $producteurId);
        })->sum('montant');

        $producteur = Auth::user();
        
        return view('producteur.dashboard.index', compact(
            'totalProduits', 
            'totalCommandes', 
            'totalRevenus',
            'producteur'
        ));
    }

    // Gestion des produits du producteur
    public function products()
    {
        if (Auth::user()->role !== 'producteur') {
            abort(403, 'Accès non autorisé');
        }

        $produits = Produit::where('id_producteur_fk', Auth::id())->get();
        return view('producteur.products.index', compact('produits'));
    }

    public function createProduct()
    {
        if (Auth::user()->role !== 'producteur') {
            abort(403, 'Accès non autorisé');
        }

        $categories = Categorie::all();
        
        return view('producteur.products.create', compact('categories'));
    }

    public function storeProduct(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required',
            'prix_unitaire' => 'required|numeric',
            'stock_disponible' => 'required|integer',
            'id_categorie_fk' => 'required|exists:categories,id',
            'image_produit' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'est_nouveaute' => 'boolean',
            'est_offre' => 'boolean',
            'reduction' => 'nullable|numeric|min:0|max:100|required_if:est_offre,1',
            'est_en_avant' => 'boolean',
            'est_gratuit' => 'boolean',
            'quantite_limitee' => 'nullable|integer|min:1',
            'est_offre_weekend' => 'boolean',
            'date_debut_offre' => 'nullable|date',
            'date_fin_offre' => 'nullable|date|after_or_equal:date_debut_offre',
        ]);

        $data = $request->except('image_produit');
        $data['id_producteur_fk'] = Auth::id();
        
        if ($request->hasFile('image_produit')) {
            $image = $request->file('image_produit');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/products', $imageName);
            $data['image_produit'] = 'products/' . $imageName;
        }

        Produit::create($data);

        return redirect()->route('producteur.products')->with('success', 'Produit ajouté avec succès!');
    }

    public function editProduct($id)
    {
        if (Auth::user()->role !== 'producteur') {
            abort(403, 'Accès non autorisé');
        }

        $produit = Produit::where('id_producteur_fk', Auth::id())->findOrFail($id);
        $categories = Categorie::all();
        
        return view('producteur.products.edit', compact('produit', 'categories'));
    }

    public function updateProduct(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required',
            'prix_unitaire' => 'required|numeric',
            'stock_disponible' => 'required|integer',
            'id_categorie_fk' => 'required|exists:categories,id',
            'image_produit' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'est_nouveaute' => 'boolean',
            'est_offre' => 'boolean',
            'reduction' => 'nullable|numeric|min:0|max:100|required_if:est_offre,1',
            'est_en_avant' => 'boolean',
            'est_gratuit' => 'boolean',
            'quantite_limitee' => 'nullable|integer|min:1',
            'est_offre_weekend' => 'boolean',
            'date_debut_offre' => 'nullable|date',
            'date_fin_offre' => 'nullable|date|after_or_equal:date_debut_offre',
        ]);

        $produit = Produit::where('id_producteur_fk', Auth::id())->findOrFail($id);
        $data = $request->except('image_produit');
        
        if ($request->hasFile('image_produit')) {
            // Supprimer l'ancienne image si elle existe
            if ($produit->image_produit) {
                $oldImagePath = storage_path('app/public/' . $produit->image_produit);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            
            $image = $request->file('image_produit');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/products', $imageName);
            $data['image_produit'] = 'products/' . $imageName;
        }

        $produit->update($data);

        return redirect()->route('producteur.products')->with('success', 'Produit mis à jour avec succès!');
    }

    public function deleteProduct($id)
    {
        if (Auth::user()->role !== 'producteur') {
            abort(403, 'Accès non autorisé');
        }

        $produit = Produit::where('id_producteur_fk', Auth::id())->findOrFail($id);
        $produit->delete();

        return redirect()->route('producteur.products')->with('success', 'Produit supprimé avec succès!');
    }

    // Gestion des commandes du producteur
    public function orders()
    {
        if (Auth::user()->role !== 'producteur') {
            abort(403, 'Accès non autorisé');
        }

        // Récupérer les commandes liées aux produits du producteur
        $commandes = Commande::whereHas('produits', function($query) {
            $query->where('id_producteur_fk', Auth::id());
        })->with('paiements')->get();
        
        return view('producteur.orders.index', compact('commandes'));
    }

    public function editOrder($id)
    {
        if (Auth::user()->role !== 'producteur') {
            abort(403, 'Accès non autorisé');
        }

        $commande = Commande::whereHas('produits', function($query) {
            $query->where('id_producteur_fk', Auth::id());
        })->findOrFail($id);
        
        return view('producteur.orders.edit', compact('commande'));
    }

    public function updateOrder(Request $request, $id)
    {
        $request->validate([
            'statut_en_attente_valide_annule_etc' => 'required|in:en_attente,en_cours,delivre,annule',
        ]);

        $commande = Commande::whereHas('produits', function($query) {
            $query->where('id_producteur_fk', Auth::id());
        })->findOrFail($id);
        
        $commande->update(['statut_en_attente_valide_annule_etc' => $request->statut_en_attente_valide_annule_etc]);

        return redirect()->route('producteur.orders')->with('success', 'Commande mise à jour avec succès!');
    }

    // Statistiques pour le producteur
    public function reports()
    {
        if (Auth::user()->role !== 'producteur') {
            abort(403, 'Accès non autorisé');
        }

        // Calculer les statistiques pour le producteur
        $statistiques = [
            'total_revenus' => Paiement::whereHas('commande.produits', function($query) {
                $query->where('id_producteur_fk', Auth::id());
            })->sum('montant'),
            'total_commandes' => Commande::whereHas('produits', function($query) {
                $query->where('id_producteur_fk', Auth::id());
            })->count(),
            'commandes_ce_mois' => Commande::whereHas('produits', function($query) {
                $query->where('id_producteur_fk', Auth::id());
            })->whereMonth('date_commande', now()->month)->count(),
        ];

        return view('producteur.reports.index', compact('statistiques'));
    }
}
