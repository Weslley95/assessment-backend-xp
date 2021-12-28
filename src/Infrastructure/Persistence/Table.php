<?php

namespace Webjump\Desafio\Infrastructure\Persistence;

use Webjump\Desafio\Infrastructure\Persistence\Connection;

/**
 * Class to create the necessary tables
 *
 * @return PDO
 */
class Table {
    
    public static function createTable() {
        
        $pdo = Connection::createConnection();
        
        $createTable = '
            CREATE TABLE IF NOT EXISTS category (
                id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                name TEXT,
                code TEXT
            );
            CREATE TABLE IF NOT EXISTS product (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name TEXT,
                sku TEXT,
                price TEXT,
                description TEXT,
                quantity INTEGER,
                category TEXT
          );';

        return $pdo->exec($createTable);    
    }
}
