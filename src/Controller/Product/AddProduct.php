<?php

namespace Webjump\Desafio\Controller\Product;

use Webjump\Desafio\Controller\InterfaceControllerRequest;
use Webjump\Desafio\Controller\ControllerHtml;
use Webjump\Desafio\Infrastructure\Persistence\Connection;
use Webjump\Desafio\Infrastructure\Repository\PdoCategoryRepository;

/**
 * Get page add product
 */
class AddProduct extends ControllerHtml implements InterfaceControllerRequest {
    
    public function processRequest(): void {
        
        $connection = Connection::createConnection();
        $categoryRepository = new PdoCategoryRepository($connection);
        $categories = $categoryRepository->allCategories();
        
        echo $this->rendererHtml('product/addProduct.php' , [
            'titlePage' => 'Webjump | Backend Test | Products',
            'titleHeader' => 'Administration Panel',
            'categories' => $categories
        ]);
    }
}
