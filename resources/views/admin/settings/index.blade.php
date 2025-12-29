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
                    <form>
                        <div class="form-group">
                            <label for="nom_plateforme">Nom de la plateforme</label>
                            <input type="text" class="form-control" id="nom_plateforme" value="TawumiConfirm" placeholder="Entrez le nom de la plateforme">
                        </div>
                        <div class="form-group">
                            <label for="description_plateforme">Description de la plateforme</label>
                            <textarea class="form-control" id="description_plateforme" rows="3" placeholder="Entrez la description de la plateforme">Plateforme de commerce équitable pour les producteurs locaux</textarea>
                        </div>
                        <div class="form-group">
                            <label for="email_contact">Email de contact</label>
                            <input type="email" class="form-control" id="email_contact" value="contact@tawumi.com" placeholder="Entrez l'email de contact">
                        </div>
                        <div class="form-group">
                            <label for="telephone_support">Téléphone de support</label>
                            <input type="text" class="form-control" id="telephone_support" value="+229 0000 0000" placeholder="Entrez le téléphone de support">
                        </div>
                        <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
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
                    <a href="#" class="btn btn-warning btn-block mb-2">Changer le mot de passe</a>
                    <a href="#" class="btn btn-danger btn-block">Sauvegarder les données</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection