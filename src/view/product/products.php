<?php

use Webjump\Desafio\Infrastructure\Persistence\Connection;

include_once(__DIR__ . '/../template/head-standart.php');
require_once(__DIR__ . '/../../../vendor/autoload.php');

$pdo = Connection::createConnection();

$sql = $pdo->query('SELECT * FROM product');
$products = $sql->fetchAll(PDO::FETCH_ASSOC);
?>

<body>
    <!-- Main Content -->
    <main class="content">
        <div class="header-list-page">
            <h1 class="title">Products</h1>
            <a href="/addProduct" class="btn-action">Add new Product</a>
        </div>
        <table class="data-grid">
            <tr class="data-row">
                <th class="data-grid-th">
                    <span class="data-grid-cell-content">Id</span>
                </th>
                <th class="data-grid-th">
                    <span class="data-grid-cell-content">Name</span>
                </th>
                <th class="data-grid-th">
                    <span class="data-grid-cell-content">SKU</span>
                </th>
                <th class="data-grid-th">
                    <span class="data-grid-cell-content">Price</span>
                </th>
                <th class="data-grid-th">
                    <span class="data-grid-cell-content">Quantity</span>
                </th>
                <th class="data-grid-th">
                    <span class="data-grid-cell-content">Categories</span>
                </th>

                <th class="data-grid-th">
                    <span class="data-grid-cell-content">Actions</span>
                </th>
            </tr>


            <tr class="data-row">
                <td class="data-grid-td">
                    <span class="data-grid-cell-content">0</span>
                </td>

                <td class="data-grid-td">
                    <span class="data-grid-cell-content">Product 1 Name</span>
                </td>

                <td class="data-grid-td">
                    <span class="data-grid-cell-content">SKU1</span>
                </td>

                <td class="data-grid-td">
                    <span class="data-grid-cell-content">R$ 19,90</span>
                </td>

                <td class="data-grid-td">
                    <span class="data-grid-cell-content">100</span>
                </td>

                <td class="data-grid-td">
                    <span class="data-grid-cell-content">Category 1 <Br />Category 2</span>
                </td>

                <td class="data-grid-td">
                    <div class="actions">
                        <div class="action edit"><span>Edit</span></div>
                        <div class="action delete"><span>Delete</span></div>
                    </div>
                </td>
            </tr>

            <?php foreach ($products as $product): ?>
                <tr class="data-row">
                    <td class="data-grid-td">
                        <span class="data-grid-cell-content"><?= $product['id']; ?></span>
                    </td>

                    <td class="data-grid-td">
                        <span class="data-grid-cell-content"><?= $product['name']; ?></span>
                    </td>

                    <td class="data-grid-td">
                        <span class="data-grid-cell-content"><?= $product['sku'] ?></span>
                    </td>

                    <td class="data-grid-td">
                        <span class="data-grid-cell-content">R$ <?= $product['price'] ?></span>
                    </td>

                    <td class="data-grid-td">
                        <span class="data-grid-cell-content"><?= $product['quantity'] ?></span>
                    </td>

                    <td class="data-grid-td">
                        <span class="data-grid-cell-content"><?= $product['category'] ?></span>
                    </td>

                    <td class="data-grid-td">
                        <div class="actions">
                            <div class="action edit"><span><a href="/edit-product?id=<?= $product['id']; ?>">Edit</a></span></div>
                            <div class="action delete"><span><a href="/delete-product?id=<?= $product['id']; ?>">Delete</a></span></div>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </main>
    <!-- Main Content -->

    <!-- Footer -->
    <?php
    include(__DIR__ . '/../template/footer-standart.php');
    