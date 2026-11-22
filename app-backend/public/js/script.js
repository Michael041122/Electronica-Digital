/* ==========================================================================
   Electrónica Digital MX - Script Reutilizable & Modular
   Manejo de WhatsApp Quotes con Guardado en BD (QuoteLeads), Filtrado Dinámico y UI
   ========================================================================== */

const COMPANY_PHONE = '527227060068';

document.addEventListener('DOMContentLoaded', () => {
    initCategoryFilter();
    initCatalogSearch();
    initMobileNav();
    initFaqAccordion();
});

/**
 * 1. Filtrado dinámico de Kits por categorías y búsqueda unificada
 */
function applyCatalogFilters() {
    const searchInput = document.getElementById('catalogSearch');
    const clearBtn = document.getElementById('clearSearchBtn');
    const productItems = document.querySelectorAll('.product-item');
    const noResultsNotice = document.getElementById('noSearchResults');

    const query = searchInput ? searchInput.value.trim().toLowerCase() : '';
    if (clearBtn) {
        clearBtn.style.display = query.length > 0 ? 'block' : 'none';
    }

    const currentActivePill = document.querySelector('.pill-btn.active');
    const activeCategory = currentActivePill ? currentActivePill.getAttribute('data-filter') : 'all';

    let visibleCount = 0;

    productItems.forEach(item => {
        const category = item.getAttribute('data-category') || '';
        const title = item.querySelector('.product-title')?.textContent.toLowerCase() || '';
        const desc = item.querySelector('.product-description')?.textContent.toLowerCase() || '';
        const specs = item.querySelector('.product-specs')?.textContent.toLowerCase() || '';
        const badges = item.querySelector('.product-badge')?.textContent.toLowerCase() || '';

        const matchesCategory = (activeCategory === 'all' || category === activeCategory);
        const matchesQuery = query === '' || 
            title.includes(query) || 
            desc.includes(query) || 
            specs.includes(query) || 
            badges.includes(query) ||
            category.includes(query);

        if (matchesCategory && matchesQuery) {
            item.style.display = 'flex';
            visibleCount++;
        } else {
            item.style.display = 'none';
        }
    });

    if (noResultsNotice) {
        noResultsNotice.style.display = visibleCount === 0 ? 'block' : 'none';
    }
}

function initCategoryFilter() {
    const pillButtons = document.querySelectorAll('.pill-btn');

    pillButtons.forEach(button => {
        button.addEventListener('click', () => {
            pillButtons.forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');
            applyCatalogFilters();
        });
    });
}

function filterCategory(catSlug) {
    const targetBtn = document.querySelector(`.pill-btn[data-filter="${catSlug}"]`);
    if (targetBtn) {
        targetBtn.click();
    } else {
        const allBtn = document.querySelector('.pill-btn[data-filter="all"]');
        if (allBtn) allBtn.click();
    }
}

/**
 * 1.1 Búsqueda en tiempo real en el catálogo (Inciso D)
 */
function initCatalogSearch() {
    const searchInput = document.getElementById('catalogSearch');
    const clearBtn = document.getElementById('clearSearchBtn');
    const catalogGrid = document.querySelector('.catalog-grid');

    if (!searchInput) return;

    // Crear aviso de "No se encontraron resultados" dentro de catalog-grid
    if (catalogGrid && !document.getElementById('noSearchResults')) {
        const noNotice = document.createElement('div');
        noNotice.id = 'noSearchResults';
        noNotice.className = 'no-search-results';
        noNotice.style.display = 'none';
        noNotice.innerHTML = `
            <i class="fa-solid fa-magnifying-glass"></i>
            <h4>No encontramos paquetes con ese término</h4>
            <p>Intenta con otra palabra clave (ej. "4 cámaras", "wifi", "alarma", "hikvision") o contáctanos para armar tu paquete a la medida.</p>
            <a href="https://wa.me/${COMPANY_PHONE}?text=Hola,%20busco%20un%20equipo%20específico%20que%20no%20encontré%20en%20el%20catálogo" target="_blank" class="btn btn-whatsapp-header" style="margin-top: 1rem; display: inline-flex;">
                <i class="fa-brands fa-whatsapp"></i> Preguntar por WhatsApp
            </a>
        `;
        catalogGrid.appendChild(noNotice);
    }

    searchInput.addEventListener('input', applyCatalogFilters);

    if (clearBtn) {
        clearBtn.addEventListener('click', () => {
            searchInput.value = '';
            applyCatalogFilters();
            searchInput.focus();
        });
    }
}

/**
 * 2. Menú de navegación móvil con soporte para submenú desplegable
 */
function initMobileNav() {
    const mobileToggle = document.getElementById('mobileToggle');
    const navMenu = document.getElementById('navMenu');
    const dropdownToggle = document.querySelector('.dropdown-toggle');
    const navDropdown = document.querySelector('.nav-dropdown');

    if (mobileToggle && navMenu) {
        mobileToggle.addEventListener('click', (e) => {
            e.stopPropagation();
            navMenu.classList.toggle('active');
        });

        // Desplegar menú de servicios en móviles al hacer clic
        if (dropdownToggle && navDropdown) {
            dropdownToggle.addEventListener('click', (e) => {
                if (window.innerWidth <= 768) {
                    e.preventDefault();
                    navDropdown.classList.toggle('open');
                }
            });
        }

        // Cerrar menú al hacer clic en un enlace de navegación
        navMenu.querySelectorAll('.nav-link:not(.dropdown-toggle), .dropdown-item').forEach(link => {
            link.addEventListener('click', () => {
                navMenu.classList.remove('active');
                if (navDropdown) navDropdown.classList.remove('open');
            });
        });

        // Cerrar menú al hacer clic fuera
        document.addEventListener('click', (e) => {
            if (!navMenu.contains(e.target) && !mobileToggle.contains(e.target)) {
                navMenu.classList.remove('active');
                if (navDropdown) navDropdown.classList.remove('open');
            }
        });
    }
}

/**
 * 2.1 Acordeón de Preguntas Frecuentes (FAQ)
 */
function initFaqAccordion() {
    const faqButtons = document.querySelectorAll('.faq-question');
    
    faqButtons.forEach(button => {
        button.addEventListener('click', () => {
            const faqItem = button.closest('.faq-item');
            const isActive = faqItem.classList.contains('active');
            
            // Cerrar otros acordeones si se desea comportamiento único
            document.querySelectorAll('.faq-item').forEach(item => {
                item.classList.remove('active');
                item.querySelector('.faq-question')?.setAttribute('aria-expanded', 'false');
            });
            
            if (!isActive) {
                faqItem.classList.add('active');
                button.setAttribute('aria-expanded', 'true');
            }
        });
    });
}

/**
 * 3. Enviar cotización directa a WhatsApp registrando primero en Base de Datos
 */
function sendWhatsAppQuote(kitTitle, price, details, kitId = null) {
    // Enviar asíncronamente a backend para trazabilidad
    fetch('/api/quote-leads', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
        },
        body: JSON.stringify({
            kit_id: kitId,
            kit_name: kitTitle,
            estimated_price: price,
            specs_summary: details,
            customer_name: 'Cliente Interesado (Web)'
        })
    })
    .then(res => res.json())
    .then(data => {
        if (data.whatsapp_url) {
            window.open(data.whatsapp_url, '_blank');
        } else {
            fallbackWhatsApp(kitTitle, price, details);
        }
    })
    .catch(() => {
        fallbackWhatsApp(kitTitle, price, details);
    });
}

function fallbackWhatsApp(kitTitle, price, details) {
    const message = 
`*SOLICITUD DE COTIZACIÓN - ELECTRÓNICA DIGITAL MX* 🛡️

*Kit de Interés:* ${kitTitle}
*Precio Estimado:* ${price}
*Especificaciones:* ${details}

Hola, me interesa adquirir e instalar este paquete. ¿Podrían brindarme información adicional sobre cobertura en mi zona y tiempos de instalación?`;

    const encoded = encodeURIComponent(message);
    window.open(`https://wa.me/${COMPANY_PHONE}?text=${encoded}`, '_blank');
}

/**
 * 4. Formulario de cotización personalizada a la medida
 */
function handleCustomKitSubmit(event) {
    event.preventDefault();

    const property = document.getElementById('propertyType').value;
    const cameras = document.getElementById('cameraCount').value;
    const installation = document.getElementById('needInstallation').value;

    fetch('/api/quote-leads', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
        },
        body: JSON.stringify({
            property_type: property,
            camera_count: cameras,
            requires_installation: installation,
            customer_name: 'Cotización a Medida (Web)'
        })
    })
    .then(res => res.json())
    .then(data => {
        if (data.whatsapp_url) {
            window.open(data.whatsapp_url, '_blank');
        } else {
            fallbackCustomWhatsApp(property, cameras, installation);
        }
    })
    .catch(() => {
        fallbackCustomWhatsApp(property, cameras, installation);
    });
}

function fallbackCustomWhatsApp(property, cameras, installation) {
    const message = 
`*COTIZACIÓN A LA MEDIDA - ELECTRÓNICA DIGITAL MX* 🛠️

*Detalles del Proyecto:*
• *Inmueble:* ${property}
• *Número de Cámaras:* ${cameras}
• *Modalidad:* ${installation}

Hola, configuré este paquete en su sitio web y deseo una cotización personalizada.`;

    const encoded = encodeURIComponent(message);
    window.open(`https://wa.me/${COMPANY_PHONE}?text=${encoded}`, '_blank');
}
