<?php

namespace Webjump\Desafio\Controller\Product;

use \Webjump\Desafio\Controller\InterfaceControllerRequest;
use Webjump\Desafio\Infrastructure\Persistence\Connection;
use Webjump\Desafio\Infrastructure\Repository\PdoProductRepository;

/**
 * Class for delete product
 */
class DeleteProduct implements InterfaceControllerRequest {
    
    public function processRequest():void {
       
        $connection = Connection::createConnection();
        $productRepository = new PdoProductRepository($connection);

        $connection->beginTransaction();
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        
        if(is_null($id) || $id === false) {
            header('Location: /products');
            return;
        }
            
        $productRepository->removeProduct($id);
        $connection->commit();
        header('Location: /products');
    }
}
