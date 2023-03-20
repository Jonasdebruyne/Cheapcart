<?php foreach ($searchproducts as $product): ?>
    <div class="product">
        <div class="product-image">
            <img src="<?php echo $product['productfoto']; ?>" alt="productimage">
        </div>
        <div class="product-info">
            <p class="productname">
                <?php echo $product['productnaam']; ?>
            </p>
            <p class="product-price">voor
                <?php echo $product['nieuweprijs']; ?>
            </p>
            <p class="product-store">
                <?php echo $product['winkelketen']; ?>
            </p>
            <?php require("./views/product_prices.php");?>
        </div>
        <?php require("./views/addcart.php");?>
    </div>
<?php endforeach; ?>