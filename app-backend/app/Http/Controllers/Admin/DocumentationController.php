<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DocumentationController extends Controller
{
    /**
     * Muestra la vista interactiva de la documentación técnica y manuales del sistema.
     */
    public function index()
    {
        $userManualPath = file_exists(base_path('../MANUAL_DE_USUARIO.md')) 
            ? base_path('../MANUAL_DE_USUARIO.md') 
            : base_path('MANUAL_DE_USUARIO.md');

        $technicalDocPath = file_exists(base_path('../MEMORIA_TECNICA.md')) 
            ? base_path('../MEMORIA_TECNICA.md') 
            : base_path('MEMORIA_TECNICA.md');

        $deploymentGuidePath = file_exists(base_path('../DEPLOYMENT_GUIDE.md')) 
            ? base_path('../DEPLOYMENT_GUIDE.md') 
            : base_path('DEPLOYMENT_GUIDE.md');

        $userManual = file_exists($userManualPath) ? file_get_contents($userManualPath) : 'Manual de usuario no disponible.';
        $technicalDoc = file_exists($technicalDocPath) ? file_get_contents($technicalDocPath) : 'Memoria técnica no disponible.';
        $deploymentGuide = file_exists($deploymentGuidePath) ? file_get_contents($deploymentGuidePath) : 'Guía de despliegue no disponible.';

        return view('admin.docs.index', compact('userManual', 'technicalDoc', 'deploymentGuide'));
    }
}
