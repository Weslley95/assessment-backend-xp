<?php

namespace Webjump\Desafio\Model;

/**
 * Class model product
 */
class Product {

    private $id;
    private $name;
    private $sku;
    private $price;
    private $description;
    private $quantity;
    private $category;

    public function __construct(?int $id, string $name, string $sku, string $price, string $description, int $quantity, ?string $category) {
        $this->id = $id;
        $this->name = $name;
        $this->sku = $sku;
        $this->price = $price;
        $this->description = $description;
        $this->quantity = $quantity;
        $this->category = $category;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getSku(): string {
        return $this->sku;
    }

    public function getPrice(): string {
        return $this->price;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function getQuantity(): int {
        return $this->quantity;
    }

    public function getCategory(): ?string {
        return $this->category;
    }

    public function setId($id): void {
        $this->id = $id;
    }

}
