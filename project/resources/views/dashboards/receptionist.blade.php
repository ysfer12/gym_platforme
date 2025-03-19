@extends('layouts.main')

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Tableau de bord Réceptionniste</h4>
                </div>
                <div class="card-body">
                    <h5>Bienvenue, {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}!</h5>
                    
                    <div class="row mt-4">
                        <div class="col-md-4">
                            <div class="card mb-3 bg-info text-white">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Sessions du jour</h5>
                                    <p class="display-4">0</p>
                                    <a href="#" class="btn btn-outline-light btn-sm">Voir planning</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mb-3 bg-success text-white">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Entrées aujourd'hui</h5>
                                    <p class="display-4">0</p>
                                    <a href="#" class="btn btn-outline-light btn-sm">Détails</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mb-3 bg-warning text-white">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Abonnements à renouveler</h5>
                                    <p class="display-4">0</p>
                                    <a href="#" class="btn btn-outline-light btn-sm">Voir liste</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">Enregistrer une entrée</h5>
                                </div>
                                <div class="card-body">
                                    <form class="form-inline">
                                        <div class="form-group mx-sm-3 mb-2">
                                            <label for="memberID" class="sr-only">ID Membre</label>
                                            <input type="text" class="form-control" id="memberID" placeholder="ID ou Email du membre">
                                        </div>
                                        <button type="submit" class="btn btn-primary mb-2">Valider entrée</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">Paiements récents</h5>
                                </div>
                                <div class="card-body">
                                    <p class="text-muted">Aucun paiement enregistré récemment.</p>
                                    <a href="#" class="btn btn-primary btn-sm">Enregistrer un paiement</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">Notifications</h5>
                                </div>
                                <div class="card-body">
                                    <p class="text-muted">Pas de notifications récentes.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">Actions rapides</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3 mb-2">
                                        <a href="#" class="btn btn-outline-primary btn-block">Nouvel abonnement</a>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <a href="#" class="btn btn-outline-primary btn-block">Réservation session</a>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <a href="#" class="btn btn-outline-primary btn-block">Rechercher membre</a>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <a href="#" class="btn btn-outline-primary btn-block">Planning du jour</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection