<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\ProductKit;
use App\Models\Service;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 0. Usuario Administrador Inicial para la Empresa
        User::firstOrCreate(
            ['email' => 'electronica.digital.toluca@gmail.com'],
            [
                'name' => 'Ing. Josué Verónica Pacheco',
                'password' => Hash::make('Admin2026!'),
                'email_verified_at' => now(),
            ]
        );

        // 1. Categorías Base
        $cctv = Category::firstOrCreate(
            ['slug' => 'cctv'],
            [
                'name' => 'Cámaras de Seguridad (CCTV)',
                'icon' => 'fa-video',
                'description' => 'Soluciones en videovigilancia IP y analógica para todo tipo de inmuebles.'
            ]
        );

        $acceso = Category::firstOrCreate(
            ['slug' => 'acceso'],
            [
                'name' => 'Control de Acceso',
                'icon' => 'fa-id-card',
                'description' => 'Videoporteros, cerraduras inteligentes y control biométrico.'
            ]
        );

        $alarmas = Category::firstOrCreate(
            ['slug' => 'alarmas'],
            [
                'name' => 'Sistemas de Alarma',
                'icon' => 'fa-bell',
                'description' => 'Alarmas inteligentes inalámbricas sin pagos mensuales.'
            ]
        );

        $redes = Category::firstOrCreate(
            ['slug' => 'redes'],
            [
                'name' => 'Redes y Telecomunicaciones',
                'icon' => 'fa-network-wired',
                'description' => 'Cableado estructurado Cat6, fibra y telefonía IP.'
            ]
        );

        // 2. Kits Destacados
        ProductKit::firstOrCreate(
            ['slug' => 'kit-4-camaras-full-hd-1080p'],
            [
                'category_id' => $cctv->id,
                'name' => 'Kit 4 Cámaras Full HD 1080p',
                'badge' => 'Más Solicitado',
                'estimated_price' => 3850.00,
                'specs_summary' => 'DVR 4Ch + Disco 1TB + 4 Cámaras IR + Fuentes y Cableado',
                'description' => 'DVR de 4 canales, Disco Duro 1TB, 4 Cámaras visión nocturna exterior/interior y accesorios completos.',
                'image_url' => 'https://images.unsplash.com/photo-1557597774-9d273605dfa9?auto=format&fit=crop&w=600&q=80',
                'features' => [
                    'Visualización remota en Smartphone',
                    'Visión nocturna infrarroja 20 metros',
                    'Garantía y soporte técnico en Toluca'
                ],
                'includes_installation' => true,
                'is_active' => true
            ]
        );

        ProductKit::firstOrCreate(
            ['slug' => 'kit-8-camaras-2mp-deteccion-movimiento'],
            [
                'category_id' => $cctv->id,
                'name' => 'Kit 8 Cámaras 2MP + Detección Movimiento',
                'badge' => 'Ideal Negocios',
                'estimated_price' => 6950.00,
                'specs_summary' => 'DVR 8Ch + Disco 2TB + 8 Cámaras IP67 Metal + Alertas Celular',
                'description' => 'DVR 8 canales Lite, Disco 2TB especial de grabación continua, 8 Cámaras metálicas intemperie IP67.',
                'image_url' => 'https://images.unsplash.com/photo-1580894732444-8ecded7900cd?auto=format&fit=crop&w=600&q=80',
                'features' => [
                    'Notificaciones de movimiento a la App',
                    'Respaldo prolongado de video',
                    'Cobertura total de interior y exterior'
                ],
                'includes_installation' => true,
                'is_active' => true
            ]
        );

        ProductKit::firstOrCreate(
            ['slug' => 'videoportero-ip-monitor-tactil-7'],
            [
                'category_id' => $acceso->id,
                'name' => 'Videoportero IP con Monitor Táctil 7"',
                'badge' => 'Tecnología IP',
                'estimated_price' => 4490.00,
                'specs_summary' => 'Frente calle HD + Monitor táctil 7p + App Móvil + Apertura chapa',
                'description' => 'Frente de calle exterior metálico HD con apertura remota desde App móvil y pantalla táctil interior.',
                'image_url' => 'https://images.unsplash.com/photo-1558002038-1055907df827?auto=format&fit=crop&w=600&q=80',
                'features' => [
                    'Atiende llamadas de tu puerta desde tu teléfono',
                    'Integración con cerradura eléctrica',
                    'Cámara HD con ángulo ultra amplio'
                ],
                'includes_installation' => true,
                'is_active' => true
            ]
        );
    }
}
