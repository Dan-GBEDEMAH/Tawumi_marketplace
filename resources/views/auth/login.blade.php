<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Connexion - Tawumi Marketplace</title>
    
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
        
        .form-input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid #d1fae5;
            border-radius: 12px;
            font-size: 1rem;
            background-color: #f0fdf4;
            transition: all 0.3s ease;
        }
        
        .form-input:focus {
            outline: none;
            border-color: #22c55e;
            box-shadow: 0 0 0 4px rgba(34, 197, 94, 0.1);
            background-color: white;
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
        
        <h1 class="auth-title">Se connecter</h1>
        
        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-input" value="{{ old('email') }}" required autofocus>
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
            
            <button type="submit" class="btn-primary">Se connecter</button>
        </form>
        
        <div class="auth-footer">
            <p>Vous n'avez pas de compte? <a href="{{ route('register') }}" class="auth-link">S'inscrire</a></p>
        </div>
    </div>
    
    <script>
        function togglePasswordVisibility(id) {
            const input = document.getElementById(id);
            const icon = input.nextElementSibling.querySelector('svg');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.innerHTML = `<path d="M0 0h16v16H0z"/>` + `<path d="M13.359 11.238C13.72 10.732 13.958 10.153 14 9.546c-.058-.087-.122-.183-.195-.288-.335-.48-.83-1.12-1.465-1.755C11.879 6.668 10.119 5.5 8 5.5c-2.12 0-3.879 1.168-5.168 2.457-.336.48-.63.995-.843 1.548-.213.553-.354 1.14-.41 1.754.04.087.1.173.172.255.11.13 2.397 2.83 5.27 2.83.75 0 1.44-.19 2.04-.4-.13.24-.28.47-.44.68-.16.21-.34.4-.53.57-.19.17-.4.32-.62.44-.22.12-.45.22-.69.29-.24.07-.49.12-.74.15-.25.03-.51.04-.77.04-.26 0-.52-.01-.77-.04-.25-.03-.49-.08-.74-.15-.24-.07-.47-.17-.69-.29-.22-.12-.43-.27-.62-.44-.19-.17-.37-.36-.53-.57-.16-.21-.31-.44-.44-.68.6-.21 1.29-.4 2.04-.4.75 0 1.44.19 2.04.4-.13.24-.28.47-.44.68-.16.21-.34.4-.53.57-.19.17-.4.32-.62.44-.22.12-.45.22-.69.29-.24.07-.49.12-.74.15-.25.03-.51.04-.77.04-.26 0-.52-.01-.77-.04-.25-.03-.49-.08-.74-.15-.24-.07-.47-.17-.69-.29-.22-.12-.43-.27-.62-.44-.19-.17-.37-.36-.53-.57-.16-.21-.31-.44-.44-.68.6-.21 1.29-.4 2.04-.4.75 0 1.44.19 2.04.4z" fill="currentColor"/>`;
            } else {
                input.type = 'password';
                icon.innerHTML = `<path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>` + `<path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>`;
            }
        }
    </script>
</body>
</html>