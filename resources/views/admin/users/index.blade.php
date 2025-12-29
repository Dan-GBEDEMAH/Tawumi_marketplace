@extends('admin.layout')

@section('title', isset($role) ? 'Gestion des '. ucfirst($role) . 's' : 'Gestion des utilisateurs')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Gestion des utilisateurs</h1>
        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('admin.users.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50"></i> Nouvel utilisateur
            </a>
            <a href="{{ route('admin.users') }}" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm {{ !isset($role) ? 'active' : '' }}">
                Tous
            </a>
            <a href="{{ route('admin.producteurs') }}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm {{ isset($role) && $role == 'producteur' ? 'active' : '' }}">
                Producteurs
            </a>
            <a href="{{ route('admin.users', ['role' => 'commerçant']) }}" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm {{ isset($role) && $role == 'commerçant' ? 'active' : '' }}">
                Commerçants
            </a>
            <a href="{{ route('admin.users', ['role' => 'admin']) }}" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm {{ isset($role) && $role == 'admin' ? 'active' : '' }}">
                Admins
            </a>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Liste des {{ isset($role) ? ucfirst($role) . 's' : 'utilisateurs' }}</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Prénom</th>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Rôle</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->prenom }}</td>
                            <td>{{ $user->nom }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <span class="badge bg-{{ $user->role == 'admin' ? 'danger' : ($user->role == 'producteur' ? 'success' : 'info') }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-{{ $user->statut ?? 'actif' == 'actif' ? 'success' : 'warning' }}">
                                    {{ $user->statut ?? 'actif' }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection