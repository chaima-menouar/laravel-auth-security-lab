@extends('layouts.app')

@section('title', 'Tableau de bord')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0">
                    <i class="bi bi-speedometer2 me-2"></i>Tableau de bord
                </h4>
            </div>
            <div class="card-body">
                <div class="alert alert-success">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    Bienvenue, {{ Auth::user()->email }} !
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5><i class="bi bi-shield-check text-primary me-2"></i>Login Standard</h5>
                                <p>Version basique avec validation Laravel</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5><i class="bi bi-shield-lock text-warning me-2"></i>Login Sécurisé</h5>
                                <p>Protection contre les attaques par force brute</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger">
                        <i class="bi bi-box-arrow-right me-2"></i>Déconnexion
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection