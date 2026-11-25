<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panel de Control | Electrónica Digital MX')</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Outfit:wght@600;700;800&family=Fira+Code:wght@500;600&display=swap" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --admin-dark: #0A1120;
            --admin-sidebar: #0B132B;
            --admin-sidebar-border: #1C2541;
            --admin-blue: #2563EB;
            --admin-blue-light: #3B82F6;
            --admin-emerald: #10B981;
            --admin-bg: #F8FAFC;
            --admin-card: #FFFFFF;
            --admin-text: #1E293B;
            --admin-muted: #64748B;
            --admin-border: #E2E8F0;
            --admin-hover: #F1F5F9;
        }

        html[data-admin-theme='dark'] {
            --admin-dark: #F8FAFC;
            --admin-sidebar: #070B16;
            --admin-sidebar-border: #1E293B;
            --admin-blue: #3B82F6;
            --admin-blue-light: #60A5FA;
            --admin-emerald: #10B981;
            --admin-bg: #0B1120;
            --admin-card: #0F172A;
            --admin-text: #E2E8F0;
            --admin-muted: #94A3B8;
            --admin-border: #1E293B;
            --admin-hover: #1E293B;
        }

        @media (prefers-color-scheme: dark) {
            :root:not([data-admin-theme='light']) {
                --admin-dark: #F8FAFC;
                --admin-sidebar: #070B16;
                --admin-sidebar-border: #1E293B;
                --admin-blue: #3B82F6;
                --admin-blue-light: #60A5FA;
                --admin-emerald: #10B981;
                --admin-bg: #0B1120;
                --admin-card: #0F172A;
                --admin-text: #E2E8F0;
                --admin-muted: #94A3B8;
                --admin-border: #1E293B;
                --admin-hover: #1E293B;
            }
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            background: var(--admin-bg); 
            color: var(--admin-text); 
            display: flex; 
            min-height: 100vh; 
            font-family: 'Plus Jakarta Sans', sans-serif;
            transition: background 0.25s ease, color 0.25s ease;
        }

        /* BARRA LATERAL (SIDEBAR DE TELECOMUNICACIONES) */
        .sidebar { 
            width: 265px; 
            background: var(--admin-sidebar); 
            color: #FFFFFF; 
            display: flex; 
            flex-direction: column; 
            flex-shrink: 0; 
            border-right: 1px solid var(--admin-sidebar-border);
            position: relative;
            z-index: 30;
        }

        .sidebar-brand-wrapper {
            padding: 1.5rem 1.25rem 1.25rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            display: flex;
            align-items: center;
            gap: 0.85rem;
        }

        .sidebar-brand-img {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            background: #FFFFFF;
            padding: 2px;
            object-fit: cover;
            border: 2px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.3);
            flex-shrink: 0;
        }

        .brand-text h2 {
            font-family: 'Outfit', sans-serif;
            font-size: 0.98rem;
            font-weight: 800;
            color: #FFFFFF;
            line-height: 1.15;
            letter-spacing: -0.01em;
        }

        .brand-text h2 span {
            color: #38BDF8;
            font-size: 0.72rem;
            background: rgba(56, 189, 248, 0.15);
            padding: 1px 5px;
            border-radius: 3px;
            margin-left: 3px;
        }

        .brand-text p {
            margin-top: 3px;
            font-size: 0.68rem;
            font-weight: 600;
            color: #94A3B8;
            letter-spacing: 0.02em;
        }

        /* Widget de Telemetría en Sidebar */
        .sidebar-telemetry-widget {
            margin: 1rem 1.15rem 0.5rem;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.07);
            border-radius: 8px;
            padding: 0.55rem 0.85rem;
            display: flex;
            align-items: center;
            gap: 0.65rem;
        }

        .telemetry-dot {
            width: 8px;
            height: 8px;
            background: var(--admin-emerald);
            border-radius: 50%;
            box-shadow: 0 0 8px var(--admin-emerald);
            flex-shrink: 0;
            animation: pulseGlow 2s infinite;
        }

        @keyframes pulseGlow {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.4; transform: scale(0.85); }
        }

        .telemetry-text {
            display: flex;
            flex-direction: column;
            line-height: 1.2;
        }

        .telemetry-node {
            font-size: 0.7rem;
            font-weight: 800;
            color: #E2E8F0;
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }

        .telemetry-state {
            font-size: 0.65rem;
            color: #34D399;
            font-weight: 600;
        }

        /* Menú de Navegación */
        .sidebar-nav-container {
            padding: 0.85rem 0.85rem 1.5rem;
            flex-grow: 1;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
        }

        .sidebar-group-label {
            font-size: 0.65rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: #64748B;
            padding: 0 0.6rem;
            margin-bottom: 0.4rem;
        }

        .sidebar-menu-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }

        .sidebar-menu-list a {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            min-height: 42px;
            padding: 0.6rem 0.8rem;
            color: #94A3B8;
            text-decoration: none;
            border-radius: 8px;
            font-size: 0.84rem;
            font-weight: 600;
            transition: all 0.18s ease;
            position: relative;
        }

        .sidebar-menu-list a i {
            width: 20px;
            font-size: 0.95rem;
            text-align: center;
            color: #64748B;
            transition: color 0.18s ease;
        }

        .sidebar-menu-list a:hover {
            color: #FFFFFF;
            background: rgba(255, 255, 255, 0.05);
            transform: translateX(2px);
        }

        .sidebar-menu-list a:hover i {
            color: #38BDF8;
        }

        .sidebar-menu-list a.active {
            background: var(--admin-blue);
            color: #FFFFFF;
            font-weight: 700;
            box-shadow: 0 4px 14px rgba(37, 99, 235, 0.35);
        }

        .sidebar-menu-list a.active i {
            color: #FFFFFF;
        }

        /* Footer del Sidebar */
        .sidebar-footer {
            padding: 1.15rem 1.25rem;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            background: rgba(0, 0, 0, 0.15);
        }

        .btn-logout {
            width: 100%;
            background: transparent;
            border: 1px solid rgba(239, 68, 68, 0.25);
            color: #F87171;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 0.82rem;
            font-weight: 700;
            padding: 0.55rem 0.85rem;
            border-radius: 6px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: all 0.2s ease;
        }

        .btn-logout:hover {
            background: rgba(239, 68, 68, 0.15);
            color: #EF4444;
            border-color: #EF4444;
        }

        /* ÁREA PRINCIPAL DE TRABAJO */
        .main-wrapper { 
            flex-grow: 1; 
            min-width: 0; 
            display: flex; 
            flex-direction: column; 
        }

        /* BARRA SUPERIOR (TOPBAR TÉCNICO) */
        .topbar { 
            height: 72px; 
            background: var(--admin-card); 
            border-bottom: 1px solid var(--admin-border); 
            display: flex; 
            align-items: center; 
            justify-content: space-between; 
            padding: 0 2rem; 
            position: sticky;
            top: 0;
            z-index: 20;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .topbar-breadcrumb {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.78rem;
            font-weight: 600;
            color: var(--admin-muted);
        }

        .topbar-breadcrumb a {
            color: var(--admin-muted);
            text-decoration: none;
            transition: color 0.15s ease;
        }

        .topbar-breadcrumb a:hover {
            color: var(--admin-blue);
        }

        .topbar-breadcrumb-sep {
            color: var(--admin-border);
            font-size: 0.7rem;
        }

        .topbar-title-text { 
            font-family: 'Outfit', sans-serif; 
            font-size: 1.15rem; 
            font-weight: 800; 
            color: var(--admin-dark); 
            letter-spacing: -0.02em;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 0.85rem;
        }

        /* Chips de Telemetría en Topbar */
        .telemetry-chip {
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            background: var(--admin-hover);
            border: 1px solid var(--admin-border);
            border-radius: 6px;
            padding: 0.35rem 0.65rem;
            font-size: 0.74rem;
            font-weight: 700;
            color: var(--admin-muted);
        }

        .telemetry-chip i {
            color: var(--admin-blue);
        }

        .telemetry-chip .status-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: var(--admin-emerald);
        }

        /* Perfil de Usuario */
        .admin-profile-pill { 
            display: flex; 
            align-items: center; 
            gap: 0.65rem; 
            padding: 0.35rem 0.8rem 0.35rem 0.45rem;
            background: var(--admin-hover);
            border: 1px solid var(--admin-border);
            border-radius: 999px;
            text-decoration: none; 
            color: var(--admin-dark); 
            font-size: 0.82rem; 
            font-weight: 700; 
            transition: all 0.18s ease;
        }

        .admin-profile-pill:hover {
            border-color: var(--admin-blue);
            background: rgba(37, 99, 235, 0.06);
            color: var(--admin-blue);
        }

        .admin-profile-avatar { 
            width: 32px; 
            height: 32px; 
            border-radius: 50%; 
            background: var(--admin-blue); 
            color: #FFFFFF; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            font-size: 0.82rem;
            box-shadow: 0 2px 6px rgba(37, 99, 235, 0.3);
        }

        .admin-profile-pill .gear-icon {
            font-size: 0.72rem;
            color: var(--admin-muted);
        }

        /* Alternador de Tema */
        .theme-toggle-btn { 
            width: 36px; 
            height: 36px; 
            border: 1px solid var(--admin-border); 
            border-radius: 50%; 
            background: var(--admin-card); 
            color: var(--admin-muted); 
            cursor: pointer; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            font-size: 0.9rem;
            transition: all 0.2s ease;
        }

        .theme-toggle-btn:hover {
            color: var(--admin-blue);
            border-color: var(--admin-blue);
            transform: rotate(15deg);
        }

        /* CONTENIDO */
        .content-area { 
            padding: 2rem; 
            width: 100%; 
            max-width: 1540px; 
            margin: 0 auto;
        }

        /* Alertas de Éxito / Error */
        .alert-success { 
            background: rgba(16, 185, 129, 0.08); 
            border: 1px solid rgba(16, 185, 129, 0.25); 
            color: #059669; 
            padding: 0.9rem 1.25rem; 
            border-radius: 8px; 
            margin-bottom: 1.5rem; 
            display: flex; 
            align-items: center; 
            gap: 0.65rem; 
            font-size: 0.88rem; 
            font-weight: 600;
        }

        /* Tarjetas Base */
        .card { 
            background: var(--admin-card); 
            border-radius: 12px; 
            border: 1px solid var(--admin-border); 
            padding: 1.75rem; 
            margin-bottom: 1.5rem; 
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.02); 
        }

        .card-header { 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            margin-bottom: 1.35rem; 
        }

        .card-title { 
            font-family: 'Outfit', sans-serif; 
            font-size: 1.15rem; 
            font-weight: 800; 
            color: var(--admin-dark);
            letter-spacing: -0.01em;
            display: flex;
            align-items: center;
            gap: 0.55rem;
        }

        .card-title i {
            color: var(--admin-blue);
        }

        /* Botones Base */
        .btn { 
            display: inline-flex; 
            align-items: center; 
            justify-content: center; 
            gap: 0.45rem; 
            min-height: 40px; 
            padding: 0.55rem 1.15rem; 
            border-radius: 8px; 
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 0.84rem; 
            font-weight: 700; 
            text-decoration: none; 
            cursor: pointer; 
            border: 1px solid transparent; 
            transition: all 0.18s ease; 
        }

        .btn-primary { 
            background: var(--admin-blue); 
            color: #FFFFFF; 
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);
        }
        .btn-primary:hover { 
            background: var(--admin-blue-light); 
            transform: translateY(-1px); 
            box-shadow: 0 6px 18px rgba(37, 99, 235, 0.35);
        }

        .btn-secondary { 
            background: var(--admin-hover); 
            color: var(--admin-text); 
            border-color: var(--admin-border); 
        }
        .btn-secondary:hover { 
            background: var(--admin-border); 
        }

        .btn-danger { 
            background: #EF4444; 
            color: #FFFFFF; 
        }
        .btn-danger:hover { 
            background: #DC2626; 
        }

        .btn-sm { 
            min-height: 34px; 
            padding: 0.35rem 0.75rem; 
            font-size: 0.78rem; 
        }

        /* Tablas */
        .table-responsive { 
            overflow-x: auto; 
            border: 1px solid var(--admin-border); 
            border-radius: 8px; 
            background: var(--admin-card);
        }

        table { 
            width: 100%; 
            border-collapse: collapse; 
            text-align: left; 
            font-size: 0.85rem; 
        }

        th { 
            padding: 0.85rem 1rem; 
            background: var(--admin-hover); 
            color: var(--admin-muted); 
            font-weight: 700; 
            border-bottom: 1px solid var(--admin-border); 
            text-transform: uppercase; 
            font-size: 0.7rem; 
            letter-spacing: 0.06em; 
        }

        td { 
            padding: 0.95rem 1rem; 
            border-bottom: 1px solid var(--admin-border); 
            vertical-align: middle; 
            color: var(--admin-text);
        }

        tbody tr:last-child td { border-bottom: none; }
        tbody tr:hover { background: rgba(37, 99, 235, 0.02); }

        .badge { 
            display: inline-flex; 
            align-items: center; 
            border-radius: 999px; 
            padding: 0.28rem 0.65rem; 
            font-size: 0.72rem; 
            font-weight: 700; 
            gap: 0.35rem;
        }

        .badge-success { background: rgba(16, 185, 129, 0.1); color: #059669; border: 1px solid rgba(16, 185, 129, 0.25); }
        .badge-warning { background: rgba(245, 158, 11, 0.1); color: #B45309; border: 1px solid rgba(245, 158, 11, 0.25); }
        .badge-blue { background: rgba(37, 99, 235, 0.1); color: #1D4ED8; border: 1px solid rgba(37, 99, 235, 0.25); }

        /* Responsividad Mobile */
        @media (max-width: 900px) {
            body { display: block; padding-bottom: 68px; }
            .sidebar { 
                width: 100%; 
                position: fixed; 
                left: 0; 
                right: 0; 
                bottom: 0; 
                z-index: 50; 
                height: 68px; 
                border-top: 1px solid var(--admin-sidebar-border);
                border-right: none;
            }
            .sidebar-brand-wrapper, .sidebar-telemetry-widget, .sidebar-footer, .sidebar-group-label { display: none; }
            .sidebar-nav-container { padding: 4px; overflow: visible; }
            .sidebar-menu-list { display: grid; grid-template-columns: repeat(5, 1fr); height: 60px; gap: 2px; }
            .sidebar-menu-list a { height: 60px; min-height: 60px; padding: 4px 2px; border-radius: 6px; flex-direction: column; justify-content: center; gap: 4px; font-size: 0.62rem; text-align: center; }
            .sidebar-menu-list a i { font-size: 1rem; width: auto; }
            .topbar { height: 64px; padding: 0 1rem; }
            .topbar-breadcrumb, .telemetry-chip { display: none; }
            .topbar-title-text { font-size: 1rem; }
            .admin-profile-pill span, .admin-profile-pill .gear-icon { display: none; }
            .content-area { padding: 1.25rem 1rem; }
        }
    </style>
    @yield('styles')
</head>
<body>
    <!-- Sidebar de Telecomunicaciones & Seguridad -->
    <aside class="sidebar" aria-label="Navegación del Panel de Control">
        <div class="sidebar-brand-wrapper">
            <img src="{{ asset('images/logo-emblem.png') }}" alt="Logo Oficial Electrónica Digital MX" class="sidebar-brand-img">
            <div class="brand-text">
                <h2>Electrónica Digital <span>MX</span></h2>
                <p>Consola de Control</p>
            </div>
        </div>

        <div class="sidebar-telemetry-widget">
            <span class="telemetry-dot"></span>
            <div class="telemetry-text">
                <span class="telemetry-node">Nodo Toluca</span>
                <span class="telemetry-state">Servicio Activo</span>
            </div>
        </div>

        <div class="sidebar-nav-container">
            <div>
                <div class="sidebar-group-label">Gestión Operativa</div>
                <ul class="sidebar-menu-list">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="fa-solid fa-chart-line"></i> Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.kits.index') }}" class="{{ request()->routeIs('admin.kits.*') ? 'active' : '' }}">
                            <i class="fa-solid fa-boxes-stacked"></i> Kits de Seguridad
                        </a>
                    </li>
                </ul>
            </div>

            <div>
                <div class="sidebar-group-label">Configuración & Docs</div>
                <ul class="sidebar-menu-list">
                    <li>
                        <a href="{{ route('admin.profile.edit') }}" class="{{ request()->routeIs('admin.profile.*') ? 'active' : '' }}">
                            <i class="fa-solid fa-user-shield"></i> Modificar Datos
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.docs') }}" class="{{ request()->routeIs('admin.docs') ? 'active' : '' }}">
                            <i class="fa-solid fa-book-bookmark"></i> Documentación
                        </a>
                    </li>
                </ul>
            </div>

            <div>
                <div class="sidebar-group-label">Enlaces Directos</div>
                <ul class="sidebar-menu-list">
                    <li>
                        <a href="{{ route('home') }}" target="_blank">
                            <i class="fa-solid fa-arrow-up-right-from-square"></i> Ver Sitio Web
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="sidebar-footer">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-logout">
                    <i class="fa-solid fa-power-off"></i> Cerrar Sesión Segura
                </button>
            </form>
        </div>
    </aside>

    <!-- Contenedor Principal -->
    <div class="main-wrapper">
        <header class="topbar">
            <div class="topbar-left">
                <div>
                    <div class="topbar-breadcrumb">
                        <a href="{{ route('admin.dashboard') }}">Consola</a>
                        <span class="topbar-breadcrumb-sep">/</span>
                        <span>@yield('page-title', 'Inicio')</span>
                    </div>
                    <div class="topbar-title-text">@yield('page-title', 'Electrónica Digital MX')</div>
                </div>
            </div>

            <div class="topbar-right">
                <div class="telemetry-chip">
                    <span class="status-dot"></span>
                    <span>MySQL 8.x</span>
                </div>
                <div class="telemetry-chip">
                    <i class="fa-solid fa-shield-halved"></i>
                    <span>SSL Activo</span>
                </div>

                <button type="button" class="theme-toggle-btn" id="adminThemeToggleBtn" aria-label="Cambiar tema" title="Alternar tema Claro/Oscuro">
                    <i class="fa-solid fa-circle-half-stroke"></i>
                </button>

                <a href="{{ route('admin.profile.edit') }}" class="admin-profile-pill" title="Gestionar mi perfil de usuario">
                    <div class="admin-profile-avatar"><i class="fa-solid fa-user"></i></div>
                    <span>{{ Auth::user()->name ?? 'Administrador' }}</span>
                    <i class="fa-solid fa-gear gear-icon"></i>
                </a>
            </div>
        </header>

        <main class="content-area">
            @if(session('success'))
                <div class="alert-success" role="alert">
                    <i class="fa-solid fa-circle-check"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <script>
        // Protección contra caché de retroceso (Back Button) tras cerrar sesión
        window.addEventListener('pageshow', function (event) {
            if (event.persisted || (window.performance && window.performance.navigation && window.performance.navigation.type === 2)) {
                window.location.reload();
            }
        });

        // Alternador de tema en panel administrativo
        (function () {
            const root = document.documentElement;
            const toggle = document.getElementById('adminThemeToggleBtn');
            const saved = localStorage.getItem('edmx-admin-theme');

            if (saved === 'light' || saved === 'dark') {
                root.dataset.adminTheme = saved;
            }

            if (toggle) {
                toggle.addEventListener('click', function () {
                    const systemDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                    const active = root.dataset.adminTheme || (systemDark ? 'dark' : 'light');
                    const next = active === 'dark' ? 'light' : 'dark';
                    root.dataset.adminTheme = next;
                    localStorage.setItem('edmx-admin-theme', next);
                });
            }
        })();
    </script>
    @yield('scripts')
</body>
</html>
