<?php
include_once($_SERVER["DOCUMENT_ROOT"] . "/classes/Product.php");
$links = [["home.php", "Home", "fa fa-home"], ["discounts.php", "Acties", "fa fa-percent"], ["products.php", "Producten", "fa fa-apple"], ["cart.php", '<div><p class="counter">'.Product::cartcount().'</p></div>', "fa fa-shopping-basket"]];
?>
<footer>
    <nav>
        <?php
        $active = "";
        foreach ($links as $link):
            $currentfile = str_replace("/", "", $_SERVER["REQUEST_URI"]);
            $currentfile = explode('?', $currentfile)[0];
            if ($link[0] == $currentfile) {
                $active = "active";
            } else {
                $active = "";
            }
            ?>
            <a href="<?php echo $link[0] ?>" >
                <div class="<?php echo $active ?> <?php if ($link[0] == "cart.php") { echo "div-counter";} ?>">
                    <div class="<?php echo $active ?> <?php if ($link[0] == "cart.php") { echo "div-row";} ?>">
                        <i class="<?php echo $link[2]?>
                        <?php 
                            echo $active;
                            if($link[0] == "cart.php"){
                                echo " itemToCart";
                            }
                        ?>"></i>
                        <?php echo $link[1] ?>
                    </div>
                        <?php if ($link[0] == "cart.php") {
                                echo " Mijn lijst";
                            } ?>
                </div>
            </a>
            <?php
        endforeach;
        ?>
    </nav>
</footer>
<script src="script.js"></script>
