<?php

namespace Webjump\Desafio\Controller\Category;

use Webjump\Desafio\Controller\InterfaceControllerRequest;
use Webjump\Desafio\Model\Category;
use Webjump\Desafio\Infrastructure\Persistence\Connection;
use Webjump\Desafio\Infrastructure\Repository\PdoCategoryRepository;
use \Webjump\Desafio\Infrastructure\Persistence\Table;

/**
 * Process data for data base
 */
class PersistenceCategory implements InterfaceControllerRequest {
    
    public function __construct() {
        Table::createTable();
    }
    
    public function processRequest():void {
       
        $connection = Connection::createConnection();
        $categoryRepository = new PdoCategoryRepository($connection);

        $connection->beginTransaction();
        $name = filter_input(INPUT_POST, 'category-name');
        $code = filter_input(INPUT_POST, 'category-code');
        
        if($typeSubmit == 'save-category') {
            $id = null;
        } else if($typeSubmit == 'edit-category') {
            $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        }
        
        try{
            $aCategory = new Category($id, $name, $code);
            $categoryRepository->saveCategory($aCategory);
            $connection->commit();

        } catch(PDOException $e) {
            echo $e->getMessage();
            $connection->rollBack();
        }
        
        header('Location: /categories');
    }
}
