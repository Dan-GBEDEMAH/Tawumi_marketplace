@extends('admin.layout')

@section('title', 'Gestion des boutiques')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Gestion des boutiques</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Liste des boutiques producteurs</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Producteur</th>
                            <th>Nom du domaine</th>
                            <th>Email</th>
                            <th>Téléphone</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($producteurs as $producteur)
                        <tr>
                            <td>{{ $producteur->id }}</td>
                            <td>{{ $producteur->prenom }} {{ $producteur->nom }}</td>
                            <td>{{ $producteur->nom_domaine ?? 'Non spécifié' }}</td>
                            <td>{{ $producteur->email }}</td>
                            <td>{{ $producteur->telephone }}</td>
                            <td>
                                <span class="badge bg-{{ ($producteur->statut ?? 'actif') == 'actif' ? 'success' : 'danger' }}">
                                    {{ $producteur->statut ?? 'actif' }}
                                </span>
                            </td>
                            <td>
                                <form method="POST" action="{{ route('admin.shops.update', $producteur->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <select class="form-control form-control-sm d-inline-block w-auto" name="statut" onchange="this.form.submit()">
                                        <option value="actif" {{ ($producteur->statut ?? 'actif') == 'actif' ? 'selected' : '' }}>Actif</option>
                                        <option value="inactif" {{ ($producteur->statut ?? 'actif') == 'inactif' ? 'selected' : '' }}>Inactif</option>
                                    </select>
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