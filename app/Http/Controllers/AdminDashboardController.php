<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\User;
use App\Models\Produit;
use App\Models\Commande;
use App\Models\Paiement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Vérifier que l'utilisateur est un admin
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Accès non autorisé');
        }

        // Calculer les indicateurs clés
        $totalUsers = User::count();
        $totalProducteurs = User::where('role', 'producteur')->count();
        $totalCommercants = User::where('role', 'commerçant')->count();
        $totalAdmins = User::where('role', 'admin')->count();
        
        $totalProduits = Produit::count();
        $totalCommandes = Commande::count();
        $totalCommandesEnAttente = Commande::where('statut_en_attente_valide_annule_etc', 'en_attente')->count();
        $totalCommandesValidees = Commande::where('statut_en_attente_valide_annule_etc', 'validee')->count();
        $totalCommandesAnnulees = Commande::where('statut_en_attente_valide_annule_etc', 'annulee')->count();
        
        $totalRevenus = Paiement::where('statut_paiement', 'complet')->sum('montant');

        return view('admin.dashboard.index', compact(
            'totalUsers', 
            'totalProducteurs', 
            'totalCommercants', 
            'totalAdmins',
            'totalProduits', 
            'totalCommandes', 
            'totalCommandesEnAttente', 
            'totalCommandesValidees', 
            'totalCommandesAnnulees',
            'totalRevenus'
        ));
    }

    // Gestion des utilisateurs
    public function users($role = null)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Accès non autorisé');
        }

        if ($role) {
            $users = User::where('role', $role)->get();
        } else {
            $users = User::all();
        }
        
        return view('admin.users.index', compact('users', 'role'));
    }

    public function producteurs()
    {
        return $this->users('producteur');
    }

    public function createUser()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Accès non autorisé');
        }

        return view('admin.users.create');
    }

    public function storeUser(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Accès non autorisé');
        }

        $request->validate([
            'prenom' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'role' => 'required|in:admin,producteur,commerçant',
            'statut' => 'required|in:actif,inactif',
        ]);

        User::create([
            'prenom' => $request->prenom,
            'nom' => $request->nom,
            'email' => $request->email,
            'mot_passe' => bcrypt($request->password),
            'role' => $request->role,
            'statut' => $request->statut,
            'addresse' => $request->addresse ?? '',
            'telephone' => $request->telephone ?? '',
        ]);

        return redirect()->route('admin.users')->with('success', 'Utilisateur créé avec succès!');
    }

    public function editUser($id)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Accès non autorisé');
        }

        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Accès non autorisé');
        }

        $request->validate([
            'prenom' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'role' => 'required|in:admin,producteur,commerçant',
            'statut' => 'required|in:actif,inactif',
        ]);

        $user = User::findOrFail($id);
        $user->update($request->all());

        return redirect()->route('admin.users')->with('success', 'Utilisateur mis à jour avec succès!');
    }

    public function deleteUser($id)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Accès non autorisé');
        }

        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users')->with('success', 'Utilisateur supprimé avec succès!');
    }

    // Gestion des produits
    public function products()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Accès non autorisé');
        }

        $produits = Produit::with(['categorie', 'producteur'])->get();
        return view('admin.products.index', compact('produits'));
    }

    public function createProduct()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Accès non autorisé');
        }

        $categories = Categorie::all();
        $producteurs = User::where('role', 'producteur')->get();
        
        return view('admin.products.create', compact('categories', 'producteurs'));
    }

    public function storeProduct(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required',
            'prix_unitaire' => 'required|numeric',
            'stock_disponible' => 'required|integer',
            'id_categorie_fk' => 'required|exists:categories,id',
            'id_producteur_fk' => 'required|exists:users,id',
            'image_produit' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->except('image_produit');
        
        if ($request->hasFile('image_produit')) {
            $image = $request->file('image_produit');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/products', $imageName);
            $data['image_produit'] = 'products/' . $imageName;
        }

        Produit::create($data);

        return redirect()->route('admin.products')->with('success', 'Produit ajouté avec succès!');
    }

    public function editProduct($id)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Accès non autorisé');
        }

        $produit = Produit::findOrFail($id);
        $categories = Categorie::all();
        $producteurs = User::where('role', 'producteur')->get();
        
        return view('admin.products.edit', compact('produit', 'categories', 'producteurs'));
    }

    public function updateProduct(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required',
            'prix_unitaire' => 'required|numeric',
            'stock_disponible' => 'required|integer',
            'id_categorie_fk' => 'required|exists:categories,id',
            'id_producteur_fk' => 'required|exists:users,id',
            'image_produit' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $produit = Produit::findOrFail($id);
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

        return redirect()->route('admin.products')->with('success', 'Produit mis à jour avec succès!');
    }

    public function deleteProduct($id)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Accès non autorisé');
        }

        $produit = Produit::findOrFail($id);
        $produit->delete();

        return redirect()->route('admin.products')->with('success', 'Produit supprimé avec succès!');
    }

    // Gestion des commandes
    public function orders()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Accès non autorisé');
        }

        $commandes = Commande::with(['user', 'paiements'])->get();
        return view('admin.orders.index', compact('commandes'));
    }

    public function editOrder($id)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Accès non autorisé');
        }

        $commande = Commande::findOrFail($id);
        return view('admin.orders.edit', compact('commande'));
    }

    public function updateOrder(Request $request, $id)
    {
        $request->validate([
            'statut_en_attente_valide_annule_etc' => 'required|in:en_attente,en_cours,delivre,annule',
        ]);

        $commande = Commande::findOrFail($id);
        $commande->update(['statut_en_attente_valide_annule_etc' => $request->statut_en_attente_valide_annule_etc]);

        return redirect()->route('admin.orders')->with('success', 'Commande mise à jour avec succès!');
    }

    // Gestion des boutiques
    public function shops()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Accès non autorisé');
        }

        $producteurs = User::where('role', 'producteur')->get();
        return view('admin.shops.index', compact('producteurs'));
    }

    public function updateShopStatus(Request $request, $id)
    {
        $request->validate([
            'statut' => 'required|in:actif,inactif',
        ]);

        $producteur = User::findOrFail($id);
        $producteur->update(['statut' => $request->statut]);

        return redirect()->route('admin.shops')->with('success', 'Statut de la boutique mis à jour avec succès!');
    }

    // Statistiques & rapports
    public function reports()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Accès non autorisé');
        }

        // Calculer les statistiques
        $statistiques = [
            'total_revenus' => Paiement::where('statut_paiement', 'complet')->sum('montant'),
            'total_commandes' => Commande::count(),
            'commandes_ce_mois' => Commande::whereMonth('date_commande', now()->month)->count(),
            'produits_plus_vendus' => [], // À implémenter selon les besoins
        ];

        return view('admin.reports.index', compact('statistiques'));
    }

    // Paramètres
    public function settings()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Accès non autorisé');
        }

        return view('admin.settings.index');
    }
}
