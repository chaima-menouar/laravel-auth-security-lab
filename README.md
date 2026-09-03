# Laravel Authentication Security Lab

[![Laravel Tests](https://github.com/chaima-menouar/laravel-auth-security-lab/actions/workflows/tests.yml/badge.svg)](https://github.com/chaima-menouar/laravel-auth-security-lab/actions/workflows/tests.yml)

An educational Laravel application that compares vulnerable, standard, and hardened authentication flows. The project demonstrates how validation, generic error messages, login throttling, session regeneration, protected routes, and secure logout improve authentication security.

## Project Objective

The objective of this lab is to demonstrate authentication security controls through three implementations:

| Authentication flow | Input validation | Generic errors | Rate limiting | Session regeneration | Availability |
|---|---:|---:|---:|---:|---|
| Vulnerable | No | No | No | No | Local and testing only |
| Standard | Yes | Yes | No | Yes | All environments |
| Secure | Yes | Yes | 3 attempts per 5 minutes | Yes | All environments |

The vulnerable implementation is intentionally restricted to local and testing environments. It must never be exposed in production.

## Security Controls Demonstrated

- Server-side input validation
- Generic authentication failure messages
- Login attempt rate limiting
- Session ID regeneration after authentication
- CSRF protection on forms
- Authentication middleware for protected routes
- Session invalidation and CSRF token regeneration on logout
- Environment-based isolation of the vulnerable demonstration

## Technology Stack

- PHP 8.2+
- Laravel 12
- SQLite
- Blade
- Bootstrap 5
- Tailwind CSS 4
- Vite 6
- PHPUnit 11
- GitHub Actions

## Application Routes

| Route | Description | Access |
|---|---|---|
| `/` | Security lab overview | Public |
| `/auth/vulnerable` | Intentionally weak authentication demonstration | Local and testing only |
| `/auth/standard` | Standard authentication flow | Guests |
| `/auth/secure` | Hardened authentication flow | Guests |
| `/dashboard` | Protected dashboard | Authenticated users |

## Local Installation

### Prerequisites

- PHP 8.2 or later
- Composer
- Node.js 20 or later
- npm
- SQLite

### Setup

```bash
git clone https://github.com/chaima-menouar/laravel-auth-security-lab.git
cd laravel-auth-security-lab

composer install
npm install

cp .env.example .env
php artisan key:generate

php -r "file_exists('database/database.sqlite') || touch('database/database.sqlite');"
php artisan migrate --seed

npm run build
php artisan serve
```

Open `http://127.0.0.1:8000` in your browser.

## Local Demo Account

The database seeder creates the following local account:

```text
Email: test@example.com
Password: password
```

These credentials are for local demonstration only and must not be used in production.

## Running the Tests

```bash
php artisan test
```

The feature test suite verifies:

- Public access to the landing page
- Redirection of unauthenticated users
- Successful standard authentication
- Successful secure authentication
- Rejection of invalid credentials
- Rate limiting after repeated login attempts
- Secure logout behavior

GitHub Actions automatically installs the dependencies, builds the frontend assets, and runs the test suite after each push or pull request to the `main` branch.

## Project Structure

```text
app/Http/Controllers/LoginFaille/
    StandardLoginController.php
    SecureLoginController.php
    VulnerableLoginController.php

resources/views/login-faille/
    standard.blade.php
    secure.blade.php
    vulnerable.blade.php

routes/web.php
tests/Feature/AuthenticationSecurityTest.php
.github/workflows/tests.yml
```

## Security Notice

This repository is an educational security lab. The vulnerable authentication flow intentionally omits important protections so that the implementations can be compared. Run the vulnerable demonstration only in an isolated local or testing environment.

## Author

Chaima Menouar  
AI and Digital Transformation Engineering Student

[LinkedIn](https://www.linkedin.com/in/chaima-menouar-93554524a/)
