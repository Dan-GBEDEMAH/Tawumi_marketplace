@extends('admin.layout')

@section('title', 'Paramètres')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Paramètres du système</h1>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Paramètres généraux</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.profile.update') }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="prenom">Prénom</label>
                            <input type="text" class="form-control" id="prenom" name="prenom" value="{{ Auth::user()->prenom }}" placeholder="Entrez votre prénom">
                        </div>
                        <div class="form-group">
                            <label for="nom">Nom</label>
                            <input type="text" class="form-control" id="nom" name="nom" value="{{ Auth::user()->nom }}" placeholder="Entrez votre nom">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}" placeholder="Entrez votre email">
                        </div>
                        <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                    </form>
                    
                    <hr class="my-4">
                    
                    <form method="POST" action="{{ route('admin.password.update') }}" class="mt-4">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="current_password">Mot de passe actuel</label>
                            <input type="password" class="form-control" id="current_password" name="current_password" required>
                        </div>
                        <div class="form-group">
                            <label for="new_password">Nouveau mot de passe (minimum 8 caractères, avec au moins un chiffre)</label>
                            <input type="password" class="form-control" id="new_password" name="new_password" required>
                        </div>
                        <div class="form-group">
                            <label for="new_password_confirmation">Confirmer le nouveau mot de passe</label>
                            <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informations système</h6>
                </div>
                <div class="card-body">
                    <h5>Version du système</h5>
                    <p>1.0.0</p>
                    
                    <h5>Statut du système</h5>
                    <span class="badge bg-success">En ligne</span>
                    
                    <h5 class="mt-3">Dernière mise à jour</h5>
                    <p>{{ now()->format('d/m/Y H:i:s') }}</p>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Sécurité</h6>
                </div>
                <div class="card-body">
                    <button type="button" class="btn btn-warning btn-block mb-2" onclick="changePassword()">Changer le mot de passe</button>
                    <button type="button" class="btn btn-danger btn-block" onclick="saveData()">Sauvegarder les données</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function changePassword() {
    // Scroll to the password form
    document.getElementById('current_password').scrollIntoView({behavior: 'smooth'});
    
    // Optionally highlight the section
    const passwordForm = document.querySelector('form[action="{{ route("admin.password.update") }}"]');
    passwordForm.style.border = '2px solid #ffc107';
    setTimeout(() => {
        passwordForm.style.border = '';
    }, 2000);
}

function saveData() {
    // Submit the data save form
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '{{ route("admin.data.save") }}';
    
    // Add CSRF token
    const csrfInput = document.createElement('input');
    csrfInput.type = 'hidden';
    csrfInput.name = '_token';
    csrfInput.value = '{{ csrf_token() }}';
    form.appendChild(csrfInput);
    
    // Add method spoofing
    const methodInput = document.createElement('input');
    methodInput.type = 'hidden';
    methodInput.name = '_method';
    methodInput.value = 'POST';
    form.appendChild(methodInput);
    
    document.body.appendChild(form);
    form.submit();
}
</script>
@endsection