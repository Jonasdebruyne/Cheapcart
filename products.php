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
    $page = "Producten";
    require_once("./views/menu_top.php");
    ?>
    <div class="content">
        <section>
            <h1>Categoriëen</h1>
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
        </section>
    </div>
    <?php require_once("./views/menu_bottom.php");?>
</body>

</html>