@extends('layouts.admin')

@section('title', 'Documentación Oficial del Sistema | Electrónica Digital MX')
@section('page-title', 'Centro de Documentación del Sistema')

@section('content')
<div style="max-width: 1100px; margin: 0 auto;">

    <!-- Selector de Pestañas Interactivas -->
    <div style="display: flex; gap: 0.6rem; border-bottom: 2px solid var(--admin-border); margin-bottom: 1.5rem; overflow-x: auto; padding-bottom: 0.2rem;">
        <button type="button" class="doc-tab-btn active" onclick="switchDocTab('manual')">
            <i class="fa-solid fa-book"></i> Manual de Usuario
        </button>
        <button type="button" class="doc-tab-btn" onclick="switchDocTab('tecnica')">
            <i class="fa-solid fa-microchip"></i> Memoria Técnica
        </button>
        <button type="button" class="doc-tab-btn" onclick="switchDocTab('despliegue')">
            <i class="fa-solid fa-cloud-arrow-up"></i> Guía de Despliegue
        </button>
    </div>

    <!-- PESTAÑA 1: MANUAL DE USUARIO -->
    <div id="tab-manual" class="doc-content-pane active card" style="padding: 2.2rem;">
        <div style="display:flex; justify-content:space-between; align-items:center; border-bottom:1px solid var(--admin-border); padding-bottom:1rem; margin-bottom:1.5rem;">
            <div>
                <h2 style="font-size:1.6rem; color:var(--admin-dark); margin-bottom:0.2rem;">
                    📘 Manual de Usuario Administrativo
                </h2>
                <p style="color:var(--admin-muted); font-size:0.88rem;">Guía paso a paso para el uso cotidiano, gestión de paquetes y cotizaciones.</p>
            </div>
            <span class="badge badge-success"><i class="fa-solid fa-check"></i> Producción v1.0</span>
        </div>

        <div class="doc-markdown-body">
            <pre style="white-space: pre-wrap; font-family: 'Plus Jakarta Sans', sans-serif; font-size: 0.92rem; line-height: 1.65; color: var(--admin-text); background: transparent; border: none; padding: 0;">{{ $userManual }}</pre>
        </div>
    </div>

    <!-- PESTAÑA 2: MEMORIA TÉCNICA -->
    <div id="tab-tecnica" class="doc-content-pane card" style="display:none; padding: 2.2rem;">
        <div style="display:flex; justify-content:space-between; align-items:center; border-bottom:1px solid var(--admin-border); padding-bottom:1rem; margin-bottom:1.5rem;">
            <div>
                <h2 style="font-size:1.6rem; color:var(--admin-dark); margin-bottom:0.2rem;">
                    ⚙️ Memoria Técnica y Arquitectura de Software
                </h2>
                <p style="color:var(--admin-muted); font-size:0.88rem;">Especificaciones de ingeniería, modelo entidad-relación, seguridad y endpoints.</p>
            </div>
            <span class="badge badge-blue"><i class="fa-solid fa-code"></i> Laravel 11 + PHP 8.2</span>
        </div>

        <div class="doc-markdown-body">
            <pre style="white-space: pre-wrap; font-family: 'Plus Jakarta Sans', sans-serif; font-size: 0.92rem; line-height: 1.65; color: var(--admin-text); background: transparent; border: none; padding: 0;">{{ $technicalDoc }}</pre>
        </div>
    </div>

    <!-- PESTAÑA 3: GUÍA DE DESPLIEGUE -->
    <div id="tab-despliegue" class="doc-content-pane card" style="display:none; padding: 2.2rem;">
        <div style="display:flex; justify-content:space-between; align-items:center; border-bottom:1px solid var(--admin-border); padding-bottom:1rem; margin-bottom:1.5rem;">
            <div>
                <h2 style="font-size:1.6rem; color:var(--admin-dark); margin-bottom:0.2rem;">
                    🚀 Guía de Despliegue en la Nube
                </h2>
                <p style="color:var(--admin-muted); font-size:0.88rem;">Instrucciones de compilación, contenedores Docker y puesta en marcha en Render.</p>
            </div>
            <span class="badge badge-warning"><i class="fa-solid fa-server"></i> Docker / Render</span>
        </div>

        <div class="doc-markdown-body">
            <pre style="white-space: pre-wrap; font-family: 'Plus Jakarta Sans', sans-serif; font-size: 0.92rem; line-height: 1.65; color: var(--admin-text); background: transparent; border: none; padding: 0;">{{ $deploymentGuide }}</pre>
        </div>
    </div>

</div>
@endsection

@section('scripts')
<script>
    function switchDocTab(tabName) {
        // Ocultar todos los paneles
        document.querySelectorAll('.doc-content-pane').forEach(pane => {
            pane.style.display = 'none';
            pane.classList.remove('active');
        });

        // Desactivar botones
        document.querySelectorAll('.doc-tab-btn').forEach(btn => {
            btn.classList.remove('active');
        });

        // Activar seleccionado
        const targetPane = document.getElementById('tab-' + tabName);
        if (targetPane) {
            targetPane.style.display = 'block';
            targetPane.classList.add('active');
        }

        const activeBtn = event.currentTarget;
        if (activeBtn) {
            activeBtn.classList.add('active');
        }
    }
</script>
<style>
    .doc-tab-btn {
        background: transparent;
        border: none;
        padding: 0.75rem 1.4rem;
        font-size: 0.95rem;
        font-weight: 700;
        color: var(--admin-muted);
        cursor: pointer;
        border-bottom: 3px solid transparent;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        border-radius: 6px 6px 0 0;
        transition: all 0.2s ease;
    }
    .doc-tab-btn:hover {
        color: var(--admin-blue);
        background: rgba(21, 78, 231, 0.04);
    }
    .doc-tab-btn.active {
        color: var(--admin-blue);
        border-bottom-color: var(--admin-blue);
        background: var(--admin-card);
    }
    .doc-markdown-body pre {
        background-color: #F8FAFC !important;
        border: 1px solid var(--admin-border) !important;
        border-radius: 8px;
        padding: 1.5rem !important;
        overflow-x: auto;
    }
</style>
@endsection
