<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Show the registration form
     */
    public function showRegister()
    {
        return view('auth.register');
    }

    /**
     * Handle user registration
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'prenom' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'mot_passe' => 'required|string|min:8|confirmed|regex:/[0-9]/',
            'addresse' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
            'sexe' => 'required|in:H,F',
            'role' => 'required|in:producteur,commerçant,admin',
            'nom_domaine' => 'nullable|string|max:255',
            'description_domaine' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = new User([
            'prenom' => $request->prenom,
            'nom' => $request->nom,
            'email' => $request->email,
            'mot_passe' => $request->mot_passe,
            'addresse' => $request->addresse,
            'telephone' => $request->telephone,
            'sexe' => $request->sexe,
            'role' => $request->role,
            'nom_domaine' => $request->nom_domaine,
            'description_domaine' => $request->description_domaine,
        ]);
        $user->save();

        Auth::login($user);

        // Redirect based on user role
        switch ($user->role) {
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'producteur':
                return redirect()->route('producteur.dashboard');
            default:
                return redirect()->route('home');
        }
    }

    /**
     * Show the login form
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Handle user login
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'mot_passe' => 'required',
        ]);

        // Since the database field is 'mot_passe', we need to handle this differently
        $user = User::where('email', $request->email)->first();
        
        if (!$user || !$user->password || strlen($user->password) < 60 || !Hash::check($request->mot_passe, $user->password)) {
            return redirect()->back()->withErrors([
                'email' => 'Les identifiants fournis sont incorrects.',
            ]);
        }

        Auth::login($user);

        // Redirect based on user role
        switch ($user->role) {
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'producteur':
                return redirect()->route('producteur.dashboard');
            default:
                return redirect()->route('home');
        }
    }

    /**
     * Handle user logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
    
    /**
     * Show the forgot password form
     */
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }
    
    /**
     * Change the user's password directly
     */
    public function changePasswordDirectly(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed|regex:/[0-9]/',
        ]);
        
        // Check if the user exists
        $user = User::where('email', $request->email)->first();
        
        if (!$user) {
            return back()->withErrors(['email' => 'Aucun utilisateur trouvé avec cet email.']);
        }
        
        // Update user's password
        $user->update([
            'mot_passe' => $request->password,
        ]);
        
        return redirect()->route('login')->with('status', 'Votre mot de passe a été modifié avec succès!');
    }
    
    /**
     * Send the password reset link
     */
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        
        $user = User::where('email', $request->email)->first();
        
        if (!$user) {
            return back()->withErrors(['email' => 'Aucun utilisateur trouvé avec cet email.']);
        }
        
        // Create password reset token
        $token = bin2hex(random_bytes(32));
        
        // Store the token in the password_reset_tokens table
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            [
                'token' => $token,
                'created_at' => now(),
            ]
        );
        
        // In a real application, you would send an email here
        // For now, we'll just redirect with a message
        return redirect()->back()->with('status', 'Lien de réinitialisation envoyé! (Pour ce démo, le lien est affiché ci-dessous)');
    }
    

}