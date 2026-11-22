<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Electrónica Digital MX | Seguridad Electrónica y Telecomunicaciones')</title>
    <meta name="description" content="Instalación y venta de sistemas de seguridad, cámaras CCTV, control de acceso, alarmas y redes en Toluca y Estado de México. 15 años de experiencia.">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicon.png') }}">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Outfit:wght@500;600;700;800&display=swap" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    @yield('styles')
</head>
<body>

    <!-- Header Navigation -->
    <header class="navbar" id="navbar">
        <div class="container navbar-container">
            <a href="{{ url('/') }}" class="brand-logo" aria-label="Electrónica Digital MX Inicio">
                <img src="{{ asset('images/logo-emblem.png') }}" alt="Logo Electrónica Digital MX" class="brand-logo-img">
                <div class="logo-text">
                    <span class="brand-name">Electrónica Digital <span class="brand-badge">MX</span></span>
                    <span class="brand-subtext">Seguridad & Telecomunicaciones</span>
                </div>
            </a>

            <nav class="nav-menu" id="navMenu">
                <a href="#cotizador" class="nav-link">Productos</a>
                
                <!-- Dropdown de Servicios -->
                <div class="nav-dropdown">
                    <a href="#servicios" class="nav-link dropdown-toggle">
                        Servicios <i class="fa-solid fa-chevron-down"></i>
                    </a>
                    <div class="dropdown-menu">
                        <a href="#cotizador" class="dropdown-item" onclick="filterCategory('cctv')">Cámaras de Seguridad</a>
                        <a href="#cotizador" class="dropdown-item" onclick="filterCategory('dvr')">DVR y NVR</a>
                        <a href="#cotizador" class="dropdown-item" onclick="filterCategory('acceso')">Control de Acceso</a>
                        <a href="#cotizador" class="dropdown-item" onclick="filterCategory('videoportero')">Video Porteros</a>
                        <a href="#cotizador" class="dropdown-item" onclick="filterCategory('alarmas')">Sistemas de Alarma</a>
                        <a href="#cotizador" class="dropdown-item" onclick="filterCategory('redes')">Cableado Estructurado</a>
                        <a href="#cotizador" class="dropdown-item" onclick="filterCategory('voip')">VoIP y PBX</a>
                        <a href="#cotizador" class="dropdown-item" onclick="filterCategory('gps')">GPS y Rastreo Vehicular</a>
                        <a href="#cotizador" class="dropdown-item" onclick="filterCategory('solares')">Paneles Solares</a>
                        <a href="#cotizador" class="dropdown-item" onclick="filterCategory('led')">Iluminación LED</a>
                        <a href="#cotizador" class="dropdown-item" onclick="filterCategory('climas')">Aires Acondicionados</a>
                        <a href="#cotizador" class="dropdown-item" onclick="filterCategory('torniquetes')">Torniquetes</a>
                        <a href="#cotizador" class="dropdown-item" onclick="filterCategory('av')">Integración AV</a>
                        <a href="#servicios" class="dropdown-item" style="color: var(--brand-blue); font-weight: 700; border-top: 1px solid var(--border-color);"><i class="fa-solid fa-screwdriver-wrench"></i> Mantenimiento y Reparación</a>
                    </div>
                </div>

                <a href="#cotizador" class="nav-link">Cotizar</a>
                <a href="#nosotros" class="nav-link">Nosotros</a>
                <a href="#faq" class="nav-link">Preguntas Frecuentes</a>
                <a href="#contacto" class="nav-link">Contacto</a>
            </nav>

            <div class="nav-actions">
                <a href="https://wa.me/527227060068?text=Hola,%20me%20gustaría%20solicitar%20una%20cotización" target="_blank" class="btn btn-whatsapp-header">
                    <i class="fa-brands fa-whatsapp"></i> <span>WhatsApp</span>
                </a>
                <button class="mobile-toggle" id="mobileToggle" aria-label="Abrir menú">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer-section" id="contacto">
        <div class="container footer-grid">
            <div class="footer-col brand-col">
                <div class="footer-logo-wrapper">
                    <img src="{{ asset('images/logo-emblem.png') }}" alt="Logo Electrónica Digital MX" class="footer-brand-img">
                    <div class="footer-brand-title-wrap">
                        <h3>Electrónica Digital <span class="brand-badge">MX</span></h3>
                        <span class="footer-brand-subtitle">Seguridad & Telecomunicaciones</span>
                    </div>
                </div>
                <p>Empresa mexicana establecida en Toluca especializada en instalación de cámaras de seguridad CCTV, videoporteros, controles de acceso y telecomunicaciones.</p>
                <div class="footer-contacts font-size-sm">
                    <p><i class="fa-solid fa-location-dot"></i> Heriberto Enríquez No. 606, Col. Santa María de las Rosas, Toluca, Edo. Méx.</p>
                    <p><i class="fa-solid fa-phone"></i> 722 706 0068 | 722 396 7562</p>
                    <p><i class="fa-solid fa-envelope"></i> electronica.digital.toluca@gmail.com</p>
                    <p><i class="fa-solid fa-clock"></i> Lunes a Sábado: 7:00 AM – 4:00 PM</p>
                </div>
                <div class="footer-social-links">
                    <a href="https://www.facebook.com" target="_blank" class="footer-social-btn fb" title="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="https://www.instagram.com" target="_blank" class="footer-social-btn ig" title="Instagram"><i class="fa-brands fa-instagram"></i></a>
                    <a href="https://wa.me/527227060068" target="_blank" class="footer-social-btn wa" title="WhatsApp"><i class="fa-brands fa-whatsapp"></i></a>
                </div>
            </div>

            <div class="footer-col links-col">
                <h4>Servicios</h4>
                <ul>
                    <li><a href="#cotizador">Cámaras CCTV</a></li>
                    <li><a href="#cotizador">Control de Acceso</a></li>
                    <li><a href="#cotizador">Video Porteros IP</a></li>
                    <li><a href="#cotizador">Sistemas de Alarma</a></li>
                    <li><a href="#cotizador">Cableado Estructurado</a></li>
                    <li><a href="#cotizador">GPS Vehicular</a></li>
                </ul>
            </div>

            <div class="footer-col map-col">
                <h4>Nuestra Ubicación en Toluca</h4>
                <div class="map-box">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3765.817457788414!2d-99.6450!3d19.2780!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85cd89be1f600000%3A0x1000000000000000!2sHeriberto%20Enr%C3%ADquez%20606%2C%20Santa%20Mar%C3%ADa%20de%20las%20Rosas%2C%2050140%20Toluca%20de%20Lerdo%2C%20M%C3%A9x.!5e0!3m2!1ses-419!2smx!4v1700000000000!5m2!1es-419!2smx" 
                        width="100%" 
                        height="180" 
                        style="border:0; border-radius: 8px;" 
                        allowfullscreen="" 
                        loading="lazy">
                    </iframe>
                </div>
            </div>
        </div>

        <div class="footer-bottom text-center">
            <div class="container">
                <p>&copy; 2026 Electrónica Digital MX. Todos los derechos reservados. Proyecto de Residencia Profesional - ITESFPM.</p>
            </div>
        </div>
    </footer>

    <!-- Grupo de Botones Flotantes de Redes Sociales -->
    <div class="floating-social-group">
        <a href="https://www.facebook.com" class="floating-social-btn floating-facebook" target="_blank" title="Síguenos en Facebook">
            <i class="fa-brands fa-facebook-f"></i>
        </a>
        <a href="https://www.instagram.com" class="floating-social-btn floating-instagram" target="_blank" title="Síguenos en Instagram">
            <i class="fa-brands fa-instagram"></i>
        </a>
        <a href="https://wa.me/527227060068?text=Hola,%20quisiera%20solicitar%20información%20sobre%20sus%20servicios" class="floating-social-btn floating-whatsapp" target="_blank" title="Cotizar por WhatsApp">
            <i class="fa-brands fa-whatsapp"></i>
        </a>
    </div>

    <script src="{{ asset('js/script.js') }}"></script>
    @yield('scripts')
</body>
</html>
