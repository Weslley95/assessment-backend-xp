<?php include_once(__DIR__ . '/../template/head-standart.php'); ?>

<!-- Main Content -->
<main class="content">
    <div class="header-list-page">
        <h1 class="title">Categories</h1>
        <a href="addCategory" class="btn-action">Add new Category</a>
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
                <span class="data-grid-cell-content">Code</span>
            </th>
            <th class="data-grid-th">
                <span class="data-grid-cell-content">Actions</span>
            </th>
        </tr>

        <?php foreach ($categories as $category): ?>
            <tr class="data-row">
                <td class="data-grid-td">
                    <span class="data-grid-cell-content"><?= $category['id'] ?></span>
                </td>

                <td class="data-grid-td">
                    <span class="data-grid-cell-content"><?= $category['name'] ?></span>
                </td>

                <td class="data-grid-td">
                    <span class="data-grid-cell-content"><?= $category['code'] ?></span>
                </td>
                <td class="data-grid-td">
                    <div class="actions">
                        <div class="action edit"><span><a href="/edit-category?id=<?= $category['id']; ?>"> Edit</a></span></div>
                        <div class="action delete"><span><a href="/delete-category?id=<?= $category['id']; ?>"> Delete</a></span></div>
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
