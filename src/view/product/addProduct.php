<?php
include_once(__DIR__ . '/../template/head-standart.php');
?>

<!-- Header -->
<!-- Main Content -->
<main class="content">
    <h1 class="title new-item">New Product</h1>


    <form action="/save-product<?= isset($product) ? '?id=' . $product->getId() : ''; ?>" method="POST" >
        <div class="input-field">
            <label for="sku" class="label">Product SKU</label>
            <input type="text" id="sku" name="sku" class="input-text" value="<?= isset($product) ? $product->getSku() : ''; ?>"/> 
        </div>
        <div class="input-field">
            <label for="name" class="label">Product Name</label>
            <input type="text" id="name" name="name" class="input-text" value="<?= isset($product) ? $product->getName() : ''; ?>"/>
        </div>
        <div class="input-field">
            <label for="price" class="label">Price</label>
            <input type="text" id="price" name="price" class="input-text" value="<?= isset($product) ? $product->getPrice() : ''; ?>"/>
        </div>
        <div class="input-field">
            <label for="quantity" class="label">Quantity</label>
            <input type="text" id="quantity" name="quantity" class="input-text" value="<?= isset($product) ? $product->getQuantity() : ''; ?>"/>
        </div>

        <div class="input-field">
            <label for="category" class="label">Categories</label>
            <select multiple id="category" name="category" class="input-text">
                <?php foreach ($categories as $category): ?>
                    
                <option><?= $category['name'] ?></option>
                    
                <?php endforeach; ?>
            </select>
            
        </div>
        <div class="input-field">
            <label for="description" class="label" >Description</label>
            <textarea id="description" name="description" class="input-text"><?= isset($product) ? $product->getDescription() : ''; ?></textarea>
        </div>
        <div class="actions-form">
            <a href="/products" class="action back">Back</a>
            <input class="btn-submit btn-action" type="submit" name="submit" value="<?= isset($product) ? 'edit-product' : 'save-product'; ?>"/>
        </div>

    </form>
</main>
<!-- Main Content -->

<!-- Footer -->
<?php
include(__DIR__ . '/../template/footer-standart.php');