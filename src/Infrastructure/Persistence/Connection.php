<?php

namespace Webjump\Desafio\Infrastructure\Persistence;

use PDO;

/**
 * Connection to PDO database
 *
 * @return result connection PDO
 */
class Connection {
    
    public static function createConnection(): PDO {
        
        $dirh = __DIR__ . '/../../../db.sqlite';
        $pdo = new PDO('sqlite:' . $dirh);
        
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                
        return $pdo;
    }
}
