<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Changer le mot de passe - Tawumi Marketplace</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 5rem;
            padding-bottom: 5rem;
        }
        .auth-container {
            max-width: 500px;
            margin: 0 auto;
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }
        .logo {
            text-align: center;
            margin-bottom: 1.5rem;
        }
        .logo h2 {
            color: #28a745;
            font-weight: bold;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-label {
            font-weight: 500;
            margin-bottom: 0.5rem;
        }
        .form-input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ced4da;
            border-radius: 0.375rem;
            font-size: 1rem;
        }
        .form-input:focus {
            border-color: #28a745;
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
        }
        .btn-primary {
            background-color: #28a745;
            border-color: #28a745;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            border-radius: 0.375rem;
            cursor: pointer;
            width: 100%;
        }
        .btn-primary:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }
        .auth-footer {
            text-align: center;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid #eee;
        }
        .auth-link {
            color: #28a745;
            text-decoration: none;
        }
        .auth-link:hover {
            text-decoration: underline;
        }
        .error {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
        .success {
            color: #28a745;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="logo">
            <h2>TawumiConfirm</h2>
            <p class="text-muted">Changement de mot de passe</p>
        </div>
        
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            
            <div class="alert alert-info">
                Entrez votre email et votre nouveau mot de passe.
            </div>
            
            @if(session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-input" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="password" class="form-label">Nouveau mot de passe</label>
                <input type="password" id="password" name="password" class="form-input" required>
                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="password_confirmation" class="form-label">Confirmer le nouveau mot de passe</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-input" required>
                @error('password_confirmation')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            
            <button type="submit" class="btn-primary">Modifier son compte</button>
        </form>
        
        <div class="auth-footer">
            <p><a href="{{ route('login') }}" class="auth-link">Retour à la connexion</a></p>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>