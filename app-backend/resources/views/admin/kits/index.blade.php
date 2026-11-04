@extends('layouts.admin')

@section('title', 'Kits de Seguridad | Electrónica Digital MX')
@section('page-title', 'Gestión de Kits y Paquetes de Seguridad')

@section('content')
    <div class="card">
        <div class="card-header">
            <div>
                <h3 class="card-title"><i class="fa-solid fa-boxes-stacked"></i> Catálogo de Kits Registrados</h3>
                <p style="font-size: 0.85rem; color: var(--admin-muted);">Administra los kits visibles para los clientes en el cotizador interactivo.</p>
            </div>
            <a href="{{ route('admin.kits.create') }}" class="btn btn-primary">
                <i class="fa-solid fa-plus"></i> Nuevo Kit
            </a>
        </div>

        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Imagen</th>
                        <th>Nombre del Kit</th>
                        <th>Categoría</th>
                        <th>Distintivo (Badge)</th>
                        <th>Precio Estimado</th>
                        <th>Instalación</th>
                        <th>Estado</th>
                        <th style="text-align: right;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kits as $kit)
                        <tr>
                            <td>
                                <img src="{{ $kit->image_url }}" alt="{{ $kit->name }}" style="width: 50px; height: 38px; object-fit: cover; border-radius: 4px;">
                            </td>
                            <td>
                                <strong>{{ $kit->name }}</strong>
                                <small style="display:block; color: var(--admin-muted);">{{ Str::limit($kit->specs_summary, 45) }}</small>
                            </td>
                            <td>{{ $kit->category->name ?? 'General' }}</td>
                            <td>
                                @if($kit->badge)
                                    <span class="badge badge-warning">{{ $kit->badge }}</span>
                                @else
                                    <span style="color: var(--admin-muted); font-size: 0.8rem;">Ninguno</span>
                                @endif
                            </td>
                            <td>
                                <strong>{{ $kit->estimated_price ? '$' . number_format($kit->estimated_price, 2) : 'A Cotizar' }}</strong>
                            </td>
                            <td>
                                {{ $kit->includes_installation ? 'Incluida' : 'Solo Equipos' }}
                            </td>
                            <td>
                                @if($kit->is_active)
                                    <span class="badge badge-success">Activo</span>
                                @else
                                    <span class="badge" style="background:#F1F5F9; color:#64748B;">Oculto</span>
                                @endif
                            </td>
                            <td style="text-align: right; white-space: nowrap;">
                                <a href="{{ route('admin.kits.edit', $kit) }}" class="btn btn-secondary btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                                <form action="{{ route('admin.kits.destroy', $kit) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('¿Seguro que deseas eliminar este kit?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" style="text-align:center; padding: 2rem;">No hay kits registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
