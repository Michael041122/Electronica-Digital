@extends('layouts.admin')

@section('title', 'Documentación Oficial del Sistema | Electrónica Digital MX')
@section('page-title', 'Documentación Técnica y Manuales del Sistema')

@section('styles')
<style>
    /* Estilos del Centro de Documentación Técnica (UI/UX Pro Max) */
    .doc-portal-wrapper {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
        max-width: 1400px;
        margin: 0 auto;
    }

    /* Cabecera del Portal */
    .doc-hero-card {
        background: var(--admin-card);
        border: 1px solid var(--admin-border);
        border-radius: 12px;
        padding: 1.75rem 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1.25rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
        position: relative;
        overflow: hidden;
    }

    .doc-hero-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: var(--admin-blue);
    }

    .doc-hero-info h1 {
        font-family: 'Outfit', sans-serif;
        font-size: 1.5rem;
        font-weight: 800;
        color: var(--admin-dark);
        margin-bottom: 0.35rem;
        letter-spacing: -0.02em;
    }

    .doc-hero-info p {
        font-size: 0.88rem;
        color: var(--admin-muted);
        line-height: 1.5;
    }

    .doc-hero-badges {
        display: flex;
        gap: 0.6rem;
        flex-wrap: wrap;
    }

    .doc-pill-tag {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        font-size: 0.76rem;
        font-weight: 700;
        padding: 0.35rem 0.75rem;
        border-radius: 6px;
        background: rgba(45, 91, 255, 0.08);
        color: var(--admin-blue);
        border: 1px solid rgba(45, 91, 255, 0.18);
    }

    .doc-pill-tag.success {
        background: rgba(16, 185, 129, 0.08);
        color: #059669;
        border-color: rgba(16, 185, 129, 0.2);
    }

    .doc-pill-tag.dark {
        background: #F1F5F9;
        color: #475569;
        border-color: #E2E8F0;
    }

    /* Pestañas Principales */
    .doc-tabs-nav {
        display: flex;
        gap: 0.5rem;
        border-bottom: 2px solid var(--admin-border);
        overflow-x: auto;
        padding-bottom: 0;
    }

    .doc-tab-trigger {
        background: transparent;
        border: none;
        border-bottom: 3px solid transparent;
        padding: 0.85rem 1.4rem;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.92rem;
        font-weight: 700;
        color: var(--admin-muted);
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        border-radius: 8px 8px 0 0;
        transition: all 0.2s ease;
        white-space: nowrap;
    }

    .doc-tab-trigger i {
        font-size: 0.95rem;
    }

    .doc-tab-trigger:hover {
        color: var(--admin-dark);
        background: rgba(0, 0, 0, 0.02);
    }

    .doc-tab-trigger.active {
        color: var(--admin-blue);
        border-bottom-color: var(--admin-blue);
        background: var(--admin-card);
    }

    /* Layout Split: Contenido + Índice Rápido */
    .doc-split-layout {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 280px;
        gap: 1.75rem;
        align-items: start;
    }

    @media (max-width: 1080px) {
        .doc-split-layout {
            grid-template-columns: 1fr;
        }
        .doc-toc-sidebar {
            display: none !important;
        }
    }

    /* Índice Lateral de Secciones */
    .doc-toc-sidebar {
        background: var(--admin-card);
        border: 1px solid var(--admin-border);
        border-radius: 12px;
        padding: 1.25rem 1.4rem;
        position: sticky;
        top: 96px;
        box-shadow: 0 4px 18px rgba(0, 0, 0, 0.03);
    }

    .doc-toc-title {
        font-family: 'Outfit', sans-serif;
        font-size: 0.82rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: var(--admin-muted);
        margin-bottom: 0.85rem;
        display: flex;
        align-items: center;
        gap: 0.45rem;
    }

    .doc-toc-list {
        list-style: none;
        display: flex;
        flex-direction: column;
        gap: 0.35rem;
        max-height: calc(100vh - 220px);
        overflow-y: auto;
    }

    .doc-toc-item a {
        display: block;
        padding: 0.4rem 0.6rem;
        border-radius: 6px;
        color: var(--admin-text);
        text-decoration: none;
        font-size: 0.82rem;
        line-height: 1.35;
        transition: all 0.15s ease;
        border-left: 2px solid transparent;
    }

    .doc-toc-item.level-3 a {
        padding-left: 1.2rem;
        font-size: 0.78rem;
        color: var(--admin-muted);
    }

    .doc-toc-item a:hover {
        background: rgba(45, 91, 255, 0.06);
        color: var(--admin-blue);
        border-left-color: var(--admin-blue);
    }

    /* Contenido Renderizado del Documento */
    .doc-article-card {
        background: var(--admin-card);
        border: 1px solid var(--admin-border);
        border-radius: 12px;
        padding: 2.75rem clamp(1.5rem, 4vw, 3rem);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
        min-height: 600px;
    }

    .doc-pane {
        display: none;
    }

    .doc-pane.active {
        display: block;
        animation: docFadeIn 0.25s ease-out;
    }

    @keyframes docFadeIn {
        from { opacity: 0; transform: translateY(4px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Tipografía y Elementos Renderizados */
    .doc-header-banner {
        border-bottom: 2px solid var(--admin-border);
        padding-bottom: 1.25rem;
        margin-bottom: 2.2rem;
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .doc-h1 {
        font-family: 'Outfit', sans-serif;
        font-size: clamp(1.6rem, 2.5vw, 2.1rem);
        font-weight: 800;
        color: var(--admin-dark);
        letter-spacing: -0.03em;
        line-height: 1.15;
    }

    .doc-meta-badge {
        font-size: 0.75rem;
        font-weight: 700;
        color: var(--admin-blue);
        background: rgba(45, 91, 255, 0.08);
        padding: 0.35rem 0.75rem;
        border-radius: 6px;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
    }

    .doc-h2 {
        font-family: 'Outfit', sans-serif;
        font-size: 1.35rem;
        font-weight: 800;
        color: var(--admin-dark);
        margin: 2.5rem 0 1rem;
        padding-bottom: 0.6rem;
        border-bottom: 1px solid var(--admin-border);
        display: flex;
        align-items: center;
        gap: 0.6rem;
        letter-spacing: -0.02em;
    }

    .doc-h2-indicator {
        width: 8px;
        height: 18px;
        background: var(--admin-blue);
        border-radius: 2px;
        display: inline-block;
    }

    .doc-h3 {
        font-family: 'Outfit', sans-serif;
        font-size: 1.05rem;
        font-weight: 700;
        color: var(--admin-dark);
        margin: 1.75rem 0 0.75rem;
        display: flex;
        align-items: center;
        gap: 0.45rem;
    }

    .doc-h3-arrow {
        color: var(--admin-blue);
        font-size: 0.85rem;
    }

    .doc-h4 {
        font-size: 0.95rem;
        font-weight: 700;
        color: var(--admin-dark);
        margin: 1.25rem 0 0.5rem;
    }

    .doc-paragraph {
        font-size: 0.92rem;
        line-height: 1.8;
        color: var(--admin-text);
        margin-bottom: 1.15rem;
    }

    .doc-paragraph strong {
        color: var(--admin-dark);
        font-weight: 700;
    }

    /* Listas Semánticas */
    .doc-list, .doc-ordered-list {
        margin: 0.75rem 0 1.35rem 1.5rem;
        display: flex;
        flex-direction: column;
        gap: 0.45rem;
    }

    .doc-list li, .doc-ordered-list li {
        font-size: 0.9rem;
        line-height: 1.7;
        color: var(--admin-text);
    }

    .doc-list li strong, .doc-ordered-list li strong {
        color: var(--admin-dark);
    }

    /* Enlaces y Código Inline */
    .doc-inline-code {
        background: #F1F5F9;
        color: #0F172A;
        border: 1px solid var(--admin-border);
        border-radius: 4px;
        padding: 0.15rem 0.4rem;
        font-family: Consolas, 'Fira Code', monospace;
        font-size: 0.84em;
        font-weight: 600;
    }

    .doc-link {
        color: var(--admin-blue);
        font-weight: 600;
        text-decoration: none;
        border-bottom: 1px solid rgba(45, 91, 255, 0.3);
        transition: border-color 0.15s ease;
    }

    .doc-link:hover {
        border-bottom-color: var(--admin-blue);
    }

    .doc-ext-icon {
        font-size: 0.7rem;
        margin-left: 0.15rem;
    }

    /* Bloques de Código Fenced con Botón de Copiado */
    .doc-code-block {
        background: #0F172A;
        border-radius: 8px;
        margin: 1.5rem 0;
        overflow: hidden;
        border: 1px solid #1E293B;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.12);
    }

    .doc-code-header {
        background: #1E293B;
        padding: 0.5rem 1rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #334155;
    }

    .doc-code-lang {
        font-family: Consolas, monospace;
        font-size: 0.75rem;
        font-weight: 700;
        color: #94A3B8;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
    }

    .doc-copy-btn {
        background: transparent;
        border: 1px solid #475569;
        color: #CBD5E1;
        font-size: 0.72rem;
        font-weight: 600;
        padding: 0.2rem 0.6rem;
        border-radius: 4px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        transition: all 0.15s ease;
    }

    .doc-copy-btn:hover {
        background: #334155;
        color: #FFFFFF;
        border-color: #64748B;
    }

    .doc-code-block pre {
        padding: 1.25rem 1.2rem;
        margin: 0;
        overflow-x: auto;
    }

    .doc-code-block code {
        font-family: Consolas, 'Fira Code', monospace;
        font-size: 0.85rem;
        line-height: 1.6;
        color: #F8FAFC;
        white-space: pre;
    }

    /* Tablas Estilizadas */
    .doc-table-container {
        overflow-x: auto;
        margin: 1.5rem 0;
        border: 1px solid var(--admin-border);
        border-radius: 8px;
        background: var(--admin-card);
    }

    .doc-table {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
        font-size: 0.85rem;
    }

    .doc-table th {
        background: #F8FAFC;
        color: var(--admin-dark);
        font-weight: 700;
        padding: 0.75rem 1rem;
        border-bottom: 1px solid var(--admin-border);
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .doc-table td {
        padding: 0.8rem 1rem;
        border-bottom: 1px solid var(--admin-border);
        color: var(--admin-text);
        line-height: 1.5;
    }

    .doc-table tr:last-child td {
        border-bottom: none;
    }

    .doc-table tr:hover {
        background: rgba(45, 91, 255, 0.02);
    }

    /* Callouts Técnicos */
    .doc-callout {
        border-radius: 8px;
        padding: 1rem 1.25rem;
        margin: 1.35rem 0;
        border-left: 4px solid;
    }

    .doc-callout-badge {
        font-size: 0.75rem;
        font-weight: 800;
        letter-spacing: 0.05em;
        margin-bottom: 0.4rem;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
    }

    .doc-callout-content {
        font-size: 0.88rem;
        line-height: 1.65;
    }

    .doc-callout-info {
        background: rgba(45, 91, 255, 0.05);
        border-left-color: var(--admin-blue);
        color: var(--admin-text);
    }
    .doc-callout-info .doc-callout-badge { color: var(--admin-blue); }

    .doc-callout-tip {
        background: rgba(16, 185, 129, 0.06);
        border-left-color: #10B981;
        color: var(--admin-text);
    }
    .doc-callout-tip .doc-callout-badge { color: #059669; }

    .doc-callout-warning {
        background: rgba(245, 158, 11, 0.08);
        border-left-color: #F59E0B;
        color: var(--admin-text);
    }
    .doc-callout-warning .doc-callout-badge { color: #B45309; }

    .doc-callout-danger {
        background: rgba(239, 68, 68, 0.08);
        border-left-color: #EF4444;
        color: var(--admin-text);
    }
    .doc-callout-danger .doc-callout-badge { color: #DC2626; }

    .doc-divider {
        border: none;
        border-top: 1px solid var(--admin-border);
        margin: 2.5rem 0;
    }

    /* Overrides Dark Mode */
    @media (prefers-color-scheme: dark) {
        .doc-pill-tag.dark { background: #272B35; color: #CBD5E1; border-color: #373D4B; }
        .doc-inline-code { background: #20242E; color: #E2E8F0; border-color: #353B47; }
        .doc-table th { background: #20242E; color: #F1F5F9; }
        .doc-callout-info { background: rgba(45, 91, 255, 0.12); }
        .doc-callout-tip { background: rgba(16, 185, 129, 0.12); }
        .doc-callout-warning { background: rgba(245, 158, 11, 0.12); }
        .doc-callout-danger { background: rgba(239, 68, 68, 0.12); }
    }
    html[data-admin-theme='dark'] .doc-pill-tag.dark { background: #272B35; color: #CBD5E1; border-color: #373D4B; }
    html[data-admin-theme='dark'] .doc-inline-code { background: #20242E; color: #E2E8F0; border-color: #353B47; }
    html[data-admin-theme='dark'] .doc-table th { background: #20242E; color: #F1F5F9; }
    html[data-admin-theme='dark'] .doc-callout-info { background: rgba(45, 91, 255, 0.12); }
    html[data-admin-theme='dark'] .doc-callout-tip { background: rgba(16, 185, 129, 0.12); }
    html[data-admin-theme='dark'] .doc-callout-warning { background: rgba(245, 158, 11, 0.12); }
    html[data-admin-theme='dark'] .doc-callout-danger { background: rgba(239, 68, 68, 0.12); }
</style>
@endsection

@section('content')
<div class="doc-portal-wrapper">

    <!-- Tarjeta Principal del Portal de Documentación -->
    <div class="doc-hero-card">
        <div class="doc-hero-info">
            <h1>Centro de Documentación Técnica</h1>
            <p>Especificaciones formales de ingeniería, memoria descriptiva de software y manual operativo de Electrónica Digital MX.</p>
        </div>
        <div class="doc-hero-badges">
            <span class="doc-pill-tag"><i class="fa-solid fa-code-branch"></i> Versión 1.2</span>
            <span class="doc-pill-tag success"><i class="fa-solid fa-circle-check"></i> Producción</span>
            <span class="doc-pill-tag dark"><i class="fa-solid fa-building-columns"></i> Residencia Profesional TESSFP</span>
            <button type="button" class="btn btn-secondary btn-sm" onclick="window.print()" title="Imprimir o Exportar PDF">
                <i class="fa-solid fa-print"></i> Imprimir
            </button>
        </div>
    </div>

    <!-- Navegación por Pestañas Técnicas (Sin emojis) -->
    <nav class="doc-tabs-nav" aria-label="Secciones de documentación">
        <button type="button" class="doc-tab-trigger active" onclick="switchDocTab('manual', this)">
            <i class="fa-solid fa-book-bookmark"></i> Manual de Usuario
        </button>
        <button type="button" class="doc-tab-trigger" onclick="switchDocTab('tecnica', this)">
            <i class="fa-solid fa-microchip"></i> Memoria Técnica
        </button>
        <button type="button" class="doc-tab-trigger" onclick="switchDocTab('despliegue', this)">
            <i class="fa-solid fa-cloud-arrow-up"></i> Guía de Despliegue
        </button>
    </nav>

    <!-- PESTAÑA 1: MANUAL DE USUARIO -->
    <div id="tab-manual" class="doc-pane active">
        <div class="doc-split-layout">
            <article class="doc-article-card">
                {!! $userManual !!}
            </article>

            <aside class="doc-toc-sidebar" aria-label="Índice de contenido">
                <div class="doc-toc-title">
                    <i class="fa-solid fa-list-ul"></i> Índice de Secciones
                </div>
                <ul class="doc-toc-list">
                    @foreach($userManualToc as $item)
                        <li class="doc-toc-item level-{{ $item['level'] }}">
                            <a href="#{{ $item['slug'] }}">{{ $item['title'] }}</a>
                        </li>
                    @endforeach
                </ul>
            </aside>
        </div>
    </div>

    <!-- PESTAÑA 2: MEMORIA TÉCNICA -->
    <div id="tab-tecnica" class="doc-pane">
        <div class="doc-split-layout">
            <article class="doc-article-card">
                {!! $technicalDoc !!}
            </article>

            <aside class="doc-toc-sidebar" aria-label="Índice de contenido">
                <div class="doc-toc-title">
                    <i class="fa-solid fa-list-ul"></i> Índice Técnico
                </div>
                <ul class="doc-toc-list">
                    @foreach($technicalDocToc as $item)
                        <li class="doc-toc-item level-{{ $item['level'] }}">
                            <a href="#{{ $item['slug'] }}">{{ $item['title'] }}</a>
                        </li>
                    @endforeach
                </ul>
            </aside>
        </div>
    </div>

    <!-- PESTAÑA 3: GUÍA DE DESPLIEGUE -->
    <div id="tab-despliegue" class="doc-pane">
        <div class="doc-split-layout">
            <article class="doc-article-card">
                {!! $deploymentGuide !!}
            </article>

            <aside class="doc-toc-sidebar" aria-label="Índice de contenido">
                <div class="doc-toc-title">
                    <i class="fa-solid fa-list-ul"></i> Índice de Despliegue
                </div>
                <ul class="doc-toc-list">
                    @foreach($deploymentGuideToc as $item)
                        <li class="doc-toc-item level-{{ $item['level'] }}">
                            <a href="#{{ $item['slug'] }}">{{ $item['title'] }}</a>
                        </li>
                    @endforeach
                </ul>
            </aside>
        </div>
    </div>

</div>
@endsection

@section('scripts')
<script>
    function switchDocTab(tabName, triggerBtn) {
        // Ocultar paneles
        document.querySelectorAll('.doc-pane').forEach(pane => {
            pane.classList.remove('active');
        });

        // Desactivar botones
        document.querySelectorAll('.doc-tab-trigger').forEach(btn => {
            btn.classList.remove('active');
        });

        // Activar seleccionado
        const targetPane = document.getElementById('tab-' + tabName);
        if (targetPane) {
            targetPane.classList.add('active');
        }

        if (triggerBtn) {
            triggerBtn.classList.add('active');
        }
    }

    function copyCodeToClipboard(btn) {
        const pre = btn.closest('.doc-code-block').querySelector('code');
        if (!pre) return;

        navigator.clipboard.writeText(pre.innerText).then(() => {
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="fa-solid fa-check"></i> Copiado';
            btn.style.color = '#10B981';
            btn.style.borderColor = '#10B981';

            setTimeout(() => {
                btn.innerHTML = originalText;
                btn.style.color = '';
                btn.style.borderColor = '';
            }, 2000);
        }).catch(err => {
            console.error('Error al copiar código: ', err);
        });
    }
</script>
@endsection
