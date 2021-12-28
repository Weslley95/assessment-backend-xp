<?php include_once(__DIR__ . '/../template/head-standart.php'); ?>

<!-- Main Content -->
<main class="content">
    <h1 class="title new-item">New Category</h1>

    <form action="/save-category<?= isset($category) ? '?id=' . $category->getId() : ''; ?>" method="POST" >
        <div class="input-field">
            <label for="category-name" class="label">Category Name</label>
            <input type="text" id="category-name" name="category-name" class="input-text" value="<?= isset($category) ? $category->getName() : ''; ?>"/>
        </div>
        <div class="input-field">
            <label for="category-code" class="label">Category Code</label>
            <input type="text" id="category-code" name="category-code" class="input-text" value="<?= isset($category) ? $category->getCode() : ''; ?>" />

        </div>
        <div class="actions-form">
            <a href="categories" class="action back">Back</a>
            
            <input class="btn-submit btn-action" type="submit" name="submit" value="<?= isset($category) ? 'edit-category' : 'save-category'; ?>"/>
        </div>
    </form>
</main>
<!-- Main Content -->

<!-- Footer -->
<?php
include(__DIR__ . '/../template/footer-standart.php');
