<?php
    session_start();
    if (isset($_SESSION['email'])){
        // user is logged in
        // echo "Welcome " . $_SESSION['firstname'];
    } else{
        // user is not logged in
        header("location: login.php");
        // veiligheid : )
        die;
    }

    include_once(__DIR__ . "/classes/Product.php");

    if(!empty($_POST)){
        try{
            $product = new Product();
            $product->setProductnaam($_POST['productnaam']);
            $product->setCategorie($_POST['categorie']);
            $product->setSubcategorie($_POST['subcategorie']);
            $product->setWinkelketen($_POST['winkelketen']);
            $product->setVorigeprijs($_POST['vorigeprijs']);
            $product->setNieuweprijs($_POST['nieuweprijs']);

            $product->save();
            $success = "User saved!";


        } catch (\Throwable $th){
            $error = $th->getMessage();
        }
    }
    
    $bierenEnAperitieven = Product::getAllBierenEnAperitievenInDiscount();
    $groentenEnFruit = Product::getAllGroenteEnFruitInDiscount();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cheapcart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="normalize.css">
    <link rel="stylesheet" href="style.css">
</head>
<body data-uid="<?php echo $_SESSION['userid']; ?>">
    <?php
        $page = "Acties";
        require_once("./views/menu_top.php"); 
    ?>
    <div class="content">
        <section>
            <h1>Bier en aperitieven</h1>
            <?php foreach($bierenEnAperitieven as $product):?>
                <div class="product">
                    <div class="product-image">
                        <img src="<?php echo $product['productfoto']; ?>" alt="productimage">
                    </div>
                    <div class="product-info">
                        <p class="productname"><?php echo $product['productnaam']; ?></p>
                        <p class="product-price">voor <?php echo $product['nieuweprijs']; ?></p>
                        <div>
                            <p class="productbeschrijving">
                                <?php echo $product['beschrijving']; ?>                                    
                            </p>
                            <p class="product-store"><?php echo $product['winkelketen']; ?></p>
                        </div>                        
                        <?php require("./views/product_prices.php");?>
                    </div>
                    <div class="add-product">
                        <img src="assets/images/plus-circle.png" alt="addproduct">
                    </div>
                </div>
            <?php endforeach; ?>
        </section>
        <section>
            <h1>Groenten en fruit</h1>
            <?php foreach($groentenEnFruit as $product):?>
                <div class="product">
                    <div class="product-image">
                        <img src="<?php echo $product['productfoto']; ?>" alt="productimage">
                    </div>
                    <div class="product-info">
                        <p class="productname"><?php echo $product['productnaam']; ?></p>
                        <p class="product-price">voor <?php echo $product['nieuweprijs']; ?></p>
                        <div>
                            <p class="productbeschrijving">
                                <?php echo $product['beschrijving']; ?>                                    
                            </p>
                            <p class="product-store"><?php echo $product['winkelketen']; ?></p>
                        </div>
                        <?php require("./views/product_prices.php");?>
                    </div>
                    <?php require("./views/addcart.php");?>
                </div>
            <?php endforeach; ?>
        </section>
        
    </div>
    <?php require_once("./views/menu_bottom.php");?>
</body>
</html>