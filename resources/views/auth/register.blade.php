<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inscription - TawumiConfirm</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Styles -->
    <style>
        /* Reset et styles de base */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Instrument Sans', sans-serif;
            background: linear-gradient(135deg, #f0f9ff 0%, #e6f4ea 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%239C92AC' fill-opacity='0.05'%3E%3Ccircle cx='30' cy='30' r='2'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
        
        .auth-container {
            width: 100%;
            max-width: 800px; /* Significantly increased for better spacing */
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 24px;
            padding: 3rem;
            box-shadow: 0 25px 50px rgba(0, 100, 0, 0.2), 0 15px 30px rgba(0, 0, 0, 0.15);
            position: relative;
            overflow: hidden;
        }
        
        .auth-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 8px;
            background: linear-gradient(90deg, #22c55e, #16a34a, #15803d);
        }
        
        .auth-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }
        
        .logo-container {
            margin-bottom: 1.5rem;
        }
        
        .logo {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            box-shadow: 0 10px 20px rgba(34, 197, 94, 0.3);
        }
        
        .logo i {
            font-size: 3rem;
            color: white;
        }
        
        .auth-header h1 {
            color: #15803d;
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
            letter-spacing: 1px;
        }
        
        .auth-header p {
            color: #6b7280;
            font-size: 0.9rem;
        }
        
        .auth-header h2 {
            color: #374151;
            font-size: 1.5rem;
            font-weight: 600;
            margin-top: 1rem;
        }
        
        .form-section {
            margin-bottom: 2.5rem;
            padding: 2rem;
            background: #f8fafc;
            border-radius: 16px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }
        
        .section-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #15803d;
            margin-bottom: 1rem;
            border-bottom: 2px solid #22c55e;
            padding-bottom: 0.5rem;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-group.full-width {
            width: 100%;
        }
        
        .form-group:not(.full-width) {
            display: inline-block;
            width: calc(50% - 0.5rem);
            margin-right: 0.5rem;
        }
        
        .form-group:not(.full-width):last-child {
            margin-right: 0;
        }
        
        .form-label {
            display: block;
            font-size: 0.9rem;
            font-weight: 500;
            color: #374151;
            margin-bottom: 0.5rem;
        }
        
        .form-input, .form-select, .form-textarea {
            width: 100%;
            padding: 1rem 1.25rem;
            border: 2px solid #d1fae5;
            border-radius: 14px;
            font-size: 1.05rem;
            background-color: #f0fdf4;
            transition: all 0.3s ease;
            height: 50px;
        }
        
        .form-input:focus, .form-select:focus, .form-textarea:focus {
            outline: none;
            border-color: #22c55e;
            box-shadow: 0 0 0 4px rgba(34, 197, 94, 0.1);
            background-color: white;
        }
        
        .form-input.input-error, .form-select.input-error, .form-textarea.input-error {
            border-color: #ef4444;
        }
        
        .form-select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 0.75rem center;
            background-repeat: no-repeat;
            background-size: 1.5em 1.5em;
            padding-right: 2.5rem;
        }
        
        .form-textarea {
            min-height: 80px;
            resize: vertical;
        }
        
        .btn-primary {
            width: 100%;
            background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
            color: white;
            border: none;
            border-radius: 14px;
            padding: 1.1rem;
            font-size: 1.1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 1.5rem;
            box-shadow: 0 6px 15px rgba(34, 197, 94, 0.3);
            letter-spacing: 0.5px;
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, #16a34a 0%, #15803d 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(34, 197, 94, 0.3);
        }
        
        .btn-primary:active {
            transform: translateY(0);
        }
        
        .error-message {
            color: #ef4444;
            font-size: 0.85rem;
            margin-top: 0.25rem;
        }
        
        .required-star {
            color: #dc3545;
            font-weight: bold;
        }
        
        .auth-footer {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.9rem;
            color: #6b7280;
        }
        
        .auth-link {
            color: #22c55e;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        
        .auth-link:hover {
            color: #16a34a;
            text-decoration: underline;
        }
        
        .leaf-decoration {
            position: absolute;
            opacity: 0.1;
        }
        
        .leaf-1 {
            top: 10%;
            right: 10%;
            font-size: 3rem;
            transform: rotate(20deg);
        }
        
        .leaf-2 {
            bottom: 10%;
            left: 10%;
            font-size: 2.5rem;
            transform: rotate(-15deg);
        }
        
        @media (max-width: 768px) {
            .form-group:not(.full-width) {
                display: block;
                width: 100%;
                margin-right: 0;
            }
            
            .auth-container {
                padding: 2rem;
                margin: 1rem;
                max-width: 100%;
            }
            
            .form-section {
                padding: 1.5rem;
            }
            
            .auth-header h1 {
                font-size: 2rem;
            }
            
            .logo {
                width: 80px;
                height: 80px;
            }
            
            .logo i {
                font-size: 2.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="leaf-decoration leaf-1"><i class="fas fa-seedling"></i></div>
        <div class="leaf-decoration leaf-2"><i class="fas fa-carrot"></i></div>
        
        <div class="auth-header">
            <h1>TawumiConfirm</h1>
            <p>Marché des produits locaux</p>
            <h2>Créer un compte</h2>
        </div>
        
        <form method="POST" action="{{ route('register') }}">
            @csrf
            
            <div class="form-section">
                <h3 class="section-title">Informations Personnelles <span class="required-star">*</span></h3>
                <div class="form-group">
                    <label class="form-label">Nom</label>
                    <input type="text" name="nom" class="form-input @error('nom') input-error @enderror" value="{{ old('nom') }}" required>
                    @error('nom') <span class="error-message">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Prénom</label>
                    <input type="text" name="prenom" class="form-input @error('prenom') input-error @enderror" value="{{ old('prenom') }}" required>
                    @error('prenom') <span class="error-message">{{ $message }}</span> @enderror
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Genre</label>
                    <select name="sexe" class="form-select" required>
                        <option value="" disabled selected>Sélectionnez</option>
                        <option value="H" {{ old('sexe') == 'H' ? 'selected' : '' }}>Homme</option>
                        <option value="F" {{ old('sexe') == 'F' ? 'selected' : '' }}>Femme</option>
                    </select>
                </div>
            </div>

            <div class="form-section">
                <h3 class="section-title">Sécurité <span class="required-star">*</span></h3>
                <div class="form-group full-width">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-input @error('email') input-error @enderror" value="{{ old('email') }}" required>
                    @error('email') <span class="error-message">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Mot de passe</label>
                    <input type="password" name="mot_passe" class="form-input @error('mot_passe') input-error @enderror" required>
                    @error('mot_passe') <span class="error-message">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Confirmer</label>
                    <input type="password" name="mot_passe_confirmation" class="form-input" required>
                </div>
            </div>

            <div class="form-section">
                <h3 class="section-title">Détails de l'activité <span class="required-star">*</span></h3>
                 <div class="form-group full-width">
                    <label class="form-label">Nom du domaine / Entreprise (Facultatif)</label>
                    <input type="text" name="nom_domaine" class="form-input" value="{{ old('nom_domaine') }}">
                </div>
                <div class="form-group">
                    <label class="form-label">Rôle</label>
                    <select name="role" class="form-select" required>
                        <option value="" disabled selected>Sélectionnez</option>
                        <option value="producteur" {{ old('role') == 'producteur' ? 'selected' : '' }}>Producteur</option>
                        <option value="commerçant" {{ old('role') == 'commerçant' ? 'selected' : '' }}>Commerçant</option>
                    </select>
                </div>
                 <div class="form-group full-width">
                    <label class="form-label">Description (Facultatif)</label>
                    <textarea name="description_domaine" class="form-textarea" rows="2">{{ old('description_domaine') }}</textarea>
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Adresse de l'exploitation</label>
                    <input type="text" name="addresse" class="form-input" value="{{ old('addresse') }}" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Téléphone</label>
                    <input type="text" name="telephone" class="form-input" value="{{ old('telephone') }}" required>
                </div>
            </div>
            
            <button type="submit" class="btn-primary">S'inscrire</button>
        </form>
        
        <div class="auth-footer">
            <p>Déjà inscrit ? <a href="{{ route('login') }}" class="auth-link">Se connecter</a></p>
        </div>
    </div>

</body>
</html>