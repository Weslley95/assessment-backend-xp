<?php

namespace Webjump\Desafio\Controller\Product;

use Webjump\Desafio\Controller\InterfaceControllerRequest;
use Webjump\Desafio\Model\Product;
use Webjump\Desafio\Infrastructure\Persistence\Connection;
use Webjump\Desafio\Infrastructure\Repository\PdoProductRepository;
use \Webjump\Desafio\Infrastructure\Persistence\Table;

/**
 * Process data for data base
 */
class PersistenceProduct implements InterfaceControllerRequest {
    
    public function __construct() {
        Table::createTable();
    }
    
    public function processRequest():void {
       
        $connection = Connection::createConnection();
        $productRepository = new PdoProductRepository($connection);

        $connection->beginTransaction();
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $sku = filter_input(INPUT_POST, 'sku', FILTER_SANITIZE_STRING);
        $price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_STRING);
        $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
        $quantity = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT);
        $category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_STRING);
        $typeSubmit = filter_input(INPUT_POST, 'submit', FILTER_SANITIZE_STRING);
        
        if($typeSubmit == 'save-product') {
            $id = null;
        } else if($typeSubmit == 'edit-product') {
            $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        }
        
        try{
            $product = new Product($id, $name, $sku, $price, $description, $quantity, $category);
            $productRepository->saveProduct($product);
            $connection->commit();
            
        } catch(PDOException $e) {
            echo $e->getMessage();
            $connection->rollBack();
        }
        
        header('Location: /products');
    }
}
