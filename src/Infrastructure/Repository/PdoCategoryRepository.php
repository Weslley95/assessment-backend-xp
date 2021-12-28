<?php

namespace Webjump\Desafio\Infrastructure\Repository;

use PDO;
use PDOStatement;
use RuntimeException;
use Webjump\Desafio\Model\Category;

/**
 * CategoryRepository Interface Implementation
 *
 */
class PdoCategoryRepository {
    
    /**
     * Connection PDO
     */
    private PDO $connection;
    
    /**
     * Dependency injection
     * 
     * @param PDO $connection
     */
    public function __construct(PDO $connection) {
        $this->connection = $connection;
    }
    
    /**
     * Get all categories
     * 
     * @return array
     */
    public function allCategories(): array {
        $sql = $this->connection->query('SELECT * FROM category');
        $categories = $sql->fetchAll(PDO::FETCH_ASSOC);
        
        return $categories;
    }
    
    /**
     * Get current field
     * 
     * @return array
     */
    public function getCategory($id): array {
        $sql = $this->connection->query("SELECT * FROM category WHERE id = $id");
        $fieldData = $sql->fetchAll(PDO::FETCH_ASSOC);
        
        return $fieldData;
    }
    
    /**
     * Remove category
     * 
     * @return bool
     */
    public function removeCategory($id): bool {
        $stmt = $this->connection->prepare('DELETE FROM category WHERE id = :id;');
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        
        return $stmt->execute();
    }
    
    /**
     * Save category
     * 
     * @return bool
     */
    public function saveCategory(Category $category): bool {
        if($category->getId() === null) {
            return $this->insertCategory($category);
        }
        
        return $this->updateCategory($category);
    }
    
    public function insertCategory(Category $category): bool {
        $sql = 'INSERT INTO category (id, name, code) VALUES (null, :name, :code);';
        $stmt = $this->connection->prepare($sql);
        
        if($stmt === false) {
            $error = $this->connection->errorInfo()[2];
            throw new RuntimeException("$error");
        }

        $result = $stmt->execute([
            ':name' => $category->getName(),
            ':code' => $category->getCode()
        ]);
        
        if($result) {
            // Get Id from the last insert
            $category->setId($this->connection->lastInsertId());
            $this->insertId($category);
        }
        
        return  $result;
    }
    
    /**
     * Update category
     * 
     * @param Category $category
     * @return bool
     */
    public function updateCategory(Category $category): bool {
        $sql = 'UPDATE category SET name = :name, code = :code WHERE id = :id;';
        $stmt = $this->connection->prepare($sql);
        
        // Insert values
        $stmt->bindValue(':name', $category->getName());
        $stmt->bindValue(':code', $category->getCode());
        $stmt->bindValue(':id', $category->getId(), PDO::PARAM_INT);
        
        return $stmt->execute();
    }
    
    /**
     * Data processing
     * 
     * @param PDOStatement $stmt
     * @return array
     */
    public function hydrateCategoryList(PDOStatement $stmt): array {
        $categoryData = $stmt->fetchAll();
        $categoryList = array();
        
        foreach ($categoryData as $category) {
            $categoryList[] = new Category(
                    $category['id'],
                    $category['name'],
                    $category['code'],
            );
        }
        
        return $categoryList;
    }
    
    /**
     * Insert id in for category
     * 
     * @param Category $category
     * @return void
     */
    public function insertId(Category $category): void{
        $sql = 'UPDATE category SET id = :id  WHERE name = :name AND code = :code;';
        $stmt = $this->connection->prepare($sql);
        
        // Insert ID
        $stmt->bindValue(':name', $category->getName());
        $stmt->bindValue(':code', $category->getCode());
        $stmt->bindValue(':id', $category->getId());
        $stmt->execute();
    }
}
