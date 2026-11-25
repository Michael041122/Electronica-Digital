<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso al Panel de Control | Electrónica Digital MX</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Outfit:wght@600;700;800&display=swap" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --login-bg: #090E1A;
            --login-panel: #0F172A;
            --login-surface: #1E293B;
            --login-border: #334155;
            --login-text: #F8FAFC;
            --login-muted: #94A3B8;
            --login-accent: #2563EB;
            --login-accent-hover: #1D4ED8;
            --login-emerald: #10B981;
            --login-input-bg: #0B132B;
        }

        html[data-theme='light'] {
            --login-bg: #F1F5F9;
            --login-panel: #FFFFFF;
            --login-surface: #F8FAFC;
            --login-border: #E2E8F0;
            --login-text: #0F172A;
            --login-muted: #64748B;
            --login-accent: #1D4ED8;
            --login-accent-hover: #1E40AF;
            --login-emerald: #059669;
            --login-input-bg: #FFFFFF;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            min-height: 100vh;
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--login-bg);
            color: var(--login-text);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            position: relative;
            overflow-x: hidden;
            transition: background 0.3s ease, color 0.3s ease;
        }

        /* Fondo de Cuadrícula Sutil de Telecomunicaciones */
        body::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: 
                radial-gradient(circle at 15% 20%, rgba(37, 99, 235, 0.12) 0%, transparent 40%),
                radial-gradient(circle at 85% 80%, rgba(16, 185, 129, 0.08) 0%, transparent 40%),
                linear-gradient(to right, rgba(51, 65, 85, 0.08) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(51, 65, 85, 0.08) 1px, transparent 1px);
            background-size: 100% 100%, 100% 100%, 40px 40px, 40px 40px;
            pointer-events: none;
        }

        /* Contenedor Principal (Shell) */
        .login-shell {
            width: 100%;
            max-width: 1040px;
            min-height: 640px;
            background: var(--login-panel);
            border: 1px solid var(--login-border);
            border-radius: 20px;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.35);
            display: grid;
            grid-template-columns: 46% 54%;
            overflow: hidden;
            position: relative;
            z-index: 10;
        }

        /* Panel Izquierdo: Marca & Telemetría Operativa */
        .login-aside {
            background: linear-gradient(145deg, #0A1124 0%, #070B16 100%);
            border-right: 1px solid var(--login-border);
            padding: 3rem 2.5rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
            color: #FFFFFF;
        }

        .login-aside::before {
            content: '';
            position: absolute;
            top: -40%;
            right: -40%;
            width: 320px;
            height: 320px;
            background: radial-gradient(circle, rgba(37, 99, 235, 0.25) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        .aside-header {
            display: flex;
            align-items: center;
            gap: 0.9rem;
            position: relative;
            z-index: 2;
        }

        .aside-brand-img {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: #FFFFFF;
            padding: 3px;
            object-fit: cover;
            border: 2px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.3);
        }

        .aside-brand-title {
            font-family: 'Outfit', sans-serif;
            font-size: 1.15rem;
            font-weight: 800;
            color: #FFFFFF;
            letter-spacing: -0.01em;
            line-height: 1.2;
        }

        .aside-brand-title span {
            color: #38BDF8;
            font-size: 0.78rem;
            background: rgba(56, 189, 248, 0.15);
            padding: 2px 6px;
            border-radius: 4px;
            margin-left: 4px;
        }

        .aside-brand-sub {
            font-size: 0.72rem;
            color: #94A3B8;
            font-weight: 600;
        }

        /* Cuerpo del Aside */
        .aside-body {
            position: relative;
            z-index: 2;
            margin: 2rem 0;
        }

        .telemetry-pill {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(16, 185, 129, 0.12);
            border: 1px solid rgba(16, 185, 129, 0.3);
            color: #34D399;
            font-size: 0.74rem;
            font-weight: 700;
            padding: 0.35rem 0.8rem;
            border-radius: 999px;
            margin-bottom: 1.25rem;
            letter-spacing: 0.04em;
        }

        .pulse-dot {
            width: 7px;
            height: 7px;
            background: #10B981;
            border-radius: 50%;
            box-shadow: 0 0 8px #10B981;
            animation: pulseGlow 2s infinite;
        }

        @keyframes pulseGlow {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.4; transform: scale(0.85); }
        }

        .aside-headline {
            font-family: 'Outfit', sans-serif;
            font-size: 2rem;
            font-weight: 800;
            line-height: 1.15;
            color: #FFFFFF;
            letter-spacing: -0.03em;
            margin-bottom: 1rem;
        }

        .aside-headline strong {
            color: #60A5FA;
        }

        .aside-desc {
            font-size: 0.88rem;
            line-height: 1.65;
            color: #94A3B8;
            margin-bottom: 1.75rem;
        }

        /* Especificaciones Técnicas del Nodo */
        .telecom-specs-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 0.65rem;
        }

        .spec-item {
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 8px;
            padding: 0.65rem 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .spec-item i {
            color: #38BDF8;
            font-size: 0.95rem;
            width: 18px;
            text-align: center;
        }

        .spec-item-text {
            display: flex;
            flex-direction: column;
        }

        .spec-item-label {
            font-size: 0.7rem;
            font-weight: 700;
            color: #94A3B8;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .spec-item-value {
            font-size: 0.82rem;
            font-weight: 600;
            color: #F8FAFC;
        }

        .aside-footer {
            position: relative;
            z-index: 2;
            font-size: 0.74rem;
            color: #64748B;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            padding-top: 1rem;
        }

        /* Panel Derecho: Formulario de Autenticación */
        .login-card {
            padding: 3.5rem clamp(2rem, 5vw, 3.5rem);
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            background: var(--login-panel);
        }

        /* Botón de Tema */
        .theme-toggle-btn {
            position: absolute;
            top: 2rem;
            right: 2rem;
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: var(--login-surface);
            border: 1px solid var(--login-border);
            color: var(--login-text);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.95rem;
            transition: all 0.2s ease;
        }

        .theme-toggle-btn:hover {
            border-color: var(--login-accent);
            color: var(--login-accent);
            transform: rotate(15deg);
        }

        .login-card-header {
            margin-bottom: 2rem;
        }

        .login-card-title {
            font-family: 'Outfit', sans-serif;
            font-size: 1.85rem;
            font-weight: 800;
            color: var(--login-text);
            letter-spacing: -0.03em;
            margin-bottom: 0.4rem;
        }

        .login-card-subtitle {
            font-size: 0.88rem;
            color: var(--login-muted);
            line-height: 1.5;
        }

        /* Alertas de Error y Éxito */
        .alert-box {
            padding: 0.85rem 1rem;
            border-radius: 8px;
            font-size: 0.84rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.65rem;
            line-height: 1.4;
        }

        .alert-box.error {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.25);
            color: #EF4444;
        }

        .alert-box.success {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.25);
            color: var(--login-emerald);
        }

        /* Formulario y Campos */
        .form-group {
            margin-bottom: 1.35rem;
        }

        .form-label {
            display: block;
            font-size: 0.82rem;
            font-weight: 700;
            color: var(--login-text);
            margin-bottom: 0.45rem;
            letter-spacing: 0.01em;
        }

        .input-box {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-icon-prefix {
            position: absolute;
            left: 14px;
            color: var(--login-muted);
            font-size: 0.95rem;
            pointer-events: none;
            transition: color 0.2s ease;
        }

        .form-control {
            width: 100%;
            height: 48px;
            padding: 0 42px 0 42px;
            background: var(--login-input-bg);
            border: 1.5px solid var(--login-border);
            border-radius: 8px;
            color: var(--login-text);
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 0.92rem;
            outline: none;
            transition: all 0.2s ease;
        }

        .form-control::placeholder {
            color: var(--login-muted);
            font-size: 0.88rem;
        }

        .form-control:focus {
            border-color: var(--login-accent);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
        }

        .form-control:focus + .input-icon-prefix,
        .input-box:focus-within .input-icon-prefix {
            color: var(--login-accent);
        }

        .toggle-password-btn {
            position: absolute;
            right: 12px;
            background: transparent;
            border: none;
            color: var(--login-muted);
            cursor: pointer;
            padding: 6px;
            font-size: 0.9rem;
            transition: color 0.15s ease;
        }

        .toggle-password-btn:hover {
            color: var(--login-text);
        }

        /* Opciones de Formulario (Recordar sesión) */
        .form-extra-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.75rem;
            font-size: 0.82rem;
        }

        .remember-checkbox-label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
            color: var(--login-muted);
            user-select: none;
        }

        .remember-checkbox-label input[type="checkbox"] {
            width: 16px;
            height: 16px;
            accent-color: var(--login-accent);
            cursor: pointer;
        }

        /* Botón de Envío Principal */
        .btn-submit-login {
            width: 100%;
            height: 50px;
            background: var(--login-accent);
            border: none;
            border-radius: 8px;
            color: #FFFFFF;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 0.95rem;
            font-weight: 700;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.6rem;
            box-shadow: 0 4px 14px rgba(37, 99, 235, 0.25);
            transition: all 0.2s ease;
        }

        .btn-submit-login:hover {
            background: var(--login-accent-hover);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(37, 99, 235, 0.35);
        }

        .btn-submit-login:active {
            transform: translateY(0);
        }

        /* Enlace de Retorno */
        .back-to-site-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.45rem;
            margin-top: 1.5rem;
            color: var(--login-muted);
            text-decoration: none;
            font-size: 0.82rem;
            font-weight: 600;
            transition: color 0.15s ease;
            text-align: center;
        }

        .back-to-site-link:hover {
            color: var(--login-accent);
        }

        /* Responsividad Mobile */
        @media (max-width: 860px) {
            .login-shell {
                grid-template-columns: 1fr;
                border-radius: 16px;
            }
            .login-aside {
                padding: 2rem 1.75rem;
                min-height: auto;
            }
            .aside-headline {
                font-size: 1.5rem;
            }
            .telecom-specs-grid {
                display: none;
            }
            .login-card {
                padding: 2.5rem 1.75rem;
            }
            .theme-toggle-btn {
                top: 1.25rem;
                right: 1.25rem;
            }
        }
    </style>
</head>
<body>

    <main class="login-shell" role="main">
        <!-- Panel Izquierdo: Identidad de Marca & Telemetría -->
        <section class="login-aside" aria-label="Información de Sistema">
            <header class="aside-header">
                <img src="{{ asset('images/logo-emblem.png') }}" alt="Logo Oficial Electrónica Digital MX" class="aside-brand-img">
                <div>
                    <div class="aside-brand-title">Electrónica Digital <span>MX</span></div>
                    <div class="aside-brand-sub">Seguridad & Telecomunicaciones</div>
                </div>
            </header>

            <div class="aside-body">
                <div class="telemetry-pill">
                    <span class="pulse-dot"></span>
                    <span>NODO TOLUCA • EN LÍNEA</span>
                </div>

                <h1 class="aside-headline">Consola de Control <strong>Operativo</strong>.</h1>
                <p class="aside-desc">
                    Plataforma centralizada para la administración de paquetes de videovigilancia CCTV, control de acceso, trazabilidad de cotizaciones y manuales de ingeniería.
                </p>

                <div class="telecom-specs-grid">
                    <div class="spec-item">
                        <i class="fa-solid fa-shield-halved"></i>
                        <div class="spec-item-text">
                            <span class="spec-item-label">Seguridad de Acceso</span>
                            <span class="spec-item-value">Protección de Sesión Anti-Caché</span>
                        </div>
                    </div>
                    <div class="spec-item">
                        <i class="fa-solid fa-server"></i>
                        <div class="spec-item-text">
                            <span class="spec-item-label">Infraestructura</span>
                            <span class="spec-item-value">MySQL 8.x • Laravel 11 • Docker</span>
                        </div>
                    </div>
                    <div class="spec-item">
                        <i class="fa-solid fa-satellite-dish"></i>
                        <div class="spec-item-text">
                            <span class="spec-item-label">Trazabilidad</span>
                            <span class="spec-item-value">Integración Directa a WhatsApp Business</span>
                        </div>
                    </div>
                </div>
            </div>

            <footer class="aside-footer">
                Electrónica Digital MX • Av. Heriberto Enríquez 606, Toluca, Edo. Méx.
            </footer>
        </section>

        <!-- Panel Derecho: Formulario de Autenticación -->
        <section class="login-card" aria-label="Formulario de Inicio de Sesión">
            <button type="button" class="theme-toggle-btn" id="themeToggleBtn" aria-label="Alternar tema de color" title="Alternar tema Claro/Oscuro">
                <i class="fa-solid fa-circle-half-stroke"></i>
            </button>

            <div class="login-card-header">
                <h2 class="login-card-title">Acceso al Panel</h2>
                <p class="login-card-subtitle">Ingresa tus credenciales autorizadas para gestionar el sistema.</p>
            </div>

            @if($errors->any())
                <div class="alert-box error" role="alert">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            @if(session('success'))
                <div class="alert-box success" role="status">
                    <i class="fa-solid fa-circle-check"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST" autocomplete="on">
                @csrf
                <div class="form-group">
                    <label for="email" class="form-label">Correo Electrónico Institucional</label>
                    <div class="input-box">
                        <i class="fa-solid fa-envelope input-icon-prefix"></i>
                        <input type="email" id="email" name="email" class="form-control" placeholder="admin@electronicadigital.mx" value="{{ old('email') }}" required autofocus autocomplete="email">
                    </div>
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Contraseña de Acceso</label>
                    <div class="input-box">
                        <i class="fa-solid fa-key input-icon-prefix"></i>
                        <input type="password" id="password" name="password" class="form-control" placeholder="••••••••••••" required autocomplete="current-password">
                        <button type="button" class="toggle-password-btn" id="togglePasswordBtn" aria-label="Mostrar u ocultar contraseña">
                            <i class="fa-solid fa-eye" id="togglePasswordIcon"></i>
                        </button>
                    </div>
                </div>

                <div class="form-extra-row">
                    <label class="remember-checkbox-label">
                        <input type="checkbox" name="remember" id="remember">
                        <span>Recordar sesión</span>
                    </label>
                </div>

                <button type="submit" class="btn-submit-login">
                    <i class="fa-solid fa-arrow-right-to-bracket"></i>
                    <span>Ingresar al Sistema</span>
                </button>
            </form>

            <a href="{{ route('home') }}" class="back-to-site-link">
                <i class="fa-solid fa-arrow-left"></i>
                <span>Volver al Portal Público</span>
            </a>
        </section>
    </main>

    <script>
        // Alternador de Tema Claro / Oscuro con Persistencia en LocalStorage
        (function () {
            const root = document.documentElement;
            const toggleBtn = document.getElementById('themeToggleBtn');
            const savedTheme = localStorage.getItem('edmx-theme');

            if (savedTheme === 'light' || savedTheme === 'dark') {
                root.dataset.theme = savedTheme;
            }

            if (toggleBtn) {
                toggleBtn.addEventListener('click', function () {
                    const current = root.dataset.theme;
                    const systemDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                    const activeTheme = current || (systemDark ? 'dark' : 'light');
                    const newTheme = activeTheme === 'dark' ? 'light' : 'dark';
                    root.dataset.theme = newTheme;
                    localStorage.setItem('edmx-theme', newTheme);
                });
            }

            // Visibilidad de Contraseña
            const togglePwBtn = document.getElementById('togglePasswordBtn');
            const pwInput = document.getElementById('password');
            const pwIcon = document.getElementById('togglePasswordIcon');

            if (togglePwBtn && pwInput && pwIcon) {
                togglePwBtn.addEventListener('click', function () {
                    const isPassword = pwInput.type === 'password';
                    pwInput.type = isPassword ? 'text' : 'password';
                    pwIcon.className = isPassword ? 'fa-solid fa-eye-slash' : 'fa-solid fa-eye';
                });
            }
        })();
    </script>
</body>
</html>
