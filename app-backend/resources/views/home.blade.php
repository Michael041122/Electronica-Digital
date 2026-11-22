@extends('layouts.app')

@section('title', 'Electrónica Digital MX | Seguridad y Tecnología para tu Hogar y Empresa')

@section('content')
    <!-- HERO SECTION (Estilo VideoConfianza) -->
    <section class="hero-section">
        <div class="container hero-content text-center">
            <span class="hero-tagline">COBERTURA Y SERVICIO EN TOLUCA Y ESTADO DE MÉXICO</span>
            <h1 class="hero-main-title">Seguridad y Tecnología para tu Hogar y Empresa</h1>
            <p class="hero-subdescription">
                Instalamos y vendemos sistemas de cámaras, control de acceso, alarmas, redes y más. Técnicos certificados con más de 15 años de experiencia.
            </p>
            <div class="hero-cta-buttons">
                <a href="https://wa.me/527227060068?text=Hola,%20me%20interesa%20cotizar%20un%20sistema%20de%20seguridad%20para%20mi%20inmueble" target="_blank" class="btn btn-hero-whatsapp">
                    <i class="fa-brands fa-whatsapp"></i> Cotizar por WhatsApp
                </a>
                <a href="#cotizador" class="btn btn-hero-catalog">
                    Ver catálogo
                </a>
            </div>
        </div>
    </section>

    <!-- SECCIÓN "¿QUIÉNES SOMOS?" -->
    <section class="about-dark-section" id="nosotros">
        <div class="container about-dark-content">
            <span class="about-tag font-bold">¿QUIÉNES SOMOS?</span>
            <h2 class="about-dark-heading">No solo vendemos — <span>también instalamos</span></h2>
            <p class="about-dark-lead">
                <strong>Electrónica Digital MX</strong> es una empresa dedicada a brindar soluciones integrales de seguridad y tecnología. Desde hace 15 años hemos protegido hogares, negocios, escuelas y empresas en Toluca y todo el Estado de México.
            </p>
            <div class="experience-features-grid">
                <div class="exp-feature-box">
                    <i class="fa-solid fa-certificate"></i>
                    <h4>Técnicos Certificados</h4>
                    <p>Especialistas en configuración de CCTV, redes y control de acceso.</p>
                </div>
                <div class="exp-feature-box">
                    <i class="fa-solid fa-shield-halved"></i>
                    <h4>Garantía Directa</h4>
                    <p>Soporte técnico y garantía real en equipos e instalaciones.</p>
                </div>
                <div class="exp-feature-box">
                    <i class="fa-solid fa-location-dot"></i>
                    <h4>Atención Local</h4>
                    <p>Ubicados en Toluca con atención rápida en sitio.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- SECCIÓN MARCAS LÍDERES QUE INSTALAMOS (PRUEBA SOCIAL Y CONFIANZA) -->
    <section class="brands-section">
        <div class="container text-center">
            <span class="brands-subtitle">EQUIPAMIENTO PROFESIONAL</span>
            <h3 class="brands-title">Marcas Líderes Certificadas con las que Trabajamos</h3>
            <div class="brands-grid">
                <div class="brand-item">
                    <span class="brand-logo-text"><i class="fa-solid fa-video"></i> HIKVISION</span>
                    <small>CCTV & Analítica AI</small>
                </div>
                <div class="brand-item">
                    <span class="brand-logo-text"><i class="fa-solid fa-camera"></i> DAHUA</span>
                    <small>Tecnología IP & Térmica</small>
                </div>
                <div class="brand-item">
                    <span class="brand-logo-text"><i class="fa-solid fa-shield-halved"></i> EPCOM</span>
                    <small>Seguridad & Telecom</small>
                </div>
                <div class="brand-item">
                    <span class="brand-logo-text"><i class="fa-solid fa-eye"></i> HILOOK</span>
                    <small>Videovigilancia Confiable</small>
                </div>
                <div class="brand-item">
                    <span class="brand-logo-text"><i class="fa-solid fa-fingerprint"></i> ZKTECO</span>
                    <small>Biométricos & Acceso</small>
                </div>
                <div class="brand-item">
                    <span class="brand-logo-text"><i class="fa-solid fa-network-wired"></i> TP-LINK</span>
                    <small>Redes & Switches PoE</small>
                </div>
            </div>
        </div>
    </section>

    <!-- SECCIÓN PAQUETES POR SECTOR (Componentes Reutilizables de Bloque) -->
    <section class="section category-packages-section" id="servicios">
        <div class="container">
            <div class="section-title-wrapper text-center">
                <span class="sub-label">SOLUCIONES A TU MEDIDA</span>
                <h2>Paquetes de Instalación y Equipamiento</h2>
                <p>Selecciona tu paquete de interés y cotízalo directamente por WhatsApp</p>
            </div>

            <div class="sector-grid">
                <!-- Tarjeta 1: Residencial -->
                <div class="sector-card dark">
                    <div class="sector-card-header">
                        <div class="sector-icon"><i class="fa-solid fa-house-shield"></i></div>
                        <span class="sector-tag">SERVICIO RESIDENCIAL</span>
                        <h3>Cámaras para Hogar</h3>
                    </div>
                    <div class="sector-card-body">
                        <div class="package-line" onclick="sendWhatsAppQuote('Kit Básico - 2 Cámaras Hogar', 'Consultar', '2 Cámaras + DVR + Disco 1TB + Instalación')">
                            <div>
                                <strong>Básico — 2 cámaras</strong>
                                <small>Casas pequeñas · 1 zona crítica</small>
                            </div>
                            <i class="fa-solid fa-chevron-right"></i>
                        </div>
                        <div class="package-line" onclick="sendWhatsAppQuote('Kit Estándar - 4 Cámaras Hogar', 'Consultar', '4 Cámaras + DVR + Disco 1TB + Instalación')">
                            <div>
                                <strong>Estándar — 4 cámaras</strong>
                                <small>Casa media · cochera + perímetro</small>
                            </div>
                            <i class="fa-solid fa-chevron-right"></i>
                        </div>
                        <div class="package-line" onclick="sendWhatsAppQuote('Kit Premium - 8 Cámaras Hogar', 'Consultar', '8 Cámaras + DVR + Disco 2TB + Instalación')">
                            <div>
                                <strong>Premium — 8 cámaras</strong>
                                <small>Casa grande · cobertura total</small>
                            </div>
                            <i class="fa-solid fa-chevron-right"></i>
                        </div>
                        <div class="package-line" onclick="sendWhatsAppQuote('Kit Residencial Plus - 16 Cámaras', 'Consultar', '16 Cámaras + DVR/NVR + Instalación')">
                            <div>
                                <strong>Residencial Plus — 16+</strong>
                                <small>Residenciales · jardín y patios</small>
                            </div>
                            <i class="fa-solid fa-chevron-right"></i>
                        </div>
                    </div>
                    <div class="sector-card-footer">
                        <a href="#cotizador" class="btn btn-sector-dark">Ver detalles y paquetes <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>

                <!-- Tarjeta 2: Comercial -->
                <div class="sector-card blue">
                    <div class="sector-card-header">
                        <div class="sector-icon"><i class="fa-solid fa-store"></i></div>
                        <span class="sector-tag">SERVICIO COMERCIAL</span>
                        <h3>Cámaras para Comercio</h3>
                    </div>
                    <div class="sector-card-body">
                        <div class="package-line" onclick="sendWhatsAppQuote('Kit Tienda - 4 Cámaras', 'Consultar', '4 Cámaras Full HD + DVR + Monitoreo Celular')">
                            <div>
                                <strong>Tienda — 4 cámaras</strong>
                                <small>Punto de venta + entrada</small>
                            </div>
                            <i class="fa-solid fa-chevron-right"></i>
                        </div>
                        <div class="package-line" onclick="sendWhatsAppQuote('Kit Oficina - 6 Cámaras', 'Consultar', '6 Cámaras + DVR + Disco 2TB')">
                            <div>
                                <strong>Oficina — 6 cámaras</strong>
                                <small>Áreas comunes + accesos</small>
                            </div>
                            <i class="fa-solid fa-chevron-right"></i>
                        </div>
                        <div class="package-line" onclick="sendWhatsAppQuote('Kit Bodega - 8 Cámaras', 'Consultar', '8 Cámaras Exterior IP67 + DVR')">
                            <div>
                                <strong>Bodega — 8 cámaras</strong>
                                <small>Perímetro + interior</small>
                            </div>
                            <i class="fa-solid fa-chevron-right"></i>
                        </div>
                        <div class="package-line" onclick="sendWhatsAppQuote('Kit Cadena - 16+ Cámaras', 'Consultar', '16+ Cámaras IP + NVR Corporativo')">
                            <div>
                                <strong>Cadena — 16+ cámaras</strong>
                                <small>Multi-sucursal con monitoreo</small>
                            </div>
                            <i class="fa-solid fa-chevron-right"></i>
                        </div>
                    </div>
                    <div class="sector-card-footer">
                        <a href="#cotizador" class="btn btn-sector-light">Ver detalles y paquetes <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>

                <!-- Tarjeta 3: Industrial -->
                <div class="sector-card dark">
                    <div class="sector-card-header">
                        <div class="sector-icon"><i class="fa-solid fa-industry"></i></div>
                        <span class="sector-tag">SERVICIO INDUSTRIAL</span>
                        <h3>Sistemas Industriales</h3>
                    </div>
                    <div class="sector-card-body">
                        <div class="package-line" onclick="sendWhatsAppQuote('Nave Industrial - 8 Cámaras IP', 'Consultar', '8 Cámaras IP PoE + NVR Nivel Industrial')">
                            <div>
                                <strong>Nave — 8 cámaras</strong>
                                <small>Perímetro + área de carga</small>
                            </div>
                            <i class="fa-solid fa-chevron-right"></i>
                        </div>
                        <div class="package-line" onclick="sendWhatsAppQuote('Planta Industrial - 16 Cámaras IP', 'Consultar', '16 Cámaras IP 4K + NVR Industrial')">
                            <div>
                                <strong>Planta — 16 cámaras</strong>
                                <small>Producción + accesos + patios</small>
                            </div>
                            <i class="fa-solid fa-chevron-right"></i>
                        </div>
                        <div class="package-line" onclick="sendWhatsAppQuote('Sistema Térmico / PTZ Industrial', 'Consultar', 'Cámaras Térmicas PTZ 360 + Analítica')">
                            <div>
                                <strong>Industrial Premium</strong>
                                <small>Térmicas + PTZ + control acceso</small>
                            </div>
                            <i class="fa-solid fa-chevron-right"></i>
                        </div>
                        <div class="package-line" onclick="sendWhatsAppQuote('Centro de Monitoreo NVR', 'Consultar', 'Servidor NVR + Videowall + Monitoreo')">
                            <div>
                                <strong>Centro de monitoreo</strong>
                                <small>Cuarto de control y NVR de alta capacidad</small>
                            </div>
                            <i class="fa-solid fa-chevron-right"></i>
                        </div>
                    </div>
                    <div class="sector-card-footer">
                        <a href="#cotizador" class="btn btn-sector-dark">Ver detalles y paquetes <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>

                <!-- Tarjeta 4: Control de Acceso -->
                <div class="sector-card blue">
                    <div class="sector-card-header">
                        <div class="sector-icon"><i class="fa-solid fa-shield-cat"></i></div>
                        <span class="sector-tag">SERVICIO COMPLEMENTARIO</span>
                        <h3>Control de Acceso</h3>
                    </div>
                    <div class="sector-card-body">
                        <div class="package-line" onclick="sendWhatsAppQuote('Videoportero IP HD', 'Consultar', 'Frente de Calle IP + Monitor 7 pulg + App Celular')">
                            <div>
                                <strong>Videoportero IP</strong>
                                <small>Pantalla + audio bidireccional</small>
                            </div>
                            <i class="fa-solid fa-chevron-right"></i>
                        </div>
                        <div class="package-line" onclick="sendWhatsAppQuote('Cerradura Inteligente / Biométrica', 'Consultar', 'Huella Dactilar + Código + Tarjeta + App')">
                            <div>
                                <strong>Cerradura inteligente</strong>
                                <small>App + huella + código</small>
                            </div>
                            <i class="fa-solid fa-chevron-right"></i>
                        </div>
                        <div class="package-line" onclick="sendWhatsAppQuote('Biométrico de Asistencia', 'Consultar', 'Lector Huella/Rostro + Software de Asistencia')">
                            <div>
                                <strong>Biométrico</strong>
                                <small>Huella, rostro o tarjeta</small>
                            </div>
                            <i class="fa-solid fa-chevron-right"></i>
                        </div>
                        <div class="package-line" onclick="sendWhatsAppQuote('Acceso Vehicular / Torniquetes', 'Consultar', 'Pluma Vehicular + Torniquete Lector Placas')">
                            <div>
                                <strong>Acceso vehicular</strong>
                                <small>Pluma + lector de placas</small>
                            </div>
                            <i class="fa-solid fa-chevron-right"></i>
                        </div>
                    </div>
                    <div class="sector-card-footer">
                        <a href="#cotizador" class="btn btn-sector-light">Ver detalles y paquetes <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>

                <!-- Tarjeta 5: Servicio Especializado de Mantenimiento -->
                <div class="sector-card dark">
                    <div class="sector-card-header">
                        <div class="sector-icon"><i class="fa-solid fa-screwdriver-wrench"></i></div>
                        <span class="sector-tag">SERVICIO TÉCNICO ESPECIALIZADO</span>
                        <h3>Mantenimiento y Reparación</h3>
                    </div>
                    <div class="sector-card-body">
                        <div class="package-line" onclick="sendWhatsAppQuote('Mantenimiento Preventivo CCTV', 'Cotizar Visita', 'Limpieza óptica + ajuste enfoque + revisión fuentes y DVR')">
                            <div>
                                <strong>Mantenimiento Preventivo</strong>
                                <small>Limpieza de lentes, fuentes y DVR</small>
                            </div>
                            <i class="fa-solid fa-chevron-right"></i>
                        </div>
                        <div class="package-line" onclick="sendWhatsAppQuote('Mantenimiento Correctivo / Reparación', 'Cotizar Diagnóstico', 'Cámaras sin video + reemplazo disco + reseteo contraseñas')">
                            <div>
                                <strong>Reparación y Diagnóstico</strong>
                                <small>Fallas de señal, video negro y fuentes</small>
                            </div>
                            <i class="fa-solid fa-chevron-right"></i>
                        </div>
                        <div class="package-line" onclick="sendWhatsAppQuote('Reubicación y Cableado de Cámaras', 'Cotizar en Sitio', 'Cambio de posición + nuevo cableado estructurado protegido')">
                            <div>
                                <strong>Reubicación de Equipos</strong>
                                <small>Cambio de lugar de cámaras y cables</small>
                            </div>
                            <i class="fa-solid fa-chevron-right"></i>
                        </div>
                        <div class="package-line" onclick="sendWhatsAppQuote('Póliza Mensual / Anual para Negocios', 'A Medida', 'Visitas periódicas programadas + soporte técnico prioritario')">
                            <div>
                                <strong>Pólizas de Servicio</strong>
                                <small>Planes para comercios, escuelas y naves</small>
                            </div>
                            <i class="fa-solid fa-chevron-right"></i>
                        </div>
                    </div>
                    <div class="sector-card-footer">
                        <a href="#cotizador" class="btn btn-sector-dark">Solicitar Mantenimiento <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECCIÓN CATÁLOGO DINÁMICO DE KITS CON COMPONENTES BLADE -->
    <section class="section catalog-section" id="cotizador">
        <div class="container">
            <div class="section-title-wrapper text-center">
                <span class="sub-label">CATÁLOGO Y COTIZADOR</span>
                <h2>Kits de Seguridad Destacados</h2>
                <p>Haz clic en "Cotizar Kit" para enviar la solicitud de precio e instalación directa a nuestro equipo</p>
            </div>

            <!-- Barra de Búsqueda Interactiva en Tiempo Real (Inciso D) -->
            <div class="search-catalog-wrapper">
                <div class="search-input-box">
                    <i class="fa-solid fa-magnifying-glass search-icon"></i>
                    <input type="text" id="catalogSearch" class="catalog-search-field" placeholder="Buscar por modelo, cámaras (ej. 4 cámaras, videoportero, alarma)..." autocomplete="off">
                    <button type="button" id="clearSearchBtn" class="clear-search-btn" style="display:none;"><i class="fa-solid fa-xmark"></i></button>
                </div>
            </div>

            <!-- Filtros Dinámicos de Categorías -->
            <div class="filter-pills">
                <button class="pill-btn active" data-filter="all">Todos los Kits</button>
                @foreach($categories as $category)
                    <button class="pill-btn" data-filter="{{ $category->slug }}">{{ $category->name }}</button>
                @endforeach
            </div>

            <!-- Grilla Dinámica con Componente Reutilizable x-product-card -->
            <div class="products-grid">
                @forelse($kits as $kit)
                    <x-product-card :kit="$kit" />
                @empty
                    <div class="text-center" style="grid-column: 1 / -1; padding: 2rem;">
                        <p>No hay kits registrados en este momento.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- FORMULARIO DE COTIZACIÓN RÁPIDA A LA MEDIDA -->
    <section class="section custom-quote-section">
        <div class="container">
            <div class="quote-box">
                <div class="quote-header text-center">
                    <span class="quote-tag"><i class="fa-solid fa-sliders"></i> COTIZACIÓN PERSONALIZADA</span>
                    <h3>¿Buscas un proyecto o número de cámaras específico?</h3>
                    <p>Arma tu combinación requerida y envíala al instante a nuestro WhatsApp de atención</p>
                </div>
                <form id="customForm" onsubmit="handleCustomKitSubmit(event)" class="quote-form">
                    <div class="form-row">
                        <div class="form-field">
                            <label><i class="fa-solid fa-building"></i> Inmueble</label>
                            <select id="propertyType" class="select-input">
                                <option value="Casa / Residencial">Casa / Residencial</option>
                                <option value="Comercio / Tienda">Comercio / Tienda</option>
                                <option value="Nave Industrial / Bodega">Nave Industrial / Bodega</option>
                                <option value="Oficina / Corporativo">Oficina / Corporativo</option>
                            </select>
                        </div>
                        <div class="form-field">
                            <label><i class="fa-solid fa-video"></i> N° de Cámaras</label>
                            <select id="cameraCount" class="select-input">
                                <option value="2 Cámaras">2 Cámaras</option>
                                <option value="4 Cámaras" selected>4 Cámaras</option>
                                <option value="8 Cámaras">8 Cámaras</option>
                                <option value="16 Cámaras">16 Cámaras</option>
                                <option value="Más de 16 Cámaras (Proyecto)">Más de 16 Cámaras</option>
                            </select>
                        </div>
                        <div class="form-field">
                            <label><i class="fa-solid fa-tools"></i> Instalación</label>
                            <select id="needInstallation" class="select-input">
                                <option value="Sí, requiero instalación completa en sitio">Sí, requiero instalación en sitio</option>
                                <option value="Solo requiero equipos preconfigurados">Solo equipos preconfigurados</option>
                            </select>
                        </div>
                    </div>
                    <div class="text-center margin-top-2">
                        <button type="submit" class="btn btn-hero-whatsapp">
                            <i class="fa-brands fa-whatsapp"></i> Solicitar Presupuesto por WhatsApp
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- SECCIÓN PREGUNTAS FRECUENTES (FAQ INTERACTIVO) -->
    <section class="section faq-section" id="faq">
        <div class="container">
            <div class="section-title-wrapper text-center">
                <span class="sub-label">RESOLVEMOS TUS DUDAS</span>
                <h2>Preguntas Frecuentes de Clientes</h2>
                <p>Todo lo que necesitas saber sobre instalaciones, equipos, garantías y presupuestos.</p>
            </div>

            <div class="faq-accordion-container">
                <!-- FAQ Item 1 -->
                <div class="faq-item">
                    <button class="faq-question" aria-expanded="false">
                        <span><i class="fa-solid fa-circle-question faq-icon"></i> ¿Qué incluye el costo de instalación de los kits de cámaras?</span>
                        <i class="fa-solid fa-chevron-down faq-arrow"></i>
                    </button>
                    <div class="faq-answer">
                        <p>Nuestros paquetes incluyen el montaje y fijación técnica de las cámaras (en interior o intemperie), cableado estructurado protegido, configuración del DVR/NVR, disco duro para grabación continua, fuentes de alimentación y la configuración en los teléfonos celulares de los usuarios para monitoreo remoto en tiempo real sin costos mensuales.</p>
                    </div>
                </div>

                <!-- FAQ Item 2 -->
                <div class="faq-item">
                    <button class="faq-question" aria-expanded="false">
                        <span><i class="fa-solid fa-mobile-screen-button faq-icon"></i> ¿Puedo ver las cámaras de seguridad desde mi celular fuera de casa o negocio?</span>
                        <i class="fa-solid fa-chevron-down faq-arrow"></i>
                    </button>
                    <div class="faq-answer">
                        <p>Sí, al 100%. Todos los sistemas que instalamos se vinculan a la aplicación móvil oficial en tu smartphone (Android o iOS). Podrás ver video en vivo en alta definición, revisar grabaciones anteriores y recibir notificaciones instantáneas de detección de movimiento desde cualquier parte del mundo con conexión a internet.</p>
                    </div>
                </div>

                <!-- FAQ Item 3 -->
                <div class="faq-item">
                    <button class="faq-question" aria-expanded="false">
                        <span><i class="fa-solid fa-file-invoice-dollar faq-icon"></i> ¿Se cobran mensualidades o rentas por el monitoreo?</span>
                        <i class="fa-solid fa-chevron-down faq-arrow"></i>
                    </button>
                    <div class="faq-answer">
                        <p>No. En Electrónica Digital MX los equipos y el sistema son 100% de tu propiedad. No cobramos rentas mensuales, contratos forzosos ni anualidades por la visualización móvil o almacenamiento en tu disco duro.</p>
                    </div>
                </div>

                <!-- FAQ Item 4 -->
                <div class="faq-item">
                    <button class="faq-question" aria-expanded="false">
                        <span><i class="fa-solid fa-shield-halved faq-icon"></i> ¿Tienen garantía los equipos e instalaciones?</span>
                        <i class="fa-solid fa-chevron-down faq-arrow"></i>
                    </button>
                    <div class="faq-answer">
                        <p>Sí. Ofrecemos 1 año de garantía directa por escrito contra defectos de fábrica en equipos y garantía de satisfacción técnica en mano de obra e instalación. Contamos con 15 años de experiencia comprobada en Toluca y el Estado de México.</p>
                    </div>
                </div>

                <!-- FAQ Item 5 -->
                <div class="faq-item">
                    <button class="faq-question" aria-expanded="false">
                        <span><i class="fa-solid fa-map-location-dot faq-icon"></i> ¿Hacen visitas técnicas para diagnóstico antes de cotizar?</span>
                        <i class="fa-solid fa-chevron-down faq-arrow"></i>
                    </button>
                    <div class="faq-answer">
                        <p>Por supuesto. Si tienes una propiedad grande, nave industrial o negocio con requerimientos especiales, podemos agendar un levantamiento técnico en sitio en Toluca y municipios metropolitanos para asesorarte sobre las mejores ubicaciones de cámaras y ángulos de cobertura sin compromiso.</p>
                    </div>
                </div>

                <!-- FAQ Item 6: Mantenimiento -->
                <div class="faq-item">
                    <button class="faq-question" aria-expanded="false">
                        <span><i class="fa-solid fa-wrench faq-icon"></i> ¿Ofrecen servicio de mantenimiento si mis cámaras ya están instaladas o las compré por mi cuenta?</span>
                        <i class="fa-solid fa-chevron-down faq-arrow"></i>
                    </button>
                    <div class="faq-answer">
                        <p>Sí. Brindamos servicio técnico correctivo y preventivo multimarca (Hikvision, Dahua, Epcom, etc.). Diagnosticamos cámaras sin video o con imagen borrosa, corregimos cableados dañados, reemplazamos fuentes de poder defectuosas, recuperamos contraseñas olvidadas de grabadores y reconfiguramos la conexión en tus celulares.</p>
                    </div>
                </div>

                <!-- FAQ Item 7: Formas de Pago -->
                <div class="faq-item">
                    <button class="faq-question" aria-expanded="false">
                        <span><i class="fa-solid fa-credit-card faq-icon"></i> ¿Cuáles son las formas de pago y tiempos de entrega?</span>
                        <i class="fa-solid fa-chevron-down faq-arrow"></i>
                    </button>
                    <div class="faq-answer">
                        <p>Aceptamos transferencias electrónicas SPEI, pagos con tarjeta de crédito/débito y efectivo. La mayoría de instalaciones residenciales y comerciales estándar de 4 a 8 cámaras se concluyen y entregan en funcionamiento el mismo día programado.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
