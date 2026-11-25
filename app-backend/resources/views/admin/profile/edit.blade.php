@extends('layouts.admin')

@section('title', 'Modificar Datos de Usuario | Electrónica Digital MX')
@section('page-title', 'Modificación de Datos de Usuario y Acceso')

@section('styles')
<style>
    .profile-form-container {
        max-width: 820px;
        margin: 0 auto;
    }

    .profile-header-card {
        background: var(--admin-card);
        border: 1px solid var(--admin-border);
        border-radius: 12px;
        padding: 1.5rem 1.75rem;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 1.25rem;
    }

    .profile-avatar-large {
        width: 58px;
        height: 58px;
        border-radius: 50%;
        background: rgba(37, 99, 235, 0.1);
        border: 2px solid rgba(37, 99, 235, 0.25);
        color: var(--admin-blue);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        flex-shrink: 0;
    }

    .profile-header-info h2 {
        font-family: 'Outfit', sans-serif;
        font-size: 1.25rem;
        font-weight: 800;
        color: var(--admin-dark);
        margin-bottom: 0.2rem;
    }

    .profile-header-info p {
        font-size: 0.82rem;
        color: var(--admin-muted);
    }

    .form-field-group {
        display: flex;
        flex-direction: column;
        gap: 0.4rem;
        margin-bottom: 1.25rem;
    }

    .form-field-group label {
        font-size: 0.84rem;
        font-weight: 700;
        color: var(--admin-dark);
        letter-spacing: 0.01em;
    }

    .form-field-input {
        width: 100%;
        height: 46px;
        padding: 0 1rem;
        border: 1.5px solid var(--admin-border);
        border-radius: 8px;
        background: var(--admin-card);
        color: var(--admin-text);
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.9rem;
        outline: none;
        transition: all 0.2s ease;
    }

    .form-field-input:focus {
        border-color: var(--admin-blue);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
    }

    .form-field-help {
        font-size: 0.76rem;
        color: var(--admin-muted);
        line-height: 1.4;
    }

    .profile-action-bar {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 0.85rem;
        margin-top: 1.75rem;
    }
</style>
@endsection

@section('content')
<div class="profile-form-container">
    
    <div class="profile-header-card">
        <div class="profile-avatar-large">
            <i class="fa-solid fa-user-shield"></i>
        </div>
        <div class="profile-header-info">
            <h2>{{ $user->name }}</h2>
            <p>Cuenta Administrativa Principal • Control de Acceso y Gestión Operativa</p>
        </div>
    </div>

    @if($errors->any())
        <div style="background-color: rgba(239, 68, 68, 0.08); border: 1px solid rgba(239, 68, 68, 0.25); color: #EF4444; padding: 1rem 1.25rem; border-radius: 8px; margin-bottom: 1.5rem;">
            <div style="display: flex; align-items: center; gap: 0.5rem; font-weight: 700; margin-bottom: 0.4rem; font-size: 0.88rem;">
                <i class="fa-solid fa-triangle-exclamation"></i> Por favor corrige los siguientes errores:
            </div>
            <ul style="margin-left: 1.5rem; font-size: 0.84rem; line-height: 1.6;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.profile.update') }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Tarjeta 1: Información General de la Cuenta -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fa-solid fa-id-card"></i> Datos Generales de la Cuenta
                </h3>
            </div>
            
            <div class="form-field-group">
                <label for="name">Nombre Completo del Administrador:</label>
                <input type="text" id="name" name="name" class="form-field-input" value="{{ old('name', $user->name) }}" required>
                <span class="form-field-help">Nombre oficial que aparecerá en los registros y encabezados del sistema.</span>
            </div>

            <div class="form-field-group">
                <label for="email">Correo Electrónico Institucional (Usuario de Acceso):</label>
                <input type="email" id="email" name="email" class="form-field-input" value="{{ old('email', $user->email) }}" required>
                <span class="form-field-help">Este correo es la credencial principal para iniciar sesión en la plataforma.</span>
            </div>
        </div>

        <!-- Tarjeta 2: Seguridad y Cambio de Contraseña -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fa-solid fa-key"></i> Seguridad y Actualización de Contraseña
                </h3>
            </div>
            <p style="font-size: 0.84rem; color: var(--admin-muted); margin-bottom: 1.35rem; line-height: 1.5;">
                Deja los campos siguientes vacíos si únicamente requieres modificar tu nombre o correo electrónico.
            </p>

            <div class="form-field-group">
                <label for="current_password">Contraseña Actual:</label>
                <input type="password" id="current_password" name="current_password" class="form-field-input" placeholder="••••••••••••">
                <span class="form-field-help">Requerida por seguridad criptográfica para autorizar cualquier cambio de contraseña.</span>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1rem;">
                <div class="form-field-group">
                    <label for="password">Nueva Contraseña:</label>
                    <input type="password" id="password" name="password" class="form-field-input" placeholder="Mínimo 8 caracteres">
                </div>

                <div class="form-field-group">
                    <label for="password_confirmation">Confirmar Nueva Contraseña:</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-field-input" placeholder="Repite la nueva contraseña">
                </div>
            </div>
        </div>

        <div class="profile-action-bar">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                <i class="fa-solid fa-arrow-left"></i> Cancelar
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="fa-solid fa-floppy-disk"></i> Guardar Cambios
            </button>
        </div>
    </form>
</div>
@endsection
