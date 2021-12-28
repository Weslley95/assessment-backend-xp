<?php

namespace Webjump\Desafio\Controller\Category;

use Webjump\Desafio\Infrastructure\Persistence\Connection;
use Webjump\Desafio\Controller\InterfaceControllerRequest;
use Webjump\Desafio\Controller\ControllerHtml;
use PDO;

/**
 * Get page category
 */
class Category extends ControllerHtml implements InterfaceControllerRequest {

    public function processRequest(): void {
        
        
        $pdo = Connection::createConnection();
        
        $sql = $pdo->query('SELECT * FROM category');
        $categories = $sql->fetchAll(PDO::FETCH_ASSOC);

        echo $this->rendererHtml('category/categories.php' , [
            'titlePage' => 'Webjump | Backend Test | Categories',
            'titleHeader' => 'Administration Panel',
            'categories' => $categories
        ]);
    }
}
