@extends('layouts.app')

@section('title', 'Vulnerable Login Demo')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-7 col-lg-5">
        <div class="card border-danger shadow-sm">
            <div class="card-header bg-danger text-white">
                <h1 class="h4 mb-0">Vulnerable Login Demo</h1>
            </div>

            <div class="card-body">
                <div class="alert alert-warning">
                    <strong>Local security demonstration only.</strong>

                    <ul class="mb-0 mt-2">
                        <li>No input validation</li>
                        <li>No login rate limiting</li>
                        <li>No session ID regeneration</li>
                    </ul>
                </div>

                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login.vulnerable') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">
                            Email address
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="email"
                            name="email"
                            autocomplete="email"
                        >
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">
                            Password
                        </label>

                        <input
                            type="password"
                            class="form-control"
                            id="password"
                            name="password"
                            autocomplete="current-password"
                        >
                    </div>

                    <button type="submit" class="btn btn-danger w-100">
                        Test vulnerable login
                    </button>
                </form>
            </div>

            <div class="card-footer text-danger">
                This route is available only in local and testing environments.
            </div>
        </div>
    </div>
</div>
@endsection
