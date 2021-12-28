<?php

namespace Webjump\Desafio\Controller;

/**
 * Class for controller html
 */
abstract class ControllerHtml {
    
    /**
     * Renderer html and output buffer
     * 
     * @param string $path
     * @param array $data
     * @return string HTML
     */
    public function rendererHtml($path, $data): string {
        
        extract($data);
        
        ob_start();
        require_once(__DIR__ . '/../view/' . $path);
        $html = ob_get_clean();
        
        return $html;
    }
}
