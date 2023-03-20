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

$threeDiscountProducts = Product::getThreeDiscountProducts();

include_once(__DIR__ . "/classes/Advertentie.php");

if (!empty($_POST)) {
    try {
        $advertentie = new Advertentie();
        $advertentie->setSource($_POST['source']);
        $advertentie->setWinkelketen($_POST['winkelketen']);

        $advertentie->save();
        $success = "User saved!";


    } catch (\Throwable $th) {
        $error = $th->getMessage();
    }
}
$delhaize = Advertentie::getDelhaizeAd();
$aldi = Advertentie::getAldiAd();
$colruyt = Advertentie::getColruytAd();

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
    $page = "Home";
    require_once("./views/menu_top.php");
    ?>
    <div class="content">
        <section class="home">
            <div class="search">
                <form action="actionpage.php" method="GET">
                    <input type="text" placeholder="Zoek een product" name="query">
                    <button type="submit"><i class="fa fa-search"></i></button>
                </form>
            </div>
            <div class="aanbiedingen">
                <h2>Aanbiedingen</h2>
                <div class="products">
                    <?php foreach ($threeDiscountProducts as $product): ?>
                        <div class="product">
                            <div class="product-info">
                                <img src="<?php echo $product['productfoto']; ?>" alt="productimage">
                                <p class="productname">
                                    <?php echo $product['productnaam']; ?>
                                </p>
                                <div class="div-product-store">
                                    <p class="product-store">
                                        <?php echo $product['winkelketen']; ?>
                                    </p>
                                    <p class="productbeschrijving">
                                        <?php echo $product['beschrijving']; ?>
                                    </p>
                                </div>
                                <?php require("./views/product_prices.php");?>
                            </div>
                            <?php require("./views/addcart.php"); ?>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div>
                    <a href="discounts.php" class="button">Alle aanbiedingen tonen</a>
                </div>
            </div>

            <section>
                <?php foreach ($delhaize as $advertentie): ?>
                    <div class="advertentie">
                        <div class="advertentie-image">
                            <img src="<?php echo $advertentie['source']; ?>" alt="advertentieimage">
                        </div>
                    </div>
                <?php endforeach; ?>
            </section>

            <div class="assortiment">
                <h2>Assortiment</h2>
                <div class="categorieën">
                    <a href="BierEnAperitieven.php">
                        <div class="categorie">
                            <img src="assets/images/categorieën/Bier en aperitieven.svg" alt="image">
                            <p>Bier en aperitieven</p>
                        </div>
                    </a>
                    <div class="categorie">
                        <img src="assets/images/categorieën/Bakkerij en banket.svg" alt="image">
                        <p>Bakkerij en banket</p>
                    </div>
                    <div class="categorie">
                        <img src="assets/images/categorieën/Baby en kind.svg" alt="image">
                        <p>Baby en kind</p>
                    </div>
                    <div class="categorie">
                        <img src="assets/images/categorieën/Charcuterie en aperitiefhapjes.svg" alt="image">
                        <p>Charcuterie en aperitiefhapjes</p>
                    </div>
                    <div class="categorie">
                        <img src="assets/images/categorieën/Diepvries.svg" alt="image">
                        <p>Diepvries</p>
                    </div>
                    <div class="categorie">
                        <img src="assets/images/categorieën/Drogisterij.svg" alt="image">
                        <p>Drogisterij</p>
                    </div>
                    <div class="categorie">
                        <img src="assets/images/categorieën/Frisdrank, sappen, koffie en thee.svg" alt="image">
                        <p>Frisdrank, sappen, koffie en thee</p>
                    </div>
                    <div class="categorie">
                        <img src="assets/images/categorieën/Groenten en fruit.svg" alt="image">
                        <p>Groenten en fruit</p>
                    </div>
                    <div class="categorie">
                        <img src="assets/images/categorieën/Huishouden.svg" alt="image">
                        <p>Huishouden</p>
                    </div>
                    <div class="categorie">
                        <img src="assets/images/categorieën/Huisdier.svg" alt="image">
                        <p>Huisdier</p>
                    </div>
                    <div class="categorie">
                        <img src="assets/images/categorieën/Koken, tafelen en vrije tijd.svg" alt="image">
                        <p>Koken, tafelen en vrije tijd</p>
                    </div>
                    <div class="categorie">
                        <img src="assets/images/categorieën/Ontbijtgranen en beleg.svg" alt="image">
                        <p>Ontbijtgranen en beleg</p>
                    </div>
                    <div class="categorie">
                        <img src="assets/images/categorieën/Pasta, rijst en wereldkeuken.svg" alt="image">
                        <p>Pasta, rijst en wereldkeuken</p>
                    </div>
                    <div class="categorie">
                        <img src="assets/images/categorieën/Snoep, koek, chips en chocolade.svg" alt="image">
                        <p>Snoep, koek, chips en chocolade</p>
                    </div>
                    <div class="categorie">
                        <img src="assets/images/categorieën/Soepen, sauzen, kruiden en olie.svg" alt="image">
                        <p>Soepen, sauzen, kruiden en olie</p>
                    </div>
                    <div class="categorie">
                        <img src="assets/images/categorieën/Sportvoeding.svg" alt="image">
                        <p>Sport- en dieetvoeding</p>
                    </div>
                    <div class="categorie">
                        <img src="assets/images/categorieën/Tussendoortjes.svg" alt="image">
                        <p>Tussendoortjes</p>
                    </div>
                    <div class="categorie">
                        <img src="assets/images/categorieën/Vlees, kip, vis en vega.svg" alt="image">
                        <p>Vlees, kip, vis en vega</p>
                    </div>
                    <div class="categorie">
                        <img src="assets/images/categorieën/Wijn en bubbels.svg" alt="image">
                        <p>Wijn en bubbels</p>
                    </div>
                    <div class="categorie">
                        <img src="assets/images/categorieën/Zuivel, plantaardig en eieren.svg" alt="image">
                        <p>Zuivel, plantaardig en eieren</p>
                    </div>
                </div>
                <div>
                    <a href="products.php" class="button">Alle producten tonen</a>
                </div>
            </div>

            <div class="folders">
                <h2>Digitale folders</h2>
                <div>
                    <a href="https://folder.aldi.be/nl/folder-van-deze-week/">
                        <div>
                            <img src="assets/images/folders/folder-aldi.svg" alt="folder-image">
                            <p>Aldi</p>
                        </div>
                    </a>
                    <a href="https://www.ah.be/bonus/folder">
                        <div>
                            <img src="assets/images/folders/folder-albertheijn.svg" alt="folder-image">
                            <p>Albert Heijn</p>
                        </div>
                    </a>
                    <a href="https://www.colruyt.be/nl/acties/folders/vI0623-actie">
                        <div>
                            <img src="assets/images/folders/folder-colruyt.svg" alt="folder-image">
                            <p>Colruyt</p>
                        </div>
                    </a>
                    <a href="https://www.delhaize.be/nl/folder">
                        <div>
                            <img src="assets/images/folders/folder-delhaize.svg" alt="folder-image">
                            <p>Delhaize</p>
                        </div>
                    </a>
                    <a
                        href="https://www.lidl.nl/c/service-contact-folders/s10008124?gclid=Cj0KCQjwk7ugBhDIARIsAGuvgPYZmviLppmKA9-mzIh0cvuDD04UxQK54xO_9ncu1g5qIwHygbzul3IaAsJyEALw_wcB">
                        <div>
                            <img src="assets/images/folders/folder-lidl.svg" alt="folder-image">
                            <p>Lidl</p>
                        </div>
                    </a>
                </div>
            </div>

            <section>
                <?php foreach ($aldi as $advertentie): ?>
                    <div class="advertentie">
                        <div class="advertentie-image">
                            <img src="<?php echo $advertentie['source']; ?>" alt="advertentieimage">
                        </div>
                    </div>
                <?php endforeach; ?>
            </section>
            <section>
                <?php foreach ($colruyt as $advertentie): ?>
                    <div class="advertentie">
                        <div class="advertentie-image">
                            <img src="<?php echo $advertentie['source']; ?>" alt="advertentieimage">
                        </div>
                    </div>
                <?php endforeach; ?>
            </section>
        </section>
    </div>
    <?php require_once("./views/menu_bottom.php");?>
</body>

</html>