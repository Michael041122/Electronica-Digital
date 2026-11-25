@extends('layouts.admin')

@section('title', 'Dashboard Operativo | Electrónica Digital MX')
@section('page-title', 'Resumen General y Monitoreo Operativo')

@section('styles')
<style>
    .dash-welcome-card {
        background: linear-gradient(135deg, rgba(37, 99, 235, 0.08) 0%, rgba(16, 185, 129, 0.04) 100%);
        border: 1px solid var(--admin-border);
        border-left: 4px solid var(--admin-blue);
        border-radius: 12px;
        padding: 1.5rem 1.75rem;
        margin-bottom: 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .welcome-text h2 {
        font-family: 'Outfit', sans-serif;
        font-size: 1.35rem;
        font-weight: 800;
        color: var(--admin-dark);
        margin-bottom: 0.25rem;
    }

    .welcome-text p {
        font-size: 0.86rem;
        color: var(--admin-muted);
        line-height: 1.5;
    }

    .quick-actions-bar {
        display: flex;
        gap: 0.6rem;
        flex-wrap: wrap;
    }

    .metrics-grid { 
        display: grid; 
        grid-template-columns: repeat(3, minmax(0, 1fr)); 
        gap: 1.25rem; 
        margin-bottom: 1.75rem; 
    }

    .metric-card { 
        background: var(--admin-card); 
        border-radius: 12px; 
        padding: 1.5rem; 
        border: 1px solid var(--admin-border); 
        display: flex; 
        align-items: center; 
        gap: 1.15rem; 
        box-shadow: 0 4px 18px rgba(0, 0, 0, 0.02);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .metric-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.05);
    }

    .metric-icon { 
        width: 52px; 
        height: 52px; 
        border-radius: 12px; 
        display: flex; 
        align-items: center; 
        justify-content: center; 
        font-size: 1.25rem;
        flex-shrink: 0;
    }

    .icon-blue { 
        background: rgba(37, 99, 235, 0.1); 
        color: var(--admin-blue); 
        border: 1px solid rgba(37, 99, 235, 0.2);
    }

    .icon-green { 
        background: rgba(16, 185, 129, 0.1); 
        color: #059669; 
        border: 1px solid rgba(16, 185, 129, 0.2);
    }

    .icon-purple { 
        background: rgba(139, 92, 246, 0.1); 
        color: #7C3AED; 
        border: 1px solid rgba(139, 92, 246, 0.2);
    }

    .metric-data {
        display: flex;
        flex-direction: column;
    }

    .metric-data h3 { 
        font-family: 'Outfit', sans-serif; 
        font-size: 2rem; 
        font-weight: 800; 
        color: var(--admin-dark); 
        line-height: 1.1; 
        letter-spacing: -0.02em;
    }

    .metric-data p { 
        margin-top: 0.25rem; 
        font-size: 0.8rem; 
        color: var(--admin-muted); 
        font-weight: 700; 
        text-transform: uppercase;
        letter-spacing: 0.04em;
    }

    .lead-badge-custom {
        font-family: Consolas, monospace;
        font-size: 0.75rem;
        padding: 0.25rem 0.5rem;
        border-radius: 4px;
        background: rgba(245, 158, 11, 0.1);
        color: #B45309;
        border: 1px solid rgba(245, 158, 11, 0.25);
    }

    @media (max-width: 980px) {
        .metrics-grid { grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 0.75rem; }
        .metric-card { padding: 1rem; gap: 0.75rem; }
        .metric-icon { width: 44px; height: 44px; font-size: 1.1rem; }
        .metric-data h3 { font-size: 1.6rem; }
    }

    @media (max-width: 760px) {
        .metrics-grid { grid-template-columns: 1fr; }
        .dash-welcome-card { flex-direction: column; align-items: flex-start; }
    }
</style>
@endsection

@section('content')
    <!-- Banner de Bienvenida y Telemetría -->
    <div class="dash-welcome-card">
        <div class="welcome-text">
            <h2>Consola de Gestión y Telemetría • Sucursal Toluca</h2>
            <p>Supervisión en tiempo real de catálogo de soluciones, leads web y manuales de ingeniería.</p>
        </div>
        <div class="quick-actions-bar">
            <a href="{{ route('admin.kits.create') }}" class="btn btn-primary btn-sm">
                <i class="fa-solid fa-plus"></i> Registrar Kit
            </a>
            <a href="{{ route('admin.docs') }}" class="btn btn-secondary btn-sm">
                <i class="fa-solid fa-book-bookmark"></i> Consultar Docs
            </a>
        </div>
    </div>

    <!-- Métricas del Negocio -->
    <div class="metrics-grid">
        <div class="metric-card">
            <div class="metric-icon icon-blue"><i class="fa-solid fa-boxes-stacked"></i></div>
            <div class="metric-data">
                <h3>{{ $totalKits }}</h3>
                <p>Kits en Catálogo</p>
            </div>
        </div>

        <div class="metric-card">
            <div class="metric-icon icon-purple"><i class="fa-solid fa-network-wired"></i></div>
            <div class="metric-data">
                <h3>{{ $totalCategories }}</h3>
                <p>Categorías de Solución</p>
            </div>
        </div>

        <div class="metric-card">
            <div class="metric-icon icon-green"><i class="fa-solid fa-comments"></i></div>
            <div class="metric-data">
                <h3>{{ $totalLeads }}</h3>
                <p>Cotizaciones Recibidas</p>
            </div>
        </div>
    </div>

    <!-- Tabla de Solicitudes Recientes (Leads) -->
    <div class="card">
        <div class="card-header">
            <div>
                <h3 class="card-title">
                    <i class="fa-solid fa-clock-rotate-left"></i> Registro de Prospectos y Cotizaciones (Leads Web)
                </h3>
                <p style="font-size: 0.82rem; color: var(--admin-muted); margin-top: 0.25rem;">
                    Monitoreo de solicitudes generadas desde el portal público con enlace directo a WhatsApp.
                </p>
            </div>
            <span class="badge badge-blue"><i class="fa-solid fa-database"></i> Persistencia MySQL</span>
        </div>

        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Fecha y Hora</th>
                        <th>Cliente / Contacto</th>
                        <th>Canal de Entrada</th>
                        <th>Solución / Kit de Interés</th>
                        <th>Inmueble</th>
                        <th>Instalación</th>
                        <th>Estado de Seguimiento</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentLeads as $lead)
                        <tr>
                            <td>
                                <span style="font-family: Consolas, monospace; font-size: 0.8rem; color: var(--admin-muted);">
                                    {{ $lead->created_at->format('d/m/Y H:i') }}
                                </span>
                            </td>
                            <td>
                                <strong>{{ $lead->customer_name }}</strong>
                            </td>
                            <td>
                                <span style="font-size: 0.82rem; color: var(--admin-muted);">
                                    <i class="fa-brands fa-whatsapp" style="color: #10B981;"></i> {{ $lead->customer_phone ?? 'WhatsApp Web' }}
                                </span>
                            </td>
                            <td>
                                @if($lead->productKit)
                                    <span class="badge badge-blue">
                                        <i class="fa-solid fa-box"></i> {{ $lead->productKit->name }}
                                    </span>
                                @else
                                    <span class="lead-badge-custom">
                                        Personalizado ({{ $lead->camera_count ?? 'N/D' }})
                                    </span>
                                @endif
                            </td>
                            <td>
                                <span style="font-size: 0.82rem;">{{ $lead->property_type ?? 'N/A' }}</span>
                            </td>
                            <td>
                                @if($lead->requires_installation)
                                    <span class="badge badge-success"><i class="fa-solid fa-check"></i> Requerida</span>
                                @else
                                    <span style="font-size: 0.8rem; color: var(--admin-muted);">Solo Equipo</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge badge-success">
                                    <i class="fa-solid fa-circle-check"></i> {{ ucfirst($lead->status) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align: center; padding: 3rem 1.5rem; color: var(--admin-muted);">
                                <i class="fa-solid fa-inbox" style="font-size: 2rem; margin-bottom: 0.75rem; display: block; opacity: 0.5;"></i>
                                No se han registrado solicitudes de cotización aún. Las consultas de los clientes en el portal web se registrarán automáticamente aquí.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
