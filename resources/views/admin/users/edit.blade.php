@extends('admin.layout')

@section('title', 'Modifier utilisateur')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Modifier utilisateur</h1>
        <a href="{{ route('admin.users') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Retour
        </a>
    </div>

    <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-10 col-md-12">
            <div class="card o-hidden border-0 shadow-lg">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-5">
                                <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <label for="prenom">Prénom</label>
                                            <input type="text" class="form-control form-control-user" id="prenom" name="prenom" value="{{ old('prenom', $user->prenom) }}" required>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="nom">Nom</label>
                                            <input type="text" class="form-control form-control-user" id="nom" name="nom" value="{{ old('nom', $user->nom) }}" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control form-control-user" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="role">Rôle</label>
                                        <select class="form-control" id="role" name="role" required>
                                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                            <option value="producteur" {{ $user->role == 'producteur' ? 'selected' : '' }}>Producteur</option>
                                            <option value="commerçant" {{ $user->role == 'commerçant' ? 'selected' : '' }}>Commerçant</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="statut">Statut</label>
                                        <select class="form-control" id="statut" name="statut" required>
                                            <option value="actif" {{ ($user->statut ?? 'actif') == 'actif' ? 'selected' : '' }}>Actif</option>
                                            <option value="inactif" {{ ($user->statut ?? 'actif') == 'inactif' ? 'selected' : '' }}>Inactif</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="addresse">Adresse</label>
                                        <input type="text" class="form-control form-control-user" id="addresse" name="addresse" value="{{ old('addresse', $user->addresse) }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="telephone">Téléphone</label>
                                        <input type="text" class="form-control form-control-user" id="telephone" name="telephone" value="{{ old('telephone', $user->telephone) }}">
                                   
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Mettre à jour l'utilisateur
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection