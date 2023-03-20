<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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
#######################################################################
#                                                                     #
#___ sorteer op tabel, bijvoorbeeld "productnaam" of "winkelketen" ___#
if (isset($_GET["tabel"])) { #
    $tabel = $_GET["tabel"]; #
} else { #
#                   standaard tabel om te zoeken                      #
    $tabel = "categorie"; #
} #
# zoek op waarde, bijvoorbeeld "AH Courgette" of "Albert Heijn        #
if (isset($_GET["value"])) { #
    $value = $_GET["value"]; #
} else { #
#                   standaard waarde om te zoeken                     #
    $value = ""; #
}
#___hetzelfde maar dan een 2e optie___#
if (isset($_GET["f"])) {
    $filter = $_GET["f"];
} else { #
    $filter = "categorie"; // standaard filter? 
}
if (isset($_GET["fv"])) {
    $filtervalue = $_GET["fv"];
} else {
    $filtervalue = ""; // standaard waarde van de filter? 
}

if (isset($_GET["order"])) {
    $order = $_GET["order"];
} else {
    $order = "relevant"; // standaard tabel om te sorteren?
}
if (isset($_GET["asc"])) {
    $asc_desc = $_GET["asc"];
} else {
    $asc_desc = "DESC"; // standaard tabel om te sorteren?
}

$bierenEnAperitieven = Product::getbycategory($tabel, $value, $order, $asc_desc, $filter, $filtervalue);
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
    <style>
        .dropbtn {
            background-color: #3498DB;
            color: white;
            padding: 16px;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }

        .dropbtn:hover,
        .dropbtn:focus {
            background-color: #2980B9;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f1f1f1;
            min-width: 160px;
            overflow: auto;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown a:hover {
            background-color: #ddd;
        }

        .show {
            display: block;
        }
    </style>
</head>

<body>
    <?php
    $page = "Aperitieven";
    require_once("./views/menu_top.php");
    ?>

    <div class="content">
        <div class="links">
            <div class="link-action">
                <a href="">Acties</a>
            </div>
            <div onclick="showsort()" class="link-sort">
                <a>Sorteren</a>
                <i class="fa fa-sort"></i>
            </div>
            <div onclick="showsort2()" class="link-sort">
                <a>Winkel</a>
                <i class="fa fa-sort"></i>
            </div>
        </div>
        <form class="sort" method="GET">
            <div data-order="relevant" data-asc="asc">
                <i class="fa fa-check-circle"></i>
                <a>Meest relevant</a>
            </div>
            <p></p>
            <div data-order="winkelketen" data-asc="desc">
                <i class="fa fa-check-circle"></i>
                <a>Per winkel</a>
            </div>
            <p></p>
            <div data-order="nieuweprijs" data-asc="asc">
                <i class="fa fa-check-circle"></i>
                <a>Prijs laag - hoog</a>
            </div>
            <p></p>
            <div data-order="nieuweprijs" data-asc="desc">
                <i class="fa fa-check-circle"></i>
                <a>Prijs hoog - laag</a>
            </div>
            <p></p>
            <div>
                <!-- gaat nog niet-->
                <i class="fa fa-check-circle"></i>
                <a href="Nuttriscore A-E">Nuttriscore A-E</a>
            </div>
        </form>
        <form class="sort2" method="GET">
            <?php
            $winkels = Product::getStoreNames();
            foreach ($winkels as $winkel) {
                echo "<div>" . $winkel["winkelketen"] . "</div>";
            }
            ?>
            <div data-tabel="winkelketen" data-value="Albert Heijn">
                <i class="fa fa-check-circle"></i>
                <a>Albert Heijn</a>
            </div>
            <p></p>
            <div data-tabel="winkelketen" data-value="Delhaize">
                <i class="fa fa-check-circle"></i>
                <a>Delhaize</a>
            </div>
            <p></p>
            <div data-tabel="winkelketen" data-value="Colruyt">
                <i class="fa fa-check-circle"></i>
                <a>Colruyt</a>
            </div>
            <script>
                function getParameterByName(name, url = window.location.href) {
                    name = name.replace(/[\[\]]/g, '\\$&');
                    var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
                        results = regex.exec(url);
                    if (!results) return null;
                    if (!results[2]) return '';
                    return decodeURIComponent(results[2].replace(/\+/g, ' '));
                }
                document.querySelector(".content form").addEventListener("click", function (e) {
                    if (!Object.keys(e.target.dataset).length == 0) {
                        sort(e);
                    } else if (!Object.keys(e.target.parentNode.dataset).length == 0) {
                        sort(e.target.parentNode)
                    }
                })
                function sort(e) {
                    console.log(e)
                    let value = e.dataset.value;
                    if (value == null) {
                        value = getParameterByName('value');
                    }
                    let tabel = e.dataset.tabel;
                    if (tabel == null) {
                        tabel = getParameterByName('tabel');
                    }
                    let order = e.dataset.order;
                    if (order == null) {
                        order = getParameterByName('order');
                    }
                    let asc = e.dataset.asc;
                    if (asc == null) {
                        asc = getParameterByName('asc');
                    }
                    if ('URLSearchParams' in window) {
                        var searchParams = new URLSearchParams(window.location.search);
                        searchParams.set("value", value);
                        searchParams.set("tabel", tabel);
                        searchParams.set("order", order);
                        searchParams.set("asc", asc);
                        window.location.search = searchParams.toString();
                    }
                }
            </script>
        </form>
        <section>
            <?php foreach ($bierenEnAperitieven as $product): ?>
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
                        <div>
                            <p class="productbeschrijving">
                                <?php echo $product['beschrijving']; ?>
                            </p>
                            <p class="product-store">
                                <?php echo $product['winkelketen']; ?>
                            </p>
                        </div>
                        <?php require("./views/product_prices.php"); ?>
                    </div>
                    <?php require("./views/addcart.php"); ?>
                </div>
            <?php endforeach; ?>
        </section>
    </div>
    <?php
    $winkels = Product::getStoreNames(); foreach ($winkels as $winkel) {
        echo "<option>" . $winkel["winkelketen"] . "</option>";
    }
    ?>
    <?php require_once("./views/menu_bottom.php"); ?>
</body>

</html>