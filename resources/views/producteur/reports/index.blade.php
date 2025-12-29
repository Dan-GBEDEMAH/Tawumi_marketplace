@extends('producteur.layout')

@section('title', 'Mes rapports')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Mes rapports et statistiques</h1>
    </div>

    <!-- Statistiques -->
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Revenus totaux
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($statistiques['total_revenus'], 2) }} Fcfa</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total commandes
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $statistiques['total_commandes'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Commandes ce mois
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $statistiques['commandes_ce_mois'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Mes produits
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ \App\Models\Produit::where('id_producteur_fk', auth()->id())->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-box fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Graphiques -->
    <div class="row">
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Analyse de mes ventes</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myAreaChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Répartition de mes ventes</h6>
                </div>
                <div class="card-body">
                    <div class="chart-pie pt-4">
                        <canvas id="myPieChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Détails supplémentaires -->
    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Mes produits les plus vendus</h6>
                </div>
                <div class="card-body">
                    <p class="mb-0">Vos produits les plus populaires.</p>
                    <!-- Vous pouvez ajouter une liste ou un graphique ici -->
                </div>
            </div>
        </div>
        
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Activité récente</h6>
                </div>
                <div class="card-body">
                    <p class="mb-0">Dernières activités pour vos produits.</p>
                    <!-- Vous pouvez ajouter une liste d'activités récentes ici -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Exemple de graphique (à personnaliser selon vos données)
const ctx = document.getElementById('myAreaChart');
new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Aoû', 'Sep', 'Oct', 'Nov', 'Déc'],
        datasets: [{
            label: 'Ventes',
            lineTension: 0.3,
            backgroundColor: 'rgba(78, 115, 223, 0.05)',
            borderColor: 'rgba(78, 115, 223, 1)',
            pointRadius: 3,
            pointBackgroundColor: 'rgba(78, 115, 223, 1)',
            pointBorderColor: 'rgba(78, 115, 223, 1)',
            pointHoverRadius: 3,
            pointHoverBackgroundColor: 'rgba(78, 115, 223, 1)',
            pointHoverBorderColor: 'rgba(78, 115, 223, 1)',
            pointHitRadius: 10,
            pointBorderWidth: 2,
            data: [0, 10000, 5000, 15000, 10000, 20000, 15000, 25000, 20000, 30000, 25000, 40000],
        }],
    },
    options: {
        maintainAspectRatio: false,
        layout: {
            padding: {
                left: 10,
                right: 25,
                top: 25,
                bottom: 0
            }
        },
        scales: {
            x: {
                grid: {
                    display: false,
                    drawBorder: false
                }
            },
            y: {
                grid: {
                    color: 'rgb(234, 236, 244)',
                    zeroLineColor: 'rgb(234, 236, 244)',
                    drawBorder: false,
                    borderDash: [2],
                    zeroLineBorderDash: [2]
                }
            }
        },
        plugins: {
            legend: {
                display: false
            },
            tooltip: {
                backgroundColor: 'rgb(255, 255, 255)',
                bodyColor: 'rgb(73, 80, 87)',
                titleMarginBottom: 10,
                titleColor: 'rgb(73, 80, 87)',
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                intersect: false,
                mode: 'index',
                position: 'nearest'
            }
        }
    }
});

const ctx2 = document.getElementById('myPieChart');
new Chart(ctx2, {
    type: 'doughnut',
    data: {
        labels: ['Produits', 'Commandes', 'Revenus'],
        datasets: [{
            data: [55, 30, 15],
            backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
            hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
            hoverBorderColor: 'rgba(234, 236, 244, 1)',
        }],
    },
    options: {
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: true
            }
        },
        cutout: '80%',
    }
});
</script>
@endsection