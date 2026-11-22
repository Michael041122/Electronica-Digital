/* ==========================================================================
   Electrónica Digital MX - Script Reutilizable & Modular
   Manejo de WhatsApp Quotes con Guardado en BD (QuoteLeads), Filtrado Dinámico y UI
   ========================================================================== */

const COMPANY_PHONE = '527227060068';

document.addEventListener('DOMContentLoaded', () => {
    initCategoryFilter();
    initMobileNav();
    initFaqAccordion();
});

/**
 * 1. Filtrado dinámico de Kits por categorías
 */
function initCategoryFilter() {
    const pillButtons = document.querySelectorAll('.pill-btn');
    const productItems = document.querySelectorAll('.product-item');

    pillButtons.forEach(button => {
        button.addEventListener('click', () => {
            pillButtons.forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');

            const filterValue = button.getAttribute('data-filter');

            productItems.forEach(item => {
                const category = item.getAttribute('data-category');
                if (filterValue === 'all' || category === filterValue) {
                    item.style.display = 'flex';
                } else {
                    item.style.display = 'none';
                }
            });
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
 * 2. Menú de navegación móvil
 */
function initMobileNav() {
    const mobileToggle = document.getElementById('mobileToggle');
    const navMenu = document.getElementById('navMenu');

    if (mobileToggle && navMenu) {
        mobileToggle.addEventListener('click', (e) => {
            e.stopPropagation();
            navMenu.classList.toggle('active');
        });

        // Cerrar menú al hacer clic en un enlace
        navMenu.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', () => {
                navMenu.classList.remove('active');
            });
        });

        // Cerrar menú al hacer clic fuera
        document.addEventListener('click', (e) => {
            if (!navMenu.contains(e.target) && !mobileToggle.contains(e.target)) {
                navMenu.classList.remove('active');
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
