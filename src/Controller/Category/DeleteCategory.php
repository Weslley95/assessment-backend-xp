<?php

namespace Webjump\Desafio\Controller\Category;

use \Webjump\Desafio\Controller\InterfaceControllerRequest;
use Webjump\Desafio\Infrastructure\Persistence\Connection;
use Webjump\Desafio\Infrastructure\Repository\PdoCategoryRepository;

/**
 * Class for delete product
 */
class DeleteCategory implements InterfaceControllerRequest {
    
    public function processRequest():void {
       
        $connection = Connection::createConnection();
        $productRepository = new PdoCategoryRepository($connection);

        $connection->beginTransaction();
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        
        if(is_null($id) || $id === false) {
            header('Location: /categories');
            return;
        }
            
        $productRepository->removeCategory($id);
        $connection->commit();
        header('Location: /categories');
    }
}
