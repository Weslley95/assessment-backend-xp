<?php

namespace Webjump\Desafio\Model;

use DomainException;

/**
 * * Class model category
 */
class Category {
    
    private $id;
    private $code;
    private $name;
    
    public function __construct(?int $id, string $name, string $code) {
        $this->id = $id;
        $this->code = $code;
        $this->name = $name;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getCode(): string {
        return $this->code;
    }

    public function getName():  string {
        return $this->name;
    }

    public function setId($id): void {
        $this->id = $id;
    }
}