<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DocumentationController extends Controller
{
    /**
     * Muestra la vista de documentación técnica y manuales del sistema.
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

        $rawUserManual = file_exists($userManualPath) ? file_get_contents($userManualPath) : 'Manual de usuario no disponible.';
        $rawTechnicalDoc = file_exists($technicalDocPath) ? file_get_contents($technicalDocPath) : 'Memoria técnica no disponible.';
        $rawDeploymentGuide = file_exists($deploymentGuidePath) ? file_get_contents($deploymentGuidePath) : 'Guía de despliegue no disponible.';

        // Limpiar cualquier emoji residual para mantener una presentación 100% formal y técnica
        $rawUserManual = $this->stripEmojis($rawUserManual);
        $rawTechnicalDoc = $this->stripEmojis($rawTechnicalDoc);
        $rawDeploymentGuide = $this->stripEmojis($rawDeploymentGuide);

        $userManual = $this->renderMarkdownToHtml($rawUserManual);
        $technicalDoc = $this->renderMarkdownToHtml($rawTechnicalDoc);
        $deploymentGuide = $this->renderMarkdownToHtml($rawDeploymentGuide);

        // Extraer tabla de contenido rápida para cada documento
        $userManualToc = $this->extractTableOfContents($rawUserManual);
        $technicalDocToc = $this->extractTableOfContents($rawTechnicalDoc);
        $deploymentGuideToc = $this->extractTableOfContents($rawDeploymentGuide);

        return view('admin.docs.index', compact(
            'userManual', 'technicalDoc', 'deploymentGuide',
            'userManualToc', 'technicalDocToc', 'deploymentGuideToc'
        ));
    }

    /**
     * Elimina caracteres emoji para evitar apariencia informal o generada por IA.
     */
    private function stripEmojis(string $string): string
    {
        // Rango de emojis Unicode comunes y extendidos
        $regex = '/[\x{1F600}-\x{1F64F}\x{1F300}-\x{1F5FF}\x{1F680}-\x{1F6FF}\x{1F700}-\x{1F77F}\x{1F780}-\x{1F7FF}\x{1F800}-\x{1F8FF}\x{1F900}-\x{1F9FF}\x{1FA00}-\x{1FA6F}\x{1FA70}-\x{1FAFF}\x{2600}-\x{26FF}\x{2700}-\x{27BF}\x{2B50}\x{231A}-\x{231B}\x{23E9}-\x{23EC}\x{23F0}\x{23F3}]/u';
        return preg_replace($regex, '', $string);
    }

    /**
     * Extrae encabezados H2 y H3 para construir una tabla de navegación.
     */
    private function extractTableOfContents(string $markdown): array
    {
        $toc = [];
        $lines = preg_split('/\R/', $markdown);

        foreach ($lines as $line) {
            if (preg_match('/^(#{2,3})\s+(.+)$/', trim($line), $matches)) {
                $level = strlen($matches[1]);
                $title = trim($matches[2]);
                $slug = 'sec-' . substr(md5($title), 0, 8);
                $toc[] = [
                    'level' => $level,
                    'title' => $title,
                    'slug' => $slug,
                ];
            }
        }

        return $toc;
    }

    /**
     * Transforma texto Markdown estructurado a HTML semántico de alta calidad.
     */
    private function renderMarkdownToHtml(string $markdown): string
    {
        $lines = preg_split('/\R/', $markdown);
        $html = '';
        $inList = false;
        $listType = 'ul';
        $inTable = false;
        $tableHeaderParsed = false;
        $inCodeBlock = false;
        $codeLang = '';
        $codeContent = '';

        foreach ($lines as $rawLine) {
            $line = rtrim($rawLine);

            // 1. Manejo de Bloques de Código Fenced (```)
            if (preg_match('/^```([a-zA-Z0-9_-]*)/', trim($line), $codeMatch)) {
                if (!$inCodeBlock) {
                    $this->closeActiveBlocks($html, $inList, $inTable, $tableHeaderParsed);
                    $inCodeBlock = true;
                    $codeLang = strtoupper($codeMatch[1] ?: 'TEXT');
                    $codeContent = '';
                    continue;
                } else {
                    $inCodeBlock = false;
                    $escapedCode = htmlspecialchars($codeContent, ENT_QUOTES, 'UTF-8');
                    $html .= "<div class=\"doc-code-block\"><div class=\"doc-code-header\"><span class=\"doc-code-lang\"><i class=\"fa-solid fa-code\"></i> {$codeLang}</span><button type=\"button\" class=\"doc-copy-btn\" onclick=\"copyCodeToClipboard(this)\"><i class=\"fa-regular fa-copy\"></i> Copiar</button></div><pre><code>{$escapedCode}</code></pre></div>\n";
                    continue;
                }
            }

            if ($inCodeBlock) {
                $codeContent .= ($codeContent === '' ? '' : "\n") . $rawLine;
                continue;
            }

            // Línea vacía: cerrar listas o tablas si estaban activas
            if (trim($line) === '') {
                $this->closeActiveBlocks($html, $inList, $inTable, $tableHeaderParsed);
                continue;
            }

            // 2. Tablas Markdown (| col | col |)
            if (str_starts_with(trim($line), '|')) {
                // Verificar si es la fila separadora (| :--- | :--- |)
                if (preg_match('/^\|(?:\s*:?-+:?\s*\|)+$/', trim($line))) {
                    $tableHeaderParsed = true;
                    continue;
                }

                $cells = array_values(array_filter(array_map('trim', explode('|', trim($line))), function ($v) {
                    return $v !== '';
                }));

                if (!$inTable) {
                    $this->closeActiveBlocks($html, $inList, $inTable, $tableHeaderParsed);
                    $inTable = true;
                    $tableHeaderParsed = false;
                    $html .= "<div class=\"doc-table-container\"><table class=\"doc-table\"><thead><tr>";
                    foreach ($cells as $cell) {
                        $html .= "<th>" . $this->formatInline($cell) . "</th>";
                    }
                    $html .= "</tr></thead><tbody>\n";
                    continue;
                } else {
                    $html .= "<tr>";
                    foreach ($cells as $cell) {
                        $html .= "<td>" . $this->formatInline($cell) . "</td>";
                    }
                    $html .= "</tr>\n";
                    continue;
                }
            } else if ($inTable) {
                $html .= "</tbody></table></div>\n";
                $inTable = false;
                $tableHeaderParsed = false;
            }

            // 3. Encabezados (H1, H2, H3, H4)
            if (preg_match('/^(#{1,4})\s+(.+)$/', trim($line), $matches)) {
                $this->closeActiveBlocks($html, $inList, $inTable, $tableHeaderParsed);
                $level = strlen($matches[1]);
                $title = trim($matches[2]);
                $slug = 'sec-' . substr(md5($title), 0, 8);
                $inlineTitle = $this->formatInline($title);

                if ($level === 1) {
                    $html .= "<div class=\"doc-header-banner\"><h1 id=\"{$slug}\" class=\"doc-h1\">{$inlineTitle}</h1><div class=\"doc-meta-badge\"><i class=\"fa-solid fa-certificate\"></i> Documentación Oficial Certificada</div></div>\n";
                } elseif ($level === 2) {
                    $html .= "<h2 id=\"{$slug}\" class=\"doc-h2\"><span class=\"doc-h2-indicator\"></span>{$inlineTitle}</h2>\n";
                } elseif ($level === 3) {
                    $html .= "<h3 id=\"{$slug}\" class=\"doc-h3\"><i class=\"fa-solid fa-angle-right doc-h3-arrow\"></i> {$inlineTitle}</h3>\n";
                } else {
                    $html .= "<h4 class=\"doc-h4\">{$inlineTitle}</h4>\n";
                }
                continue;
            }

            // 4. Citas y Llamadas de Atención (> o > [!TIP])
            if (str_starts_with(trim($line), '>')) {
                $this->closeActiveBlocks($html, $inList, $inTable, $tableHeaderParsed);
                $calloutText = trim(substr(trim($line), 1));
                
                $type = 'info';
                $icon = 'fa-circle-info';
                $label = 'NOTA TÉCNICA';

                if (preg_match('/^\[!(TIP|NOTE|IMPORTANT|WARNING|CAUTION)\]/i', $calloutText, $cm)) {
                    $tag = strtoupper($cm[1]);
                    $calloutText = trim(preg_replace('/^\[!' . $tag . '\]/i', '', $calloutText));
                    if ($tag === 'TIP') {
                        $type = 'tip';
                        $icon = 'fa-lightbulb';
                        $label = 'RECOMENDACIÓN';
                    } elseif ($tag === 'IMPORTANT' || $tag === 'WARNING') {
                        $type = 'warning';
                        $icon = 'fa-triangle-exclamation';
                        $label = 'IMPORTANTE';
                    } elseif ($tag === 'CAUTION') {
                        $type = 'danger';
                        $icon = 'fa-shield-halved';
                        $label = 'PRECAUCIÓN';
                    }
                }

                $html .= "<div class=\"doc-callout doc-callout-{$type}\"><div class=\"doc-callout-badge\"><i class=\"fa-solid {$icon}\"></i> {$label}</div><div class=\"doc-callout-content\">" . $this->formatInline($calloutText) . "</div></div>\n";
                continue;
            }

            // 5. Separadores Horizontales (--- o ===)
            if (preg_match('/^[-=_]{3,}$/', trim($line))) {
                $this->closeActiveBlocks($html, $inList, $inTable, $tableHeaderParsed);
                $html .= "<hr class=\"doc-divider\">\n";
                continue;
            }

            // 6. Listas no ordenadas (- o *)
            if (preg_match('/^[-*]\s+(.+)$/', trim($line), $matches)) {
                if (!$inList || $listType !== 'ul') {
                    $this->closeActiveBlocks($html, $inList, $inTable, $tableHeaderParsed);
                    $html .= "<ul class=\"doc-list\">\n";
                    $inList = true;
                    $listType = 'ul';
                }
                $html .= "<li>" . $this->formatInline($matches[1]) . "</li>\n";
                continue;
            }

            // 7. Listas numeradas (1. 2. 3.)
            if (preg_match('/^\d+\.\s+(.+)$/', trim($line), $matches)) {
                if (!$inList || $listType !== 'ol') {
                    $this->closeActiveBlocks($html, $inList, $inTable, $tableHeaderParsed);
                    $html .= "<ol class=\"doc-ordered-list\">\n";
                    $inList = true;
                    $listType = 'ol';
                }
                $html .= "<li>" . $this->formatInline($matches[1]) . "</li>\n";
                continue;
            }

            // 8. Párrafo normal
            $this->closeActiveBlocks($html, $inList, $inTable, $tableHeaderParsed);
            $html .= "<p class=\"doc-paragraph\">" . $this->formatInline($line) . "</p>\n";
        }

        $this->closeActiveBlocks($html, $inList, $inTable, $tableHeaderParsed);
        return $html;
    }

    private function closeActiveBlocks(string &$html, bool &$inList, bool &$inTable, bool &$tableHeaderParsed): void
    {
        if ($inList) {
            $html .= "</ul>\n";
            $inList = false;
        }
        if ($inTable) {
            $html .= "</tbody></table></div>\n";
            $inTable = false;
            $tableHeaderParsed = false;
        }
    }

    /**
     * Aplica formato en línea a negritas, código, enlaces y cursivas.
     */
    private function formatInline(string $text): string
    {
        $text = htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
        // Código inline `codigo`
        $text = preg_replace('/`([^`]+)`/', '<code class="doc-inline-code">$1</code>', $text);
        // Negritas **texto**
        $text = preg_replace('/\*\*(.+?)\*\*/', '<strong>$1</strong>', $text);
        // Cursivas *texto*
        $text = preg_replace('/\*([^*]+)\*/', '<em>$1</em>', $text);
        // Enlaces [texto](url)
        $text = preg_replace('/\[(.*?)\]\((.*?)\)/', '<a href="$2" target="_blank" class="doc-link">$1 <i class="fa-solid fa-arrow-up-right-from-square doc-ext-icon"></i></a>', $text);

        return $text;
    }
}
