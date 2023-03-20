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
    $page = "Bier en aperitieven";
    require_once("./views/menu_top.php");
    ?>

    <div class="content">
        <section>
            <h1>Categoriëen</h1>
            <div class="categorieën">
                <a href="producten.php?tabel=subcategorie&value=aperitieven">
                    <div class="categorie">
                        <img src="assets/images/categorieën/subcategorieën/Aperitieven.svg" alt="image">
                        <p>Aperitieven</p>
                    </div>
                </a>
                <a href="producten.php?tabel=subcategorie&value=bier">
                    <div class="categorie">
                        <img src="assets/images/categorieën/subcategorieën/Bier.svg" alt="image">
                        <p>Bier</p>
                    </div>
                </a>
                <a href="producten.php?tabel=subcategorie&value=mixdranken">
                    <div class="categorie">
                        <img src="assets/images/categorieën/subcategorieën/Mixdranken.svg" alt="image">
                        <p>Mixdranken</p>
                    </div>
                </a>
                <a href="producten.php?tabel=subcategorie&value=speciaalbier">
                    <div class="categorie">
                        <img src="assets/images/categorieën/subcategorieën/Speciaalbier.svg" alt="image">
                        <p>Speciaalbier</p>
                    </div>
                </a>
                <a href="producten.php?tabel=subcategorie&value=sterkedrank">
                    <div class="categorie">
                        <img src="assets/images/categorieën/subcategorieën/Sterke drank.svg" alt="image">
                        <p>Sterke drank</p>
                    </div>
                </a>
            </div>
            <section>
    </div>
    <?php require_once("./views/menu_bottom.php"); ?>
</body>

</html>