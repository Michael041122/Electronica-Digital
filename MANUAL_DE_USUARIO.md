# MANUAL DE USUARIO Y ADMINISTRACIÓN
## Sistema Web de Gestión y Difusión para Electrónica Digital MX

**Organización:** Electrónica Digital MX  
**Dirección:** Heriberto Enríquez No. 606, Col. Santa María de las Rosas, Toluca, Estado de México  
**Responsable Técnico / Residente:** Michael Hernández de Jesús (TESSFP)  
**Asesor Externo:** Ing. Josué Verónica Pacheco (Gerente General)  

---

## 1. Introducción
El presente manual tiene como objetivo guiar al personal administrativo y operativo de **Electrónica Digital MX** en el uso y mantenimiento del sistema web. La plataforma permite la difusión de servicios, gestión de catálogo de kits de videovigilancia/seguridad electrónica y la captura de prospectos interesados (leads) a través de WhatsApp.

---

## 2. Acceso al Panel de Administración

### 2.1 Credenciales de Acceso
El acceso al panel administrativo está protegido contra accesos no autorizados mediante autenticación cifrada y control de intentos fallidos.

- **URL de Acceso:** `http://127.0.0.1:8000/login` (o la URL de producción asignada)
- **Usuario / Correo:** `electronica.digital.toluca@gmail.com`
- **Contraseña Inicial:** `Admin2026!`

> [!TIP]
> Si se introducen 5 intentos incorrectos en menos de 1 minuto, el sistema bloqueará temporalmente la dirección IP para proteger la cuenta contra ataques de fuerza bruta.

---

## 3. Módulos del Sistema

### 3.1 Dashboard General (`/admin`)
Al iniciar sesión, el sistema muestra el tablero de control principal con:
1. **Métricas en tiempo real:**
   - Total de kits de seguridad activos.
   - Total de categorías configuradas.
   - Total de cotizaciones solicitadas por clientes.
2. **Tabla de Prospectos Recientes (Leads Web):**
   - Muestra la fecha exacta de la consulta.
   - Nombre o identificador del prospecto.
   - Teléfono o canal de contacto.
   - Kit de interés o especificaciones si fue una cotización personalizada (inmueble, cantidad de cámaras e instalación).
   - Estado del seguimiento (*Nuevo*, *Contactado*, *En proceso*, *Cerrado*).

### 3.2 Gestión del Catálogo de Kits (`/admin/kits`)
Permite administrar los paquetes que ven los clientes en el portal público:

#### A) Registrar un Nuevo Kit:
1. Haga clic en el botón azul **"Nuevo Kit"**.
2. Complete los campos requeridos:
   - **Nombre del Kit:** (Ej. *Kit 4 Cámaras IP Full HD*).
   - **Categoría:** Seleccione entre *CCTV*, *Control de Acceso*, *Alarmas* o *Redes*.
   - **Precio Estimado:** Ingrese el monto en MXN o déjelo vacío si requiere levantamiento técnico previo ("A Cotizar").
   - **Distintivo (Badge):** Texto destacado opcional (Ej. *Más Vendido*, *Ideal Negocios*).
   - **Resumen Técnico:** Lista rápida de componentes (Ej. *DVR 4Ch + Disco 1TB + 4 Cámaras + Cableado*).
   - **URL de Imagen:** Enlace de la fotografía del producto.
   - **Viñetas de Características:** Ingrese una ventaja por renglón (Ej. *Visión nocturna*, *App móvil*).
3. Presione **"Guardar Kit"**. El producto aparecerá de inmediato en el sitio público.

#### B) Editar o Modificar Precios:
1. En la lista de kits, localice el producto y presione el botón de edición (icono de lápiz).
2. Actualice los precios, componentes o texto.
3. Presione **"Guardar Cambios"**.

#### C) Ocultar temporalmente o Eliminar:
- Para no mostrar un kit temporalmente sin borrarlo, desmarque la casilla **"Visible en el catálogo público"**.
- Para eliminarlo definitivamente, presione el botón rojo de papelera (el sistema solicitará confirmación).

---

## 4. Flujo de Cotizaciones hacia WhatsApp

1. El cliente visita el catálogo público en `http://127.0.0.1:8000`.
2. Al presionar **"Cotizar Kit"** o llenar el configurador personalizado:
   - El sistema guarda automáticamente el registro del lead en la base de datos para auditoría y trazabilidad.
   - Inmediatamente se abre WhatsApp con un mensaje pre-estructurado dirigido al número de atención: `722 706 0068`.
   - Si el cliente por alguna razón cancela o cierra WhatsApp, sus datos y el paquete cotizado ya quedaron guardados en el panel administrativo.

---

## 5. Cierre Seguro de Sesión
Al terminar las labores administrativas:
1. En el menú lateral izquierdo (sidebar), haga clic en **"Cerrar Sesión"**.
2. El sistema invalidará la sesión activa y rotará los tokens de seguridad.

---

## 7. Nuevas Funcionalidades y Ergonomía Móvil (Actualización Reciente)

### 7.1 Subida de Imágenes Locales para Kits
- Al crear o editar un paquete en el panel (`/admin/kits`), ahora cuenta con el campo **"Subir Imagen desde Archivo Local"** (`<input type="file">`).
- Formatos soportados: `.jpg`, `.jpeg`, `.png`, `.webp`, `.svg` (hasta 3MB).
- Las imágenes se procesan de forma segura y se almacenan en el disco público (`storage/app/public/kits/`), generando una URL accesible automáticamente sin requerir servicios externos de hosting de imágenes.

### 7.2 Buscador en Tiempo Real del Catálogo
- Los clientes pueden buscar instantáneamente cualquier modelo, tecnología o palabra clave (ej. *"4 cámaras"*, *"wifi"*, *"alarma"*, *"dvr"*, *"hikvision"*).
- El filtrado se ejecuta de forma síncrona en el cliente sin recargar la página, combinándose de forma inteligente con los filtros por categoría.
- En caso de no existir coincidencias exactas, se presenta una tarjeta con botón directo para solicitar un paquete personalizado vía WhatsApp.

### 7.3 Servicio de Mantenimiento y Preguntas Frecuentes (FAQ)
- Se incorporó la tarjeta del **Servicio Técnico Especializado de Mantenimiento y Reparación** (preventivo, correctivo, reubicación y pólizas periódicas).
- Acordeón interactivo de **Preguntas Frecuentes** con 7 temas clave: costos, monitoreo celular sin rentas mensuales, garantías de 1 año, visitas de diagnóstico en Toluca, servicio técnico multimarca y métodos de pago.

### 7.4 Compatibilidad Multi-Dispositivo y Modos Claro/Oscuro
- Menú de navegación móvil optimizado con contraste WCAG 2.2 AAA (sin textos transparentes o descoloridos).
- Barra de navegación con botón unificado de WhatsApp en la cabecera superior y enlaces flotantes ergonómicos en la esquina inferior.
