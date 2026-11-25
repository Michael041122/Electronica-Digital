-- =====================================================================
-- Esquema de Base de Datos para Electrónica Digital MX
-- Residencia Profesional - TESSFP
-- Base de datos: electronica_digital_db
-- =====================================================================

CREATE DATABASE IF NOT EXISTS `electronica_digital_db`
  DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE `electronica_digital_db`;

-- 1. Tabla de Usuarios Administradores / Asesores
CREATE TABLE IF NOT EXISTS `users` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(120) NOT NULL,
  `email` VARCHAR(150) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `role` ENUM('admin', 'editor', 'asesor') DEFAULT 'admin',
  `remember_token` VARCHAR(100) NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- 2. Categorías de Servicios y Kits (CCTV Hogar, Comercio, Industria, Acceso, etc.)
CREATE TABLE IF NOT EXISTS `categories` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `slug` VARCHAR(120) NOT NULL UNIQUE,
  `description` TEXT NULL,
  `icon` VARCHAR(60) DEFAULT 'fa-video',
  `is_active` BOOLEAN DEFAULT TRUE,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- 3. Catálogo de Servicios Detallados (Instalación CCTV, Redes, Alarmas, etc.)
CREATE TABLE IF NOT EXISTS `services` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `category_id` BIGINT UNSIGNED NOT NULL,
  `title` VARCHAR(150) NOT NULL,
  `slug` VARCHAR(180) NOT NULL UNIQUE,
  `short_description` VARCHAR(255) NOT NULL,
  `full_content` LONGTEXT NULL,
  `image_url` VARCHAR(255) NULL,
  `features` JSON NULL COMMENT 'Lista de viñetas o ventajas',
  `is_featured` BOOLEAN DEFAULT FALSE,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`category_id`) REFERENCES `categories`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB;

-- 4. Catálogo de Kits y Paquetes Cotizables
CREATE TABLE IF NOT EXISTS `product_kits` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `category_id` BIGINT UNSIGNED NOT NULL,
  `name` VARCHAR(150) NOT NULL,
  `slug` VARCHAR(180) NOT NULL UNIQUE,
  `badge` VARCHAR(50) NULL COMMENT 'Ej: Más Vendido, Ideal Negocios',
  `estimated_price` DECIMAL(10,2) NULL COMMENT '0 si es a cotizar',
  `specs_summary` TEXT NOT NULL COMMENT 'DVR 4Ch, Disco 1TB, etc.',
  `description` TEXT NULL,
  `image_url` VARCHAR(255) NULL,
  `includes_installation` BOOLEAN DEFAULT TRUE,
  `is_active` BOOLEAN DEFAULT TRUE,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`category_id`) REFERENCES `categories`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB;

-- 5. Registro de Cotizaciones y Solicitudes de Contacto (Métricas de la Empresa)
CREATE TABLE IF NOT EXISTS `quote_leads` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `kit_id` BIGINT UNSIGNED NULL,
  `customer_name` VARCHAR(120) NULL,
  `customer_phone` VARCHAR(30) NULL,
  `property_type` VARCHAR(80) NULL COMMENT 'Residencial, Comercial, Industrial',
  `camera_count` VARCHAR(50) NULL,
  `requires_installation` VARCHAR(100) NULL,
  `extra_services` VARCHAR(150) NULL,
  `message_payload` TEXT NULL,
  `status` ENUM('nuevo', 'contactado', 'en_proceso', 'cerrado', 'descartado') DEFAULT 'nuevo',
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`kit_id`) REFERENCES `product_kits`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB;

-- =====================================================================
-- Datos Semilla Iniciales (Seeders)
-- =====================================================================

INSERT INTO `categories` (`id`, `name`, `slug`, `icon`) VALUES
(1, 'Cámaras de Seguridad (CCTV)', 'cctv', 'fa-video'),
(2, 'Control de Acceso', 'control-acceso', 'fa-id-card'),
(3, 'Sistemas de Alarma', 'alarmas', 'fa-bell'),
(4, 'Redes y Telecomunicaciones', 'redes-voip', 'fa-network-wired');

INSERT INTO `product_kits` (`category_id`, `name`, `slug`, `badge`, `estimated_price`, `specs_summary`, `description`, `image_url`) VALUES
(1, 'Kit 4 Cámaras Full HD 1080p', 'kit-4-camaras-full-hd-1080p', 'Más Solicitado', 3850.00, 'DVR 4Ch + Disco 1TB + 4 Cámaras IR + Fuentes y Cableado', 'Kit completo residencial ideal para casas pequeñas o medianas con monitoreo remoto en smartphone.', 'https://images.unsplash.com/photo-1557597774-9d273605dfa9?auto=format&fit=crop&w=600&q=80'),
(1, 'Kit 8 Cámaras 2MP + Detección Movimiento', 'kit-8-camaras-2mp-deteccion', 'Ideal Negocios', 6950.00, 'DVR 8Ch + Disco 2TB + 8 Cámaras IP67 Metal + Alertas', 'Sistema comercial diseñado para comercios, bodegas y oficinas con cobertura perimetral e interior.', 'https://images.unsplash.com/photo-1580894732444-8ecded7900cd?auto=format&fit=crop&w=600&q=80'),
(2, 'Videoportero IP con Monitor Táctil 7 pulg', 'videoportero-ip-monitor-7-pulgadas', 'Tecnología IP', 4490.00, 'Frente calle HD + Monitor táctil 7p + App Móvil + Apertura chapa', 'Videoportero IP que permite atender desde el teléfono o pantalla y abrir cerraduras eléctricas.', 'https://images.unsplash.com/photo-1558002038-1055907df827?auto=format&fit=crop&w=600&q=80');
