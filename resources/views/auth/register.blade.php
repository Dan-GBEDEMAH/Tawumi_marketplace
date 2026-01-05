<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inscription - Tawumi Marketplace</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

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
            max-width: 400px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 2.5rem;
            box-shadow: 0 20px 40px rgba(0, 100, 0, 0.15), 0 10px 20px rgba(0, 0, 0, 0.1);
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
        
        .auth-logo {
            text-align: center;
            margin-bottom: 1.5rem;
        }
        
        .auth-logo h1 {
            color: #15803d;
            font-size: 1.75rem;
            font-weight: 700;
            margin-bottom: 0.25rem;
        }
        
        .auth-logo p {
            color: #6b7280;
            font-size: 0.9rem;
        }
        
        .auth-title {
            text-align: center;
            font-size: 1.5rem;
            font-weight: 600;
            color: #15803d;
            margin-bottom: 2rem;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
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
            padding: 0.75rem 1rem;
            border: 2px solid #d1fae5;
            border-radius: 12px;
            font-size: 1rem;
            background-color: #f0fdf4;
            transition: all 0.3s ease;
        }
        
        .form-input:focus, .form-select:focus, .form-textarea:focus {
            outline: none;
            border-color: #22c55e;
            box-shadow: 0 0 0 4px rgba(34, 197, 94, 0.1);
            background-color: white;
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
            min-height: 100px;
            resize: vertical;
        }
        
        .input-with-icon {
            position: relative;
        }
        
        .input-icon-button {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #6b7280;
            cursor: pointer;
            padding: 0.25rem;
        }
        
        .btn-primary {
            width: 100%;
            background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 0.875rem;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 0.5rem;
            box-shadow: 0 4px 6px rgba(34, 197, 94, 0.25);
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, #16a34a 0%, #15803d 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(34, 197, 94, 0.3);
        }
        
        .btn-primary:active {
            transform: translateY(0);
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
        
        .error {
            color: #ef4444;
            font-size: 0.85rem;
            margin-top: 0.25rem;
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
        
        @media (max-width: 480px) {
            .auth-container {
                padding: 1.5rem;
                margin: 0.5rem;
            }
            
            .auth-title {
                font-size: 1.25rem;
            }
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="leaf-decoration leaf-1"><i class="fas fa-seedling"></i></div>
        <div class="leaf-decoration leaf-2"><i class="fas fa-carrot"></i></div>
        
        <div class="auth-logo">
            <h1>Tawumi</h1>
            <p>Marché des produits locaux</p>
        </div>
        
        <h1 class="auth-title">S'inscrire</h1>
        
        <form method="POST" action="{{ route('register') }}">
            @csrf
            
            <div class="form-group">
                <label for="prenom" class="form-label">Nom</label>
                <input type="text" id="prenom" name="prenom" class="form-input" value="{{ old('prenom') }}" required>
                @error('prenom')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="nom" class="form-label">Prénom</label>
                <input type="text" id="nom" name="nom" class="form-input" value="{{ old('nom') }}" required>
                @error('nom')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-input" value="{{ old('email') }}" required>
                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="mot_passe" class="form-label">Mot de passe</label>
                <input type="password" id="mot_passe" name="mot_passe" class="form-input" required>
                @error('mot_passe')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="mot_passe_confirmation" class="form-label">Confirmer le mot de passe</label>
                <input type="password" id="mot_passe_confirmation" name="mot_passe_confirmation" class="form-input" required>
                @error('mot_passe_confirmation')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="addresse" class="form-label">Adresse</label>
                <input type="text" id="addresse" name="addresse" class="form-input" value="{{ old('addresse') }}" required>
                @error('addresse')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="telephone" class="form-label">Téléphone</label>
                <input type="text" id="telephone" name="telephone" class="form-input" value="{{ old('telephone') }}" required>
                @error('telephone')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="role" class="form-label">Rôle</label>
                <select id="role" name="role" class="form-select" required>
                    <option value="">Sélectionnez un rôle</option>
                    <option value="producteur" {{ old('role') == 'producteur' ? 'selected' : '' }}>Producteur</option>
                    <option value="commerçant" {{ old('role') == 'commerçant' ? 'selected' : '' }}>Commerçant</option>
                    
                </select>
                @error('role')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="nom_domaine" class="form-label">Nom du domaine</label>
                <input type="text" id="nom_domaine" name="nom_domaine" class="form-input" value="{{ old('nom_domaine') }}">
                @error('nom_domaine')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="description_domaine" class="form-label">Description du domaine </label>
                <textarea id="description_domaine" name="description_domaine" class="form-textarea" rows="3">{{ old('description_domaine') }}</textarea>
                @error('description_domaine')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            
            <button type="submit" class="btn-primary">S'inscrire</button>
        </form>
        
        <div class="auth-footer">
            <p>Vous avez déjà un compte? <a href="{{ route('login') }}" class="auth-link">Se connecter</a></p>
        </div>
    </div>
    
    <script>
        // Aucune fonction JavaScript nécessaire
    </script>
</body>
</html>