@extends('layouts.admin')

@section('title', 'Kits de Seguridad | Electrónica Digital MX')
@section('page-title', 'Catálogo de Kits y Paquetes de Seguridad')

@section('content')
    <div class="card">
        <div class="card-header">
            <div>
                <h3 class="card-title">
                    <i class="fa-solid fa-boxes-stacked"></i> Inventario y Paquetes en Catálogo
                </h3>
                <p style="font-size: 0.82rem; color: var(--admin-muted); margin-top: 0.25rem;">
                    Administra los paquetes y soluciones de videovigilancia visibles en el cotizador interactivo.
                </p>
            </div>
            <a href="{{ route('admin.kits.create') }}" class="btn btn-primary">
                <i class="fa-solid fa-plus"></i> Registrar Nuevo Kit
            </a>
        </div>

        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Fotografía</th>
                        <th>Nombre del Paquete</th>
                        <th>Categoría</th>
                        <th>Distintivo</th>
                        <th>Precio Base</th>
                        <th>Instalación</th>
                        <th>Estado</th>
                        <th style="text-align: right;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kits as $kit)
                        <tr>
                            <td>
                                @if($kit->image_url)
                                    <img src="{{ Str::startsWith($kit->image_url, ['http://', 'https://']) ? $kit->image_url : asset('storage/' . $kit->image_url) }}" 
                                         alt="{{ $kit->name }}" 
                                         style="width: 52px; height: 40px; object-fit: cover; border-radius: 6px; border: 1px solid var(--admin-border); background: var(--admin-hover);">
                                @else
                                    <div style="width: 52px; height: 40px; border-radius: 6px; background: var(--admin-hover); border: 1px solid var(--admin-border); display: flex; align-items: center; justify-content: center; color: var(--admin-muted); font-size: 0.8rem;">
                                        <i class="fa-solid fa-image"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <strong>{{ $kit->name }}</strong>
                                <small style="display: block; color: var(--admin-muted); margin-top: 2px;">
                                    {{ Str::limit($kit->specs_summary, 50) }}
                                </small>
                            </td>
                            <td>
                                <span class="badge badge-blue">
                                    {{ $kit->category->name ?? 'General' }}
                                </span>
                            </td>
                            <td>
                                @if($kit->badge)
                                    <span class="badge badge-warning">{{ $kit->badge }}</span>
                                @else
                                    <span style="color: var(--admin-muted); font-size: 0.78rem;">Ninguno</span>
                                @endif
                            </td>
                            <td>
                                <strong style="font-family: Consolas, monospace; font-size: 0.9rem;">
                                    {{ $kit->estimated_price ? '$' . number_format($kit->estimated_price, 2) . ' MXN' : 'A Cotizar' }}
                                </strong>
                            </td>
                            <td>
                                @if($kit->includes_installation)
                                    <span class="badge badge-success"><i class="fa-solid fa-screwdriver-wrench"></i> Incluida</span>
                                @else
                                    <span style="font-size: 0.8rem; color: var(--admin-muted);">Solo Equipos</span>
                                @endif
                            </td>
                            <td>
                                @if($kit->is_active)
                                    <span class="badge badge-success"><i class="fa-solid fa-check"></i> Activo</span>
                                @else
                                    <span class="badge" style="background: rgba(148, 163, 184, 0.1); color: #64748B; border: 1px solid rgba(148, 163, 184, 0.2);">
                                        Oculto
                                    </span>
                                @endif
                            </td>
                            <td style="text-align: right; white-space: nowrap;">
                                <a href="{{ route('admin.kits.edit', $kit) }}" class="btn btn-secondary btn-sm" title="Editar paquete">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <form action="{{ route('admin.kits.destroy', $kit) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('¿Seguro que deseas eliminar este kit del catálogo?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Eliminar kit">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" style="text-align: center; padding: 3rem 1.5rem; color: var(--admin-muted);">
                                <i class="fa-solid fa-boxes-stacked" style="font-size: 2rem; margin-bottom: 0.75rem; display: block; opacity: 0.5;"></i>
                                No se encontraron kits registrados en la base de datos.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
