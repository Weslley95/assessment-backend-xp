<?php

namespace Webjump\Desafio\Infrastructure\Repository;

use PDO;
use PDOStatement;
use RuntimeException;
use Webjump\Desafio\Model\Product;

/**
 * CategoryRepository Interface Implementation
 *
 */
class PdoProductRepository {
    
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
     * Get all products
     * 
     * @return array
     */
    public function getProduct($id): array {
        $sql = $this->connection->query("SELECT * FROM product WHERE id = $id");
        $productData = $sql->fetchAll(PDO::FETCH_ASSOC);
        
        return $productData;
    }
    
    /**
     * Remove product
     * 
     * @return bool
     */
    public function removeProduct($id): bool {
        $stmt = $this->connection->prepare('DELETE FROM product WHERE id = :id;');
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        
        return $stmt->execute();
    }
    
    /**
     * Save product
     * 
     * @return bool
     */
    public function saveProduct(Product $product): bool {
        if($product->getId() === null) {
            return $this->insertProduct($product);
        }
        
        return $this->updateProduct($product);
    }
    
    public function insertProduct(Product $product): bool {
        $sql = 'INSERT INTO product (name, sku, price, description, quantity, category) '
                . 'VALUES (:name, :sku, :price, :description, :quantity, :category);';
        
        $stmt = $this->connection->prepare($sql);
        
        if($stmt === false) {
            $error = $this->connection->errorInfo()[2];
            throw new RuntimeException("$error");
        }

        $result = $stmt->execute([
            ':name' => $product->getName(),
            ':sku' => $product->getSku(),
            ':price' => $product->getPrice(),
            ':description' => $product->getDescription(),
            ':quantity' => $product->getQuantity(),
            ':category' => $product->getCategory()
        ]);
        
        if($result) {
            // Get Id from the last insert
            $product->setId($this->connection->lastInsertId());
            $this->insertId($product);
        }
        
        return  $result;
    }
    
    /**
     * Update  product
     * 
     * @param Product $product
     * @return bool
     */
    public function updateProduct(Product $product): bool {
        $sql = 'UPDATE product SET '
                . 'name = :name, sku = :sku, price = :price, description = :description, quantity = :quantity, category = :category WHERE id = :id;';
        
        $stmt = $this->connection->prepare($sql);
        
        // Insert values
        $stmt->bindValue(':name', $product->getName());
        $stmt->bindValue(':sku', $product->getSku());
        $stmt->bindValue(':price', $product->getPrice());
        $stmt->bindValue(':description', $product->getDescription());
        $stmt->bindValue(':quantity', $product->getQuantity());
        $stmt->bindValue(':category', $product->getCategory());
        $stmt->bindValue(':id', $product->getId(), PDO::PARAM_INT);
        
        return $stmt->execute();
    }
    
    /**
     * Data processing
     * 
     * @param PDOStatement $stmt
     * @return array
     */
    public function hydrateProductList(PDOStatement $stmt): array {
        $productData = $stmt->fetchAll();
        $productList = array();
        
        foreach ($productData as $product) {
            $productList[] = new Category(
                    $product['id'],
                    $product['name'],
                    $product['sku'],
                    $product['price'],
                    $product['quantity'],
                    $product['category'],
            );
        }
        
        return $productList;
    }
    
    /**
     * Insert id in for product
     * 
     * @param Product $product
     * @return void
     */
    public function insertId(Product $product): void{
        $sql = 'UPDATE product SET id = :id  WHERE name = :name AND sku = :sku;';
        $stmt = $this->connection->prepare($sql);
        
        // Insert ID
        $stmt->bindValue(':name', $product->getName());
        $stmt->bindValue(':sku', $product->getSku());
        $stmt->bindValue(':id', $product->getId());
        $stmt->execute();
    }
}