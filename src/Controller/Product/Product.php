<?php

namespace Webjump\Desafio\Controller\Product;

use Webjump\Desafio\Infrastructure\Persistence\Connection;
use Webjump\Desafio\Controller\InterfaceControllerRequest;
use Webjump\Desafio\Controller\ControllerHtml;
use PDO;

/**
 * Get page product
 */
class Product extends ControllerHtml implements InterfaceControllerRequest {
    
    public function processRequest(): void {
        
        $pdo = Connection::createConnection();

        $sql = $pdo->query('SELECT * FROM product');
        $products = $sql->fetchAll(PDO::FETCH_ASSOC);
        
        echo $this->rendererHtml('product/products.php' , [
            'titlePage' => 'Webjump | Backend Test | Products',
            'titleHeader' => 'Administration Panel',
            'products' => $products
        ]);
    }
}
