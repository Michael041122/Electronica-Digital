@extends('layouts.admin')

@section('title', 'Modificar Datos de Usuario | Electrónica Digital MX')
@section('page-title', 'Modificación de Datos de Usuario')

@section('content')
<div style="max-width: 800px; margin: 0 auto;">
    
    @if($errors->any())
        <div style="background-color: #FEF2F2; border: 1px solid #FCA5A5; color: #991B1B; padding: 1rem 1.25rem; border-radius: 8px; margin-bottom: 1.5rem;">
            <div style="display:flex; align-items:center; gap:0.5rem; font-weight:700; margin-bottom:0.5rem;">
                <i class="fa-solid fa-triangle-exclamation"></i> Revisa los siguientes errores:
            </div>
            <ul style="margin-left: 1.5rem; font-size: 0.9rem;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.profile.update') }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Tarjeta 1: Información de la Cuenta -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fa-solid fa-id-card"></i> Datos Generales de la Cuenta</h3>
            </div>
            
            <div style="display: grid; gap: 1.2rem;">
                <div>
                    <label for="name" style="display:block; font-size:0.9rem; font-weight:700; margin-bottom:0.4rem; color:var(--admin-text);">
                        Nombre Completo o Razón del Administrador:
                    </label>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required
                           style="width:100%; padding:0.75rem 1rem; border:1px solid var(--admin-border); border-radius:8px; font-size:0.95rem;">
                    <small style="color:var(--admin-muted); font-size:0.8rem;">Nombre visible en el encabezado del panel y registros de actividad.</small>
                </div>

                <div>
                    <label for="email" style="display:block; font-size:0.9rem; font-weight:700; margin-bottom:0.4rem; color:var(--admin-text);">
                        Correo Electrónico (Usuario de Acceso):
                    </label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required
                           style="width:100%; padding:0.75rem 1rem; border:1px solid var(--admin-border); border-radius:8px; font-size:0.95rem;">
                    <small style="color:var(--admin-muted); font-size:0.8rem;">Este correo se utiliza para iniciar sesión en `/login`.</small>
                </div>
            </div>
        </div>

        <!-- Tarjeta 2: Cambio de Contraseña -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fa-solid fa-key"></i> Seguridad y Cambio de Contraseña</h3>
            </div>
            <p style="font-size:0.88rem; color:var(--admin-muted); margin-bottom:1.2rem;">
                Deja estos campos en blanco si solo deseas modificar tu nombre o correo electrónico.
            </p>

            <div style="display: grid; gap: 1.2rem;">
                <div>
                    <label for="current_password" style="display:block; font-size:0.9rem; font-weight:700; margin-bottom:0.4rem; color:var(--admin-text);">
                        Contraseña Actual:
                    </label>
                    <input type="password" id="current_password" name="current_password" placeholder="••••••••"
                           style="width:100%; padding:0.75rem 1rem; border:1px solid var(--admin-border); border-radius:8px; font-size:0.95rem;">
                    <small style="color:var(--admin-muted); font-size:0.8rem;">Requerida para confirmar cualquier cambio de contraseña.</small>
                </div>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1rem;">
                    <div>
                        <label for="password" style="display:block; font-size:0.9rem; font-weight:700; margin-bottom:0.4rem; color:var(--admin-text);">
                            Nueva Contraseña:
                        </label>
                        <input type="password" id="password" name="password" placeholder="Mínimo 8 caracteres"
                               style="width:100%; padding:0.75rem 1rem; border:1px solid var(--admin-border); border-radius:8px; font-size:0.95rem;">
                    </div>

                    <div>
                        <label for="password_confirmation" style="display:block; font-size:0.9rem; font-weight:700; margin-bottom:0.4rem; color:var(--admin-text);">
                            Confirmar Nueva Contraseña:
                        </label>
                        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Repite la nueva contraseña"
                               style="width:100%; padding:0.75rem 1rem; border:1px solid var(--admin-border); border-radius:8px; font-size:0.95rem;">
                    </div>
                </div>
            </div>
        </div>

        <div style="display:flex; justify-content:flex-end; gap:1rem; margin-top:1.5rem;">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                <i class="fa-solid fa-arrow-left"></i> Cancelar
            </a>
            <button type="submit" class="btn btn-primary" style="padding:0.75rem 1.75rem;">
                <i class="fa-solid fa-floppy-disk"></i> Guardar Cambios
            </button>
        </div>
    </form>
</div>
@endsection
