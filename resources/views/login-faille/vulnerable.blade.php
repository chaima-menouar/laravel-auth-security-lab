@extends('layouts.app')

@section('title', 'Login Vulnérable')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6 col-lg-4">
        <div class="card border-danger shadow-sm">
            <div class="card-header bg-danger text-white">
                <h4 class="mb-0">Connexion Vulnérable</h4>
            </div>
            <div class="card-body">
                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login.vulnerable') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Email ou SQL Injection</label>
                        <input type="text" class="form-control" name="email">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-exclamation-triangle me-2"></i>Tester la vulnérabilité
                        </button>
                    </div>
                </form>
            </div>
            <div class="card-footer text-center bg-danger bg-opacity-10">
                <small class="text-danger">Attention: Ce formulaire est intentionnellement vulnérable</small>
            </div>
        </div>
    </div>
</div>
@endsection