@extends('layouts.main')

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Tableau de bord Administrateur</h4>
                </div>
                <div class="card-body">
                    <h5>Bienvenue, {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}!</h5>
                    
                    <div class="row mt-4">
                        <div class="col-md-3">
                            <div class="card mb-3 bg-info text-white">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Membres</h5>
                                    <p class="display-4">0</p>
                                    <a href="#" class="btn btn-outline-light btn-sm">Gérer</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card mb-3 bg-success text-white">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Entraîneurs</h5>
                                    <p class="display-4">0</p>
                                    <a href="#" class="btn btn-outline-light btn-sm">Gérer</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card mb-3 bg-warning text-white">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Sessions</h5>
                                    <p class="display-4">0</p>
                                    <a href="#" class="btn btn-outline-light btn-sm">Gérer</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card mb-3 bg-danger text-white">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Abonnements</h5>
                                    <p class="display-4">0</p>
                                    <a href="#" class="btn btn-outline-light btn-sm">Gérer</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">Utilisateurs récents</h5>
                                </div>
                                <div class="card-body">
                                    <p class="text-muted">Aucun utilisateur inscrit récemment.</p>
                                    <a href="#" class="btn btn-primary btn-sm">Voir tous les utilisateurs</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">Statistiques</h5>
                                </div>
                                <div class="card-body">
                                    <p class="text-muted">Aucune donnée disponible pour le moment.</p>
                                    <a href="#" class="btn btn-primary btn-sm">Voir toutes les statistiques</a>
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
                                        <a href="#" class="btn btn-outline-primary btn-block">Ajouter un membre</a>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <a href="#" class="btn btn-outline-primary btn-block">Ajouter un entraîneur</a>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <a href="#" class="btn btn-outline-primary btn-block">Créer une session</a>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <a href="#" class="btn btn-outline-primary btn-block">Gérer les abonnements</a>
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