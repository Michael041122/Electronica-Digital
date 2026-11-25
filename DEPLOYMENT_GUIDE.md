# =====================================================================
# Guía de Despliegue Gratuito y Mantenimiento
# Sistema Web de Gestión y Difusión para Electrónica Digital MX
# Residencia Profesional - TESSFP
# =====================================================================

## 1. Opciones Recomendadas de Hospedaje Gratuito (Render / Railway)

Para cumplir con lo estipulado en tu Anteproyecto (Tabla 1: Servidor web *Render* / *Vercel*):

### Opción A: Despliegue en Render (Recomendada para Laravel)
1. Sube tu código a un repositorio privado de **GitHub**.
2. Entra a [Render.com](https://render.com) e inicia sesión con GitHub.
3. Haz clic en **New +** -> **Web Service** y selecciona tu repositorio `ElectronicaDigital`.
4. Elige **Docker** (Render detectará automáticamente el archivo `Dockerfile` que acabamos de crear) o entorno nativo PHP.
5. Configura las Variables de Entorno en Render:
   - `APP_NAME`: `Electrónica Digital MX`
   - `APP_ENV`: `production`
   - `APP_KEY`: Copia el valor de tu `.env` local (`base64:...`)
   - `APP_DEBUG`: `false`
   - `APP_URL`: `https://tu-subdominio.onrender.com`
6. Haz clic en **Deploy Web Service**. ¡Listo! Tendrás tu aplicación en línea con certificado SSL gratuito (HTTPS).

---

## 2. Buenas Prácticas de Reutilización de Código Aplicadas

### En el Frontend:
- **Plantilla Maestra (`resources/views/layouts/app.blade.php`)**: Toda la cabecera, navegación con dropdown, CDN de iconos, scripts base y pie de página con datos de Toluca están centralizados en un único archivo. Ninguna otra vista duplica código de layout.
- **Componentes Blade (`<x-product-card :kit="$kit" />`)**: Cada kit o producto cotizable se renderiza mediante un único componente reutilizable en `resources/views/components/product-card.blade.php`. Si mañana cambias el diseño de una tarjeta de kit o el botón de cotización, se actualiza automáticamente en todo el sistema.
- **Módulo JavaScript Centralizado (`public/js/script.js`)**: Las funciones de filtrado y generación de mensajes hacia WhatsApp (`sendWhatsAppQuote`) están encapsuladas y reciben parámetros dinámicos sin duplicar lógica en el HTML.

### En el Backend:
- **Modelos Eloquent Relacionales**: `Category`, `ProductKit`, `Service` y `QuoteLead` manejan relaciones relacionales limpias (`hasMany`, `belongsTo`) evitando consultas SQL manuales repetitivas.
- **Controlador Centralizado (`HomeController`)**: Una sola consulta procesa y alimenta los catálogos y categorías con eager loading (`with('category')`), reduciendo el consumo de memoria y optimizando la base de datos para servidores con recursos gratuitos (512MB RAM).
