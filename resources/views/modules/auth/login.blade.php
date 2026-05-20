{{-- Login — centrado vertical, una columna con patita --}}
@extends('layouts.auth')

@section('titulo_pagina', 'Iniciar Sesión')

@push('styles')
<style>
    body.bg-gradient-primary { background: linear-gradient(135deg, #1a1f5e 0%, #4e73df 50%, #224abe 100%) !important; }
    .login-card { border-radius: 20px; overflow: hidden; animation: fadeInUp 0.6s ease; }
    .paw-icon { font-size: 4rem; color: #4e73df; margin-bottom: 0.75rem; animation: pulse 2s infinite; display: block; }
    .login-body { padding: 3rem 3.5rem; }
    .form-control-user { border-radius: 50px; border: 2px solid #e3e6f0; padding: 0.75rem 1.5rem; font-size: 0.95rem; transition: all 0.3s ease; }
    .form-control-user:focus { border-color: #4e73df; box-shadow: 0 0 0 0.2rem rgba(78,115,223,.2); }
    .input-icon-wrapper { position: relative; }
    .input-icon { position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: #b7bdd9; z-index: 10; }
    .input-icon-wrapper .form-control-user { padding-left: 2.8rem; }
    .btn-login { border-radius: 50px; padding: 0.75rem; font-size: 1rem; font-weight: 700; background: linear-gradient(135deg, #4e73df, #224abe); border: none; transition: all 0.3s ease; letter-spacing: 0.5px; }
    .btn-login:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(78,115,223,0.4); }
    .btn-login:active { transform: translateY(0); }
    .spinner-border-sm { display: none; }
    .loading .spinner-border-sm { display: inline-block; }
    .loading .btn-text { display: none; }
    .divider-text { position: relative; text-align: center; color: #b7bdd9; font-size: 0.8rem; margin: 1rem 0; }
    .divider-text::before, .divider-text::after { content: ''; position: absolute; top: 50%; width: 40%; height: 1px; background: #e3e6f0; }
    .divider-text::before { left: 0; }
    .divider-text::after { right: 0; }
    @keyframes fadeInUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes pulse { 0%,100% { transform: scale(1); } 50% { transform: scale(1.1); } }
</style>
@endpush

@section('contenido')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-7 col-md-9 col-sm-11">
            <div class="card border-0 shadow-lg login-card">
                <div class="card-body login-body">

                    {{-- Patita y título --}}
                    <div class="text-center mb-4">
                        <i class="fas fa-paw paw-icon"></i>
                        <h1 class="h4 text-gray-900 font-weight-bold">¡Bienvenido de nuevo!</h1>
                        <p class="text-muted small">Ingresa tus credenciales para continuar</p>
                    </div>

                    {{-- Errores --}}
                    @if (session('error') || $errors->any())
                        <div class="alert alert-danger border-0 shadow-sm" role="alert" style="border-radius:12px;">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            {{ session('error') ?? $errors->first() ?? 'Credenciales incorrectas.' }}
                        </div>
                    @endif

                    <form id="loginForm" action="{{ route('logear') }}" method="POST">
                        @csrf

                        <div class="form-group input-icon-wrapper">
                            <i class="fas fa-envelope input-icon"></i>
                            <input type="text"
                                   class="form-control form-control-user @error('email') is-invalid @enderror"
                                   id="email" name="email"
                                   value="{{ old('email') }}"
                                   placeholder="Correo electrónico"
                                   autofocus required>
                        </div>

                        <div class="form-group input-icon-wrapper">
                            <i class="fas fa-lock input-icon"></i>
                            <input type="password"
                                   class="form-control form-control-user @error('password') is-invalid @enderror"
                                   id="password" name="password"
                                   placeholder="Contraseña"
                                   required>
                        </div>

                        <button type="submit" class="btn btn-primary btn-login btn-block" id="btnLogin">
                            <span class="spinner-border spinner-border-sm mr-2" role="status"></span>
                            <span class="btn-text"><i class="fas fa-sign-in-alt mr-2"></i>Iniciar Sesión</span>
                        </button>
                    </form>

                    <div class="divider-text mt-3">acceso seguro</div>

                    <div class="text-center">
                        <small class="text-muted">
                            <i class="fas fa-shield-alt mr-1 text-success"></i>
                            Conexión protegida — solo personal autorizado
                        </small>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('loginForm').addEventListener('submit', function() {
    const btn = document.getElementById('btnLogin');
    btn.classList.add('loading');
    btn.disabled = true;
});
</script>
@endpush
