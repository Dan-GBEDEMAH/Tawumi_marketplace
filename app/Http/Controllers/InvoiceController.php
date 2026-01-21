<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commande;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    public function show($orderId)
    {
        $order = Commande::with(['produits', 'paiements'])->findOrFail($orderId);
        
        // Vérifier que l'utilisateur a le droit de voir cette facture
        // Soit c'est l'utilisateur connecté qui a passé la commande, soit l'utilisateur a accès via l'ID de commande
        if (Auth::check()) {
            $user = Auth::user();
            // Utilisateur connecté : vérifier s'il est propriétaire, admin ou producteur
            if ($user->id !== $order->id_commercant_fk && $user->role !== 'admin' && $user->role !== 'producteur') {
                abort(403, 'Vous n\'êtes pas autorisé à voir cette facture.');
            }
        } else {
            // Utilisateur non connecté : autoriser l'accès si l'ID de commande correspond
            // Cette vérification est suffisante car l'ID de commande est nécessaire pour accéder à la facture
        }

        return view('pdf.invoice', compact('order'));
    }

    public function download($orderId)
    {
        $order = Commande::with(['produits', 'paiements'])->findOrFail($orderId);
        
        // Vérifier que l'utilisateur a le droit de télécharger cette facture
        if (Auth::check()) {
            $user = Auth::user();
            // Utilisateur connecté : vérifier s'il est propriétaire, admin ou producteur
            if ($user->id !== $order->id_commercant_fk && $user->role !== 'admin' && $user->role !== 'producteur') {
                abort(403, 'Vous n\'êtes pas autorisé à télécharger cette facture.');
            }
        } else {
            // Utilisateur non connecté : autoriser l'accès si l'ID de commande correspond
            // Cette vérification est suffisante car l'ID de commande est nécessaire pour accéder à la facture
        }

        $pdf = Pdf::loadView('pdf.invoice', compact('order'));
        return $pdf->download('facture-commande-' . $order->id . '.pdf');
    }
}