<?php

namespace App\Http\Controllers;

use App\Models\QuoteLead;
use App\Models\ProductKit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class QuoteLeadController extends Controller
{
    /**
     * Registra un lead / solicitud de cotización en la base de datos
     * y genera la URL formateada hacia WhatsApp.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kit_id' => 'nullable|exists:product_kits,id',
            'kit_name' => 'nullable|string|max:150',
            'estimated_price' => 'nullable|string|max:50',
            'specs_summary' => 'nullable|string',
            'customer_name' => 'nullable|string|max:120',
            'customer_phone' => 'nullable|string|max:30',
            'property_type' => 'nullable|string|max:80',
            'camera_count' => 'nullable|string|max:50',
            'requires_installation' => 'nullable|string|max:100',
            'extra_services' => 'nullable|string|max:150',
        ]);

        $companyPhone = '527227060068';

        // Construir el mensaje formateado para WhatsApp
        if (!empty($validated['kit_name'])) {
            $message = "*SOLICITUD DE COTIZACIÓN - ELECTRÓNICA DIGITAL MX* 🛡️\n\n"
                     . "• *Kit de Interés:* " . $validated['kit_name'] . "\n"
                     . "• *Precio Estimado:* " . ($validated['estimated_price'] ?? 'A cotizar') . "\n"
                     . "• *Especificaciones:* " . ($validated['specs_summary'] ?? 'Estándar') . "\n\n"
                     . "Hola, me interesa adquirir e instalar este paquete. ¿Podrían brindarme información adicional sobre cobertura en mi zona y tiempos de instalación?";
        } else {
            $message = "*COTIZACIÓN A LA MEDIDA - ELECTRÓNICA DIGITAL MX* 🛠️\n\n"
                     . "• *Inmueble:* " . ($validated['property_type'] ?? 'No especificado') . "\n"
                     . "• *Número de Cámaras:* " . ($validated['camera_count'] ?? 'No especificado') . "\n"
                     . "• *Modalidad:* " . ($validated['requires_installation'] ?? 'No especificado') . "\n"
                     . ($validated['customer_name'] ? "• *Cliente:* " . $validated['customer_name'] . "\n" : "")
                     . ($validated['customer_phone'] ? "• *Teléfono:* " . $validated['customer_phone'] . "\n" : "")
                     . "\nHola, configuré este requerimiento en su sitio web y solicito una cotización formal.";
        }

        // Guardar el registro en la base de datos
        $lead = QuoteLead::create([
            'product_kit_id' => $validated['kit_id'] ?? null,
            'customer_name' => $validated['customer_name'] ?? 'Prospecto Web',
            'customer_phone' => $validated['customer_phone'] ?? null,
            'property_type' => $validated['property_type'] ?? null,
            'camera_count' => $validated['camera_count'] ?? null,
            'requires_installation' => $validated['requires_installation'] ?? null,
            'extra_services' => $validated['extra_services'] ?? null,
            'message_payload' => $message,
            'status' => 'nuevo',
        ]);

        $encodedMessage = urlencode($message);
        $whatsappUrl = "https://wa.me/{$companyPhone}?text={$encodedMessage}";

        return response()->json([
            'success' => true,
            'lead_id' => $lead->id,
            'whatsapp_url' => $whatsappUrl,
        ]);
    }
}
