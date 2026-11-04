/* ==========================================================================
   Electrónica Digital MX - JavaScript Interactivity & WhatsApp Integration
   ========================================================================== */

// Configuración del Número WhatsApp de la Empresa Electrónica Digital MX
const PHONE_WHATSAPP = '527227060068';

document.addEventListener('DOMContentLoaded', () => {
    initNavigation();
    initCategoryTabs();
});

/* --------------------------------------------------------------------------
   1. Mobile Navigation & Sticky Header Behavior
   -------------------------------------------------------------------------- */
function initNavigation() {
    const mobileToggle = document.getElementById('mobileToggle');
    const navMenu = document.getElementById('navMenu');

    if (mobileToggle && navMenu) {
        mobileToggle.addEventListener('click', () => {
            navMenu.classList.toggle('active');
        });
    }

    // Close mobile menu when clicking outside or clicking link
    document.querySelectorAll('.nav-link').forEach(link => {
        link.addEventListener('click', () => {
            if (navMenu.classList.contains('active')) {
                navMenu.classList.remove('active');
            }
        });
    });
}

/* --------------------------------------------------------------------------
   2. Category Filter Tabs for Products / Kits
   -------------------------------------------------------------------------- */
function initCategoryTabs() {
    const tabButtons = document.querySelectorAll('.tab-btn');
    const productCards = document.querySelectorAll('.product-card');

    tabButtons.forEach(button => {
        button.addEventListener('click', () => {
            // Manage Active Class
            tabButtons.forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');

            const filterValue = button.getAttribute('data-filter');

            productCards.forEach(card => {
                const category = card.getAttribute('data-category');
                if (filterValue === 'all' || category === filterValue) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
}

function filterCategory(catName) {
    const targetTab = document.querySelector(`.tab-btn[data-filter="${catName}"]`);
    if (targetTab) {
        targetTab.click();
    } else {
        const allTab = document.querySelector('.tab-btn[data-filter="all"]');
        if (allTab) allTab.click();
    }
}

/* --------------------------------------------------------------------------
   3. WhatsApp Messaging & Quote Redirection Engine
   -------------------------------------------------------------------------- */

/**
 * Enviar cotización directa de un Kit o Producto al hacer click en el botón
 */
function sendWhatsAppQuote(kitTitle, price, details) {
    const message = 
`*SOLICITUD DE COTIZACIÓN - ELECTRÓNICA DIGITAL MX* 🛡️

*Kit / Producto:* ${kitTitle}
*Precio Estimado:* ${price}
*Especificaciones:* ${details}

Hola, me interesa este paquete. ¿Podrían brindarme información adicional e instalación en mi zona?`;

    const encodedMessage = encodeURIComponent(message);
    const whatsappUrl = `https://wa.me/${PHONE_WHATSAPP}?text=${encodedMessage}`;
    
    window.open(whatsappUrl, '_blank');
}

/**
 * Enviar mensaje de cotización de rápida selección de categoría
 */
function openQuickQuote(itemName) {
    const message = 
`*COTIZACIÓN RÁPIDA - ELECTRÓNICA DIGITAL MX* 🛡️

*Interés:* ${itemName}

Hola, requiero informes y cotización técnica sobre este kit/servicio para mi propiedad.`;

    const encodedMessage = encodeURIComponent(message);
    const whatsappUrl = `https://wa.me/${PHONE_WHATSAPP}?text=${encodedMessage}`;
    
    window.open(whatsappUrl, '_blank');
}

/**
 * Manejo de Formulario Personalizado del Cotizador Interactivo
 */
function handleCustomKitSubmit(event) {
    event.preventDefault();

    const property = document.getElementById('propertyType').value;
    const cameras = document.getElementById('cameraCount').value;
    const installation = document.getElementById('needInstallation').value;
    const extra = document.getElementById('extraService').value;

    const message = 
`*COTIZACIÓN A LA MEDIDA - ELECTRÓNICA DIGITAL MX* 🛠️

*Detalles del Requerimiento:*
• *Tipo de Propiedad:* ${property}
• *Número de Cámaras:* ${cameras}
• *Instalación:* ${installation}
• *Servicio Adicional:* ${extra}

Hola, armé esta configuración en su sitio web. ¿Podrían apoyarme con el presupuesto exacto?`;

    const encodedMessage = encodeURIComponent(message);
    const whatsappUrl = `https://wa.me/${PHONE_WHATSAPP}?text=${encodedMessage}`;

    window.open(whatsappUrl, '_blank');
}

/**
 * Manejo del Formulario de Contacto Rápido en la sección de Ubicación
 */
function handleQuickFormSubmit(event) {
    event.preventDefault();

    const name = document.getElementById('qName').value;
    const phone = document.getElementById('qPhone').value;
    const msg = document.getElementById('qMsg').value;

    const message = 
`*MENSAJE DE CONTACTO WEB - ELECTRÓNICA DIGITAL MX* 📩

• *Nombre:* ${name}
• *Teléfono:* ${phone}
• *Consulta:* ${msg}`;

    const encodedMessage = encodeURIComponent(message);
    const whatsappUrl = `https://wa.me/${PHONE_WHATSAPP}?text=${encodedMessage}`;

    window.open(whatsappUrl, '_blank');
}
