@extends('layouts.app')

@section('title', 'Login Sécurisé')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6 col-lg-4">
        <div class="card border-warning shadow-sm">
            <div class="card-header bg-warning text-dark">
                <h4 class="mb-0">Connexion Sécurisée</h4>
            </div>
            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger">
                        @if(str_contains($errors->first(), 'Trop de tentatives'))
                            <i class="bi bi-shield-lock-fill me-2"></i>
                        @endif
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login.secure') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Adresse Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="password" name="password" required>
                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-warning text-dark">
                            <i class="bi bi-shield-lock me-2"></i>Connexion sécurisée
                        </button>
                    </div>
                </form>
            </div>
            <div class="card-footer text-center">
                <small class="text-muted">3 tentatives max avant blocage</small>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('togglePassword').addEventListener('click', function() {
    const password = document.getElementById('password');
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    this.innerHTML = type === 'password' ? '<i class="bi bi-eye"></i>' : '<i class="bi bi-eye-slash"></i>';
});
</script>
@endsection