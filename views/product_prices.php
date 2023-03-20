<div class="product-prices">
    <p class="newprice">
        <?php echo $product['nieuweprijs']; ?>
    </p>
    <p class="previousprice">
        <?php
        if ($product['vorigeprijs'] !== null && !is_null($product['vorigeprijs']) && ($product['vorigeprijs'] > $product['nieuweprijs'])) {
            echo $product['vorigeprijs'];
        }
        ?>
    </p>
</div>