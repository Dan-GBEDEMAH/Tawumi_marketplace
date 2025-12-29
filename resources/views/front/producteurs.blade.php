@extends('layouts.front')

@section('content')
    <div class="container py-5">
        <h1>Producteurs</h1>
        <p>Page des producteurs locaux. Découvrez les producteurs de votre région et leurs produits frais.</p>
        
        <!-- Vous pouvez ajouter ici la liste des producteurs -->
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ asset('assets/images/producteur1.jpg') }}" class="card-img-top" alt="Producteur 1">
                    <div class="card-body">
                        <h5 class="card-title">Producteur 1</h5>
                        <p class="card-text">Producteur de légumes bio</p>
                        <a href="#" class="btn btn-primary">Voir les produits</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ asset('assets/images/producteur2.jpg') }}" class="card-img-top" alt="Producteur 2">
                    <div class="card-body">
                        <h5 class="card-title">Producteur 2</h5>
                        <p class="card-text">Producteur de fruits locaux</p>
                        <a href="#" class="btn btn-primary">Voir les produits</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ asset('assets/images/producteur3.jpg') }}" class="card-img-top" alt="Producteur 3">
                    <div class="card-body">
                        <h5 class="card-title">Producteur 3</h5>
                        <p class="card-text">Producteur de céréales</p>
                        <a href="#" class="btn btn-primary">Voir les produits</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection