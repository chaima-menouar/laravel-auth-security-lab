@extends('layouts.app')

@section('title', 'Laravel Authentication Security Lab')

@section('content')
<div class="py-5">
    <div class="text-center mb-5">
        <h1 class="display-5 fw-bold">
            Laravel Authentication Security Lab
        </h1>

        <p class="lead text-muted mx-auto" style="max-width: 760px;">
            A practical security lab demonstrating the difference between
            vulnerable and hardened authentication flows in Laravel.
        </p>
    </div>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card h-100 border-danger shadow-sm">
                <div class="card-body">
                    <h2 class="h4">Vulnerable Login</h2>

                    <p class="text-muted">
                        Demonstrates common authentication weaknesses,
                        including missing validation, rate limiting,
                        and session regeneration.
                    </p>

                    <span class="badge text-bg-danger">
                        Local / Testing Only
                    </span>
                </div>

                <div class="card-footer">
                    <a
                        href="{{ route('login.vulnerable.form') }}"
                        class="btn btn-outline-danger"
                    >
                        Open Demo
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h2 class="h4">Standard Login</h2>

                    <p class="text-muted">
                        A basic Laravel authentication flow with
                        server-side validation and session regeneration.
                    </p>
                </div>

                <div class="card-footer">
                    <a
                        href="{{ route('login.standard.form') }}"
                        class="btn btn-outline-primary"
                    >
                        Try Standard Login
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 border-success shadow-sm">
                <div class="card-body">
                    <h2 class="h4">Secure Login</h2>

                    <p class="text-muted">
                        A hardened authentication flow using validation,
                        generic authentication errors, rate limiting,
                        and session regeneration.
                    </p>

                    <span class="badge text-bg-success">
                        Recommended
                    </span>
                </div>

                <div class="card-footer">
                    <a
                        href="{{ route('login.secure.form') }}"
                        class="btn btn-outline-success"
                    >
                        Try Secure Login
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-5 shadow-sm">
        <div class="card-body">
            <h2 class="h4">Security Concepts Demonstrated</h2>

            <div class="row mt-3">
                <div class="col-md-6">
                    <ul>
                        <li>Server-side input validation</li>
                        <li>Authentication failure handling</li>
                        <li>Session regeneration</li>
                    </ul>
                </div>

                <div class="col-md-6">
                    <ul>
                        <li>Login rate limiting</li>
                        <li>Protected routes</li>
                        <li>Logout and session invalidation</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
