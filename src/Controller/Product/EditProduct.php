<?php

namespace Webjump\Desafio\Controller\Product;

use Webjump\Desafio\Model\Product;
use \Webjump\Desafio\Controller\InterfaceControllerRequest;
use Webjump\Desafio\Infrastructure\Persistence\Connection;
use Webjump\Desafio\Infrastructure\Repository\PdoProductRepository;
use Webjump\Desafio\Infrastructure\Repository\PdoCategoryRepository;
use Webjump\Desafio\Controller\ControllerHtml;

/**
 * Get page for editing category
 */
class EditProduct extends ControllerHtml implements InterfaceControllerRequest {
    
    /**
     * 
     * @return void
     */
    public function processRequest():void {
       
        $connection = Connection::createConnection();
        $productRepository = new PdoProductRepository($connection);
        $categoryRepository = new PdoCategoryRepository($connection);

        $connection->beginTransaction();
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
            
        $productData = $productRepository->getProduct($id);
        $categories = $categoryRepository->allCategories($id);
        
        foreach($productData as $product => $value) {
            $product = new Product(
                    $value['id'],
                    $value['name'],
                    $value['sku'],
                    $value['price'],
                    $value['description'],
                    $value['quantity'],
                    $value['category']
            );
        }

        echo $this->rendererHtml('product/addProduct.php' , [
            'titlePage' => 'Webjump | Backend Test | Products',
            'titleHeader' => 'Administration Panel',
            'product' => $product,
            'categories' => $categories
        ]);
    }
}
