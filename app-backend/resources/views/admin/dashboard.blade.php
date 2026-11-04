@extends('layouts.admin')

@section('title', 'Dashboard | Electrónica Digital MX')
@section('page-title', 'Resumen General del Sistema')

@section('styles')
<style>
    .metrics-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1.5rem; margin-bottom: 2rem; }
    .metric-card { background: var(--admin-card); border-radius: 12px; padding: 1.5rem; border: 1px solid var(--admin-border); display: flex; align-items: center; gap: 1.2rem; }
    .metric-icon { width: 50px; height: 50px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem; }
    .icon-blue { background: #DBEAFE; color: #1D4ED8; }
    .icon-green { background: #D1FAE5; color: #047857; }
    .icon-purple { background: #EDE9FE; color: #6D28D9; }
    .metric-data h3 { font-size: 1.6rem; font-weight: 700; color: var(--admin-dark); line-height: 1.1; }
    .metric-data p { font-size: 0.8rem; color: var(--admin-muted); font-weight: 500; }
</style>
@endsection

@section('content')
    <!-- Métricas del Negocio -->
    <div class="metrics-grid">
        <div class="metric-card">
            <div class="metric-icon icon-blue"><i class="fa-solid fa-box-open"></i></div>
            <div class="metric-data">
                <h3>{{ $totalKits }}</h3>
                <p>Kits Publicados</p>
            </div>
        </div>

        <div class="metric-card">
            <div class="metric-icon icon-purple"><i class="fa-solid fa-layer-group"></i></div>
            <div class="metric-data">
                <h3>{{ $totalCategories }}</h3>
                <p>Categorías de Soluciones</p>
            </div>
        </div>

        <div class="metric-card">
            <div class="metric-icon icon-green"><i class="fa-brands fa-whatsapp"></i></div>
            <div class="metric-data">
                <h3>{{ $totalLeads }}</h3>
                <p>Cotizaciones Recibidas</p>
            </div>
        </div>
    </div>

    <!-- Tabla de Solicitudes Recientes (Leads) -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="fa-solid fa-clock-rotate-left"></i> Solicitudes de Cotización Recientes</h3>
            <span class="badge badge-blue">Trazabilidad Web</span>
        </div>

        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Cliente</th>
                        <th>Teléfono</th>
                        <th>Interés / Kit</th>
                        <th>Inmueble</th>
                        <th>Instalación</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentLeads as $lead)
                        <tr>
                            <td>{{ $lead->created_at->format('d/m/Y H:i') }}</td>
                            <td><strong>{{ $lead->customer_name }}</strong></td>
                            <td>{{ $lead->customer_phone ?? 'WhatsApp Directo' }}</td>
                            <td>
                                @if($lead->productKit)
                                    <span class="badge badge-blue">{{ $lead->productKit->name }}</span>
                                @else
                                    <span class="badge badge-warning">A la Medida ({{ $lead->camera_count }})</span>
                                @endif
                            </td>
                            <td>{{ $lead->property_type ?? 'N/A' }}</td>
                            <td>{{ $lead->requires_installation ? 'Sí' : 'No' }}</td>
                            <td>
                                <span class="badge badge-success">{{ ucfirst($lead->status) }}</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align:center; padding: 2rem; color: var(--admin-muted);">
                                No se han registrado solicitudes de cotización aún. Las solicitudes aparecerán automáticamente en cuanto los clientes coticen desde la web.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
