<?php

/**
 * Controlles for routes
 */

use \Webjump\Desafio\Controller\Category\{Category, AddCategory, PersistenceCategory, DeleteCategory, EditCategory};
use \Webjump\Desafio\Controller\Product\{Product, AddProduct, PersistenceProduct, DeleteProduct, EditProduct};
use \Webjump\Desafio\Controller\Dashboard;

// Return routes based in class
return  [
    '/dashboard' => Dashboard::class,
    '/categories' => Category::class,
    '/addCategory' => AddCategory::class,
    '/save-category' => PersistenceCategory::class,
    '/edit-category' => EditCategory::class,
    '/delete-category' => DeleteCategory::class,
    '/products' => Product::class,
    '/addProduct' => AddProduct::class,
    '/save-product' => PersistenceProduct::class,
    '/delete-product' => DeleteProduct::class,
    '/edit-product' => EditProduct::class
];