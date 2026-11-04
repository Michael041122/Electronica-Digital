<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panel de Administración | Electrónica Digital MX')</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Outfit:wght@600;700&display=swap" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --admin-dark: #0A111F;
            --admin-sidebar: #0F1A2E;
            --admin-blue: #154EE7;
            --admin-blue-light: #2563EB;
            --admin-bg: #F1F5F9;
            --admin-card: #FFFFFF;
            --admin-text: #1E293B;
            --admin-muted: #64748B;
            --admin-border: #E2E8F0;
            --admin-success: #10B981;
            --admin-warning: #F59E0B;
        }
        * { margin:0; padding:0; box-sizing:border-box; font-family:'Plus Jakarta Sans', sans-serif; }
        body { background-color: var(--admin-bg); color: var(--admin-text); display:flex; min-height:100vh; }
        
        /* Sidebar */
        .sidebar { width: 260px; background-color: var(--admin-sidebar); color: #fff; display: flex; flex-direction: column; flex-shrink: 0; }
        .sidebar-brand { padding: 1.5rem; border-bottom: 1px solid rgba(255,255,255,0.08); display: flex; align-items: center; gap: 0.8rem; }
        .brand-icon { width: 38px; height: 38px; border-radius: 8px; background: var(--admin-blue); display: flex; align-items: center; justify-content: center; font-size: 1.1rem; }
        .brand-text h2 { font-size: 1.1rem; font-family: 'Outfit', sans-serif; }
        .brand-text p { font-size: 0.7rem; color: #94A3B8; }
        
        .sidebar-menu { list-style: none; padding: 1.5rem 1rem; flex-grow: 1; }
        .sidebar-menu li { margin-bottom: 0.4rem; }
        .sidebar-menu a { display: flex; align-items: center; gap: 0.8rem; padding: 0.75rem 1rem; color: #94A3B8; text-decoration: none; border-radius: 8px; font-size: 0.9rem; font-weight: 500; transition: all 0.2s; }
        .sidebar-menu a:hover, .sidebar-menu a.active { background-color: rgba(21, 78, 231, 0.15); color: #fff; }
        .sidebar-menu a.active { background-color: var(--admin-blue); }
        .sidebar-menu a i { width: 20px; font-size: 1rem; }
        
        .sidebar-footer { padding: 1rem 1.5rem; border-top: 1px solid rgba(255,255,255,0.08); }
        .sidebar-footer a { color: #94A3B8; text-decoration: none; font-size: 0.85rem; display: flex; align-items: center; gap: 0.5rem; }
        .sidebar-footer a:hover { color: #fff; }
        
        /* Main Layout */
        .main-wrapper { flex-grow: 1; display: flex; flex-direction: column; overflow-x: hidden; }
        .topbar { height: 65px; background: var(--admin-card); border-bottom: 1px solid var(--admin-border); display: flex; align-items: center; justify-content: space-between; padding: 0 2rem; }
        .topbar-title { font-size: 1.15rem; font-weight: 700; color: var(--admin-dark); }
        .admin-profile { display: flex; align-items: center; gap: 0.8rem; font-size: 0.88rem; font-weight: 600; }
        .admin-avatar { width: 36px; height: 36px; border-radius: 50%; background: var(--admin-blue); color: #fff; display: flex; align-items: center; justify-content: center; font-size: 0.9rem; }
        
        .content-area { padding: 2rem; }
        
        /* Alerts */
        .alert-success { background: #ECFDF5; border: 1px solid #A7F3D0; color: #065F46; padding: 0.9rem 1.2rem; border-radius: 8px; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.6rem; font-size: 0.9rem; }
        
        /* Tables & Cards */
        .card { background: var(--admin-card); border-radius: 12px; border: 1px solid var(--admin-border); padding: 1.5rem; margin-bottom: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.05); }
        .card-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.2rem; }
        .card-title { font-size: 1.1rem; font-weight: 700; }
        
        .btn { display: inline-flex; align-items: center; gap: 0.4rem; padding: 0.55rem 1.1rem; border-radius: 6px; font-size: 0.88rem; font-weight: 600; text-decoration: none; cursor: pointer; border: none; transition: 0.2s; }
        .btn-primary { background: var(--admin-blue); color: #fff; }
        .btn-primary:hover { background: var(--admin-blue-light); }
        .btn-secondary { background: #E2E8F0; color: var(--admin-text); }
        .btn-secondary:hover { background: #CBD5E1; }
        .btn-danger { background: #EF4444; color: #fff; }
        .btn-danger:hover { background: #DC2626; }
        .btn-sm { padding: 0.35rem 0.75rem; font-size: 0.8rem; }
        
        .table-responsive { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; text-align: left; font-size: 0.88rem; }
        th { padding: 0.75rem 1rem; background: #F8FAFC; color: var(--admin-muted); font-weight: 600; border-bottom: 1px solid var(--admin-border); text-transform: uppercase; font-size: 0.75rem; letter-spacing: 0.5px; }
        td { padding: 0.9rem 1rem; border-bottom: 1px solid var(--admin-border); vertical-align: middle; }
        tr:hover { background-color: #F8FAFC; }
        
        .badge { display: inline-block; padding: 0.25rem 0.6rem; border-radius: 20px; font-size: 0.75rem; font-weight: 600; }
        .badge-success { background: #D1FAE5; color: #065F46; }
        .badge-warning { background: #FEF3C7; color: #92400E; }
        .badge-blue { background: #DBEAFE; color: #1E40AF; }
    </style>
    @yield('styles')
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-brand">
            <div class="brand-icon"><i class="fa-solid fa-shield-halved"></i></div>
            <div class="brand-text">
                <h2>EDMX Admin</h2>
                <p>Gestión y Control</p>
            </div>
        </div>
        <ul class="sidebar-menu">
            <li><a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><i class="fa-solid fa-chart-line"></i> Dashboard</a></li>
            <li><a href="{{ route('admin.kits.index') }}" class="{{ request()->routeIs('admin.kits.*') ? 'active' : '' }}"><i class="fa-solid fa-box-archive"></i> Kits de Seguridad</a></li>
            <li><a href="{{ route('home') }}" target="_blank"><i class="fa-solid fa-arrow-up-right-from-square"></i> Ver Sitio Web</a></li>
        </ul>
        <div class="sidebar-footer">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" style="background:none; border:none; color:#94A3B8; font-size:0.85rem; cursor:pointer; display:flex; align-items:center; gap:0.5rem; width:100%;">
                    <i class="fa-solid fa-power-off"></i> Cerrar Sesión
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="main-wrapper">
        <header class="topbar">
            <div class="topbar-title">@yield('page-title', 'Electrónica Digital MX')</div>
            <div class="admin-profile">
                <div class="admin-avatar"><i class="fa-solid fa-user"></i></div>
                <span>Ing. Josué Verónica (Gerente)</span>
            </div>
        </header>

        <main class="content-area">
            @if(session('success'))
                <div class="alert-success">
                    <i class="fa-solid fa-circle-check"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @yield('content')
        </main>
    </div>
    @yield('scripts')
</body>
</html>
