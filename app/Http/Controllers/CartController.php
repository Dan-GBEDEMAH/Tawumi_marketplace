<?php

namespace App\Http\Controllers;

use App\Models\Panier;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = collect();

        if (Auth::check()) {
            // Si l'utilisateur est connecté, récupérer les articles du panier en base de données
            $dbCartItems = Panier::with('produit')
                ->where('id_user_fk', Auth::id())
                ->where('statut_actif_convert', 1)
                ->get();
            
            foreach ($dbCartItems as $item) {
                $cartItems->push($item);
            }
        }
        
        // Récupérer les articles du panier de la session
        $sessionCart = session()->get('cart', []);
        
        foreach ($sessionCart as $item) {
            $produit = Produit::find($item['produit_id']);
            if ($produit) {
                // Check if this product is already in the database cart to avoid duplicates
                $existingCartItem = $cartItems->firstWhere('id_produit_fk', $item['produit_id']);
                
                if (!$existingCartItem) {
                    $cartItem = new Panier();
                    $cartItem->id = $item['produit_id'];
                    $cartItem->produit = $produit;
                    $cartItem->id_user_fk = null; // Pour les articles de session
                    $cartItem->id_produit_fk = $item['produit_id'];
                    $cartItem->quantite = $item['quantite'] ?? 1; // Add quantity from session
                    $cartItems->push($cartItem);
                }
            }
        }

        $total = 0;
        foreach ($cartItems as $item) {
            if ($item->produit) {
                $quantity = $item->quantite ?? 1;
                $total += $item->produit->prix * $quantity;
            }
        }

        return view('front.cart', compact('cartItems', 'total'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'produit_id' => 'required|exists:produits,id',
        ]);

        $produit = Produit::findOrFail($request->produit_id);

        // Vérifier si le produit est disponible (stock > 0)
        if ($produit->stock_disponible <= 0) {
            return redirect()->back()->with('error', 'Ce produit n\'est plus disponible en stock.');
        }

        if (Auth::check()) {
            // Si l'utilisateur est connecté, enregistrer dans la base de données
            $existingItem = Panier::where('id_user_fk', Auth::id())
                ->where('id_produit_fk', $request->produit_id)
                ->where('statut_actif_convert', 1)
                ->first();

            if ($existingItem) {
                return redirect()->back()->with('error', 'Ce produit est déjà dans votre panier.');
            }

            // Add product to cart
            Panier::create([
                'id_produit_fk' => $request->produit_id,
                'id_user_fk' => Auth::id(),
                'statut_actif_convert' => 1,
                'id_commercant_fk' => $produit->id_producteur_fk, // Assuming the producteur ID is the merchant
            ]);
        } else {
            // Si l'utilisateur n'est pas connecté, enregistrer dans la session
            $cart = session()->get('cart', []);
            
            // Vérifier si le produit est déjà dans le panier de la session
            $productExists = false;
            foreach ($cart as $key => $item) {
                if ($item['produit_id'] == $request->produit_id) {
                    $productExists = true;
                    break;
                }
            }
            
            if ($productExists) {
                return redirect()->back()->with('error', 'Ce produit est déjà dans votre panier.');
            }
            
            // Ajouter le produit au panier de la session
            $cart[] = [
                'produit_id' => $request->produit_id,
                'quantite' => 1,
            ];
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Produit ajouté au panier avec succès!');
    }

    public function remove($id)
    {
        if (Auth::check()) {
            // Suppression pour les utilisateurs authentifiés
            $cartItem = Panier::where('id', $id)
                ->where('id_user_fk', Auth::id())
                ->firstOrFail();

            $cartItem->delete();
        } else {
            // Suppression pour les utilisateurs non authentifiés (panier de session)
            $cart = session()->get('cart', []);
            
            $updatedCart = [];
            foreach ($cart as $item) {
                if ($item['produit_id'] != $id) {
                    $updatedCart[] = $item;
                }
            }
            
            session()->put('cart', $updatedCart);
        }

        return redirect()->back()->with('success', 'Produit supprimé du panier avec succès!');
    }

    public function update(Request $request)
    {
        $request->validate([
            'item_id' => 'required|integer',
            'action' => 'required|in:add,remove',
        ]);
        
        $itemId = $request->item_id;
        $action = $request->action;
        
        if (Auth::check()) {
            // For authenticated users, update database cart
            $cartItem = Panier::where('id', $itemId)
                ->where('id_user_fk', Auth::id())
                ->first();
            
            if ($cartItem) {
                if ($action === 'add') {
                    $cartItem->increment('quantite');
                } else {
                    if ($cartItem->quantite > 1) {
                        $cartItem->decrement('quantite');
                    }
                }
            }
        } else {
            // For non-authenticated users, update session cart
            $cart = session()->get('cart', []);
            $updatedCart = [];
            $itemFound = false;
            
            foreach ($cart as $item) {
                if ($item['produit_id'] == $itemId) {
                    if ($action === 'add') {
                        $item['quantite'] = isset($item['quantite']) ? $item['quantite'] + 1 : 2;
                    } else {
                        $item['quantite'] = isset($item['quantite']) && $item['quantite'] > 1 ? $item['quantite'] - 1 : 1;
                    }
                    $itemFound = true;
                }
                $updatedCart[] = $item;
            }
            
            if (!$itemFound) {
                // If item not in session cart, add it with quantity
                $newItem = [
                    'produit_id' => $itemId,
                    'quantite' => $action === 'add' ? 1 : 1
                ];
                $updatedCart[] = $newItem;
            }
            
            session()->put('cart', $updatedCart);
        }
        
        return response()->json(['success' => true, 'message' => 'Quantité mise à jour avec succès!']);
    }
    
    public function updateQuantity(Request $request)
    {
        $request->validate([
            'produit_id' => 'required|exists:produits,id',
            'quantite' => 'required|integer|min:1',
        ]);
        
        $produitId = $request->produit_id;
        $quantite = $request->quantite;
        
        if (Auth::check()) {
            // For database cart items, we need to handle differently
            // For now, we'll just update the session cart
        }
        
        $cart = session()->get('cart', []);
        $updatedCart = [];
        
        foreach ($cart as $item) {
            if ($item['produit_id'] == $produitId) {
                $item['quantite'] = $quantite;
            }
            $updatedCart[] = $item;
        }
        
        session()->put('cart', $updatedCart);
        
        return response()->json(['success' => true]);
    }

    public function checkout()
    {
        $cartItems = collect();
        
        if (Auth::check()) {
            // Si l'utilisateur est connecté, récupérer les articles du panier en base de données
            $dbCartItems = Panier::with('produit')
                ->where('id_user_fk', Auth::id())
                ->where('statut_actif_convert', 1)
                ->get();
            
            foreach ($dbCartItems as $item) {
                $cartItems->push($item);
            }
        }
        
        // Récupérer les articles du panier de la session
        $sessionCart = session()->get('cart', []);
        
        foreach ($sessionCart as $item) {
            $produit = Produit::find($item['produit_id']);
            if ($produit) {
                // Check if this product is already in the database cart to avoid duplicates
                $existingCartItem = $cartItems->firstWhere('id_produit_fk', $item['produit_id']);
                
                if (!$existingCartItem) {
                    $cartItem = new Panier();
                    $cartItem->id = $item['produit_id'];
                    $cartItem->produit = $produit;
                    $cartItem->id_user_fk = null; // Pour les articles de session
                    $cartItem->id_produit_fk = $item['produit_id'];
                    $cartItem->quantite = $item['quantite'] ?? 1; // Add quantity from session
                    $cartItems->push($cartItem);
                }
            }
        }

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Votre panier est vide.');
        }

        $total = 0;
        foreach ($cartItems as $item) {
            if ($item->produit) {
                $quantity = $item->quantite ?? 1;
                $total += $item->produit->prix * $quantity;
            }
        }

        return view('front.checkout', compact('cartItems', 'total'));
    }

    public function processCheckout(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'city' => 'required|string|max:255',
            'postal_code' => 'nullable|string|max:20',
            'instructions' => 'nullable|string',
            'delivery' => 'required|in:standard,express',
            'payment' => 'required|in:cash,card,mobile',
        ]);

        $cartItems = collect();
        
        if (Auth::check()) {
            // Si l'utilisateur est connecté, récupérer les articles du panier en base de données
            $dbCartItems = Panier::with('produit')
                ->where('id_user_fk', Auth::id())
                ->where('statut_actif_convert', 1)
                ->get();
            
            foreach ($dbCartItems as $item) {
                $cartItems->push($item);
            }
        }
        
        // Récupérer les articles du panier de la session
        $sessionCart = session()->get('cart', []);
        
        foreach ($sessionCart as $item) {
            $produit = Produit::find($item['produit_id']);
            if ($produit) {
                // Check if this product is already in the database cart to avoid duplicates
                $existingCartItem = $cartItems->firstWhere('id_produit_fk', $item['produit_id']);
                
                if (!$existingCartItem) {
                    $cartItem = new Panier();
                    $cartItem->id = $item['produit_id'];
                    $cartItem->produit = $produit;
                    $cartItem->id_user_fk = null; // Pour les articles de session
                    $cartItem->id_produit_fk = $item['produit_id'];
                    $cartItem->quantite = $item['quantite'] ?? 1; // Add quantity from session
                    $cartItems->push($cartItem);
                }
            }
        }

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Votre panier est vide.');
        }

        $total = 0;
        foreach ($cartItems as $item) {
            if ($item->produit) {
                $quantity = $item->quantite ?? 1;
                $total += $item->produit->prix * $quantity;
            }
        }

        // Add delivery cost if express delivery is selected
        if ($request->delivery === 'express') {
            $total += 500; // Express delivery cost
        }
        
        // Check if there is enough stock for each product
        foreach ($cartItems as $item) {
            if ($item->produit) {
                $quantity = $item->quantite ?? 1;
                if ($item->produit->stock_disponible < $quantity) {
                    DB::rollback();
                    return redirect()->route('checkout')->with('error', 'Désolé, le produit "' . $item->produit->nom . '" n\'a plus assez de stock disponible (disponible: ' . $item->produit->stock_disponible . ', demandé: ' . $quantity . ').');
                }
            }
        }

        // Start a database transaction
        DB::beginTransaction();
        
        try {
            // Create the order
            $order = \App\Models\Commande::create([
                'id_commercant_fk' => Auth::check() ? Auth::id() : null, // Laisser null pour les utilisateurs non authentifiés
                'adresse_livraison' => $request->address,
                'ville_livraison' => $request->city,
                'code_postal_livraison' => $request->postal_code,
                'instructions_livraison' => $request->instructions,
                'mode_livraison' => $request->delivery,
                'statut_en_attente_valide_annule_etc' => 'en_attente',
                'date_commande' => now(),
                'nom_client' => $request->first_name . ' ' . $request->last_name,
                'email_client' => $request->email,
                'telephone_client' => $request->phone,
            ]);

            // Add products to the order in the pivot table and update stock
            foreach ($cartItems as $item) {
                if ($item->produit) {
                    $quantity = $item->quantite ?? 1; // Use the quantity from cart item
                    
                    // Update product stock
                    $product = $item->produit;
                    $product->stock_disponible = max(0, $product->stock_disponible - $quantity);
                    $product->save();
                    
                    $order->produits()->attach($item->id_produit_fk, [
                        'quantite' => $quantity,
                        'prix_unitaire' => $item->produit->prix,
                    ]);
                }
            }

            // Create payment record
            $payment = \App\Models\Paiement::create([
                'id_commande_fk' => $order->id,
                'montant' => $total,
                'mode_paiement' => $request->payment,
                'statut_paiement' => $request->payment === 'cash' ? 'en_attente' : 'en_attente', // For card/mobile, this would be updated after actual payment
                'date_paiement' => now(),
                'methode_TMoney_Flooz' => $request->payment, // Store the selected payment method
            ]);

            // Clear the cart
            if (Auth::check()) {
                foreach ($cartItems as $item) {
                    $item->delete();
                }
            } else {
                // Pour les utilisateurs non authentifiés, vider le panier de session
                session()->forget('cart');
            }

            DB::commit();

            return redirect()->route('checkout.success', ['order_id' => $order->id])
                ->with('success', 'Commande passée avec succès!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('checkout')->with('error', 'Une erreur est survenue lors du traitement de votre commande: ' . $e->getMessage());
        }
    }

    public function checkoutSuccess($orderId)
    {
        $order = \App\Models\Commande::with(['produits', 'paiements'])
            ->where('id', $orderId)
            ->firstOrFail();
        
        // Vérifier que l'utilisateur a le droit de voir cette commande
        if (auth()->check()) {
            $user = auth()->user();
            // Utilisateur connecté : vérifier s'il est propriétaire, admin ou producteur
            if ($user->id !== $order->id_commercant_fk && $user->role !== 'admin' && $user->role !== 'producteur') {
                abort(403, 'Vous n\'êtes pas autorisé à voir cette commande.');
            }
        } else {
            // Utilisateur non connecté : autoriser l'accès si l'ID de commande correspond
            // Cette vérification est suffisante car l'ID de commande est nécessaire pour accéder à la commande
        }

        return view('front.checkout-success', compact('order'));
    }

    public function userOrders()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Veuillez vous connecter pour voir vos commandes.');
        }

        $orders = \App\Models\Commande::where('id_commercant_fk', Auth::id())
            ->with(['produits', 'paiements'])
            ->orderBy('date_commande', 'desc')
            ->get();

        return view('front.user-orders', compact('orders'));
    }
}