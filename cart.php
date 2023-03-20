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
    $page = "Uw winkelwagen";
    require_once("./views/menu_top.php");
    ?>

    <div class="content">
        <div class="items">
            <?php Product::queryCart(); ?>
        </div>
    </div>
    <div class="payement">
        <div>
            <p>Te betalen</p>
            <p class="tebetalenprijs">€0.00</p>
        </div>
        <p class="border"></p>
        <div class="besparen">
            <p>Je bespaart</p>
            <p class="besparingsprijs">€0.00</p>
        </div>
        <div>
            <input type="checkbox" id="checkbox">
            <p>Ik wil mijn lijstje in 1 winkel ophalen.</p>
        </div>
        <div class="maps">
            <iframe class="iframe"
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2509.5704042419543!2d4.4799573159083925!3d51.02408487955864!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c3e5cc38540f9f%3A0xbd692d9ca309ac7f!2sCarrefour%20express%20MECHELEN!5e0!3m2!1snl!2sbe!4v1679001488814!5m2!1snl!2sbe"
                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
    <?php require_once("./views/menu_bottom.php");?>

    <script>
        document.querySelector(".fa-circle-o").addEventListener("click", function (e) {
            this.classList.replace("fa-circle-o", "fa-check-circle");
            this.style.color = "#6495ed";

            document.querySelector(".fa-check-circle").addEventListener("click", function (e) {
                this.classList.replace("fa-check-circle", "fa-circle-o");
                this.style.color = "#6495ed";
            })
        })

        document.querySelector("#checkbox").addEventListener("change", function (e) {
            if (this.checked) {
                document.querySelector(".iframe").style.display = "block";
                document.querySelector(".payement").style.top = "530px";
            }
            else {
                document.querySelector(".iframe").style.display = "none";
                document.querySelector(".payement").style.top = "630px";
            }
        })
        document.querySelector(".items").addEventListener("click", function (e) {
            changeamount(e);
            let hoeveel = e.target.parentNode.querySelector(".hoeveel");
            let cartcount = document.querySelector("p.counter");
            if (e.target.classList.contains("min")) {
                let newnumber = parseInt(hoeveel.innerHTML) - 1;
                if (newnumber >= 0) {
                    hoeveel.innerHTML = newnumber;
                    cartcount.innerHTML = parseInt(cartcount.innerHTML) - 1;
                }
            } else if (e.target.classList.contains("plus")) {
                cartcount.innerHTML = parseInt(cartcount.innerHTML) + 1;
                hoeveel.innerHTML = parseInt(hoeveel.innerHTML) + 1;
            }
            calculateTotal();
        })

        function calculateTotal() {
            let totalprice = 0;
            let newprice = document.querySelectorAll(".newprice");
            let productcount = document.querySelectorAll(".hoeveel");
            for (i = 0; productcount.length > i; i++) {
                totalprice += Number(productcount[i].innerHTML) * Number(newprice[i].innerHTML);
            }
            document.querySelector(".tebetalenprijs").innerHTML = totalprice.toFixed(2);
            calculateBesparing(totalprice)
        }

        function calculateBesparing(newprice) {
            let totalprice = 0;
            let oldprice = document.querySelectorAll(".previousprice");
            let productcount = document.querySelectorAll(".hoeveel");
            for (i = 0; productcount.length > i; i++) {
                totalprice += Number(productcount[i].innerHTML) * Number(oldprice[i].innerHTML);
            }
            document.querySelector(".besparingsprijs").innerHTML = (totalprice - newprice).toFixed(2);
        }

        calculateTotal();
        function changeamount(e) {
            if (e.target.parentNode.dataset.productid) {
                amount = 1;
                if (e.target.classList.contains("min")) {
                    fetch("./addcart.php?productid=" + e.target.parentNode.dataset.productid + "&userid=" + document.body.querySelector("header").dataset.uid + "&amount=-" + amount)
                        .then((response) => response)
                        .then((data) => console.log(data));
                } else if (e.target.classList.contains("plus")) {
                    fetch("./addcart.php?productid=" + e.target.parentNode.dataset.productid + "&userid=" + document.body.querySelector("header").dataset.uid + "&amount=" + amount)
                        .then((response) => response)
                        .then((data) => console.log(data));
                }
            }
        }

        let countershoppingcart = document.querySelector(".counter");
        let hoeveelheden = document.querySelectorAll(".hoeveel");
        hoeveelheden.addEventListener("change", function (e) {
            for (i = 0; i < hoeveelheden.length; i++) {
                sum += parseInt(str.charAt(i), 10);
                sum = countershoppingcart.innerHTML;
            }
        })
    </script>
</body>

</html>