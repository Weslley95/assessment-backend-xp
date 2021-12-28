<?php

namespace Webjump\Desafio\Controller\Category;

use Webjump\Desafio\Controller\InterfaceControllerRequest;
use Webjump\Desafio\Controller\ControllerHtml;

/**
 * Get page add category
 */
class AddCategory extends ControllerHtml implements InterfaceControllerRequest {
    
    public function processRequest(): void {
        $titlePage = 'Webjump | Backend Test | Categories';
        $titleHeader = 'Administration Panel';
        
        echo $this->rendererHtml('category/addCategory.php' , [
            'titlePage' => $titlePage,
            'titleHeader' => $titleHeader
        ]);
    }
}
