<?php
session_start();
if (isset($_SESSION['email'])) {
    // user is logged in
    // echo "Welcome " . $_SESSION['firstname'];
} else {
    // user is not logged in
    header("location: login.php");
    // veiligheid : )
    die;
}

include_once(__DIR__ . "/classes/Product.php");

if (!empty($_POST)) {
    try {
        $product = new Product();
        $product->setProductnaam($_POST['productnaam']);
        $product->setCategorie($_POST['categorie']);
        $product->setSubcategorie($_POST['subcategorie']);
        $product->setWinkelketen($_POST['winkelketen']);
        $product->setVorigeprijs($_POST['vorigeprijs']);
        $product->setNieuweprijs($_POST['nieuweprijs']);

        $product->save();
        $success = "User saved!";


    } catch (\Throwable $th) {
        $error = $th->getMessage();
    }
}

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

<body>
    <?php
    $page = "Zoekresultaten";
    if ($_GET["query"]) {
        $page .= " voor " . $_GET["query"];
    }
    require_once("./views/menu_top.php");
    ?>

    <div class="content">
        <section>
            <?php
            $searchproducts = Product::getSearchProducts();
            if ($searchproducts !== true) {
                echo $searchproducts;
            }
            ?>
        </section>
    </div>

    <?php require_once("./views/menu_bottom.php");?>
</body>

</html>