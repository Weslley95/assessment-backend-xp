<?php

namespace Webjump\Desafio\Controller\Category;

use Webjump\Desafio\Model\Category;
use \Webjump\Desafio\Controller\InterfaceControllerRequest;
use Webjump\Desafio\Infrastructure\Persistence\Connection;
use Webjump\Desafio\Infrastructure\Repository\PdoCategoryRepository;
use Webjump\Desafio\Controller\ControllerHtml;

/**
 * Get page for editing category
 */
class EditCategory extends ControllerHtml implements InterfaceControllerRequest {
    
    /**
     * 
     * @return void
     */
    public function processRequest():void {
       
        $connection = Connection::createConnection();
        $categoryRepository = new PdoCategoryRepository($connection);

        $connection->beginTransaction();
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
            
        $categoryData = $categoryRepository->getCategory($id);
        
        foreach($categoryData as $category => $value) {
            $category = new Category(
                    $value['id'],
                    $value['name'],
                    $value['code']
            );
        }
        
        echo $this->rendererHtml('category/addCategory.php' , [
            'titlePage' => 'Webjump | Backend Test | Category',
            'titleHeader' => 'Administration Panel',
            'category' => $category
        ]);
    }
}
