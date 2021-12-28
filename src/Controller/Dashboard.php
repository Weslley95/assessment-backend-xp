<?php

namespace Webjump\Desafio\Controller;

use Webjump\Desafio\Controller\ControllerHtml;

/**
 * Get page dashboard
 *
 */
class Dashboard extends ControllerHtml implements InterfaceControllerRequest {
    
    public function processRequest(): void {
        
         echo $this->rendererHtml('dashboard/dashboard.php' , [
            'titlePage' => 'Webjump | Backend Test | Dashboard',
            'titleHeader' => 'Administration Panel'
        ]);
    }
}
