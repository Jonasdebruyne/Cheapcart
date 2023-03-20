<?php
include_once(__DIR__ . "/Db.php");
class Product
{
        private $productnaam;
        private $categorie;
        private $subcategorie;
        private $winkelketen;
        private $vorigeprijs;
        private $nieuweprijs;

        /**
         * Get the value of productnaam
         */
        public function getProductnaam()
        {
                return $this->productnaam;
        }

        /**
         * Set the value of productnaam
         *
         * @return  self
         */
        public function setProductnaam($productnaam)
        {
                $this->productnaam = $productnaam;

                return $this;
        }

        /**
         * Get the value of categorie
         */
        public function getCategorie()
        {
                return $this->categorie;
        }

        /**
         * Set the value of categorie
         *
         * @return  self
         */
        public function setCategorie($categorie)
        {
                $this->categorie = $categorie;

                return $this;
        }

        /**
         * Get the value of subcategorie
         */
        public function getSubcategorie()
        {
                return $this->subcategorie;
        }

        /**
         * Set the value of subcategorie
         *
         * @return  self
         */
        public function setSubcategorie($subcategorie)
        {
                $this->subcategorie = $subcategorie;

                return $this;
        }

        /**
         * Get the value of winkelketen
         */
        public function getWinkelketen()
        {
                return $this->winkelketen;
        }

        /**
         * Set the value of winkelketen
         *
         * @return  self
         */
        public function setWinkelketen($winkelketen)
        {
                $this->winkelketen = $winkelketen;

                return $this;
        }

        /**
         * Get the value of vorigeprijs
         */
        public function getVorigeprijs()
        {
                return $this->vorigeprijs;
        }

        /**
         * Set the value of vorigeprijs
         *
         * @return  self
         */
        public function setVorigeprijs($vorigeprijs)
        {
                $this->vorigeprijs = $vorigeprijs;

                return $this;
        }

        /**
         * Get the value of nieuweprijs
         */
        public function getNieuweprijs()
        {
                return $this->nieuweprijs;
        }

        /**
         * Set the value of nieuweprijs
         *
         * @return  self
         */
        public function setNieuweprijs($nieuweprijs)
        {
                $this->nieuweprijs = $nieuweprijs;

                return $this;
        }

        public function save()
        {
                // conn
                $conn = Db::getConnection();
                // insert query
                $statement = $conn->prepare("insert into users (productnaam, categorie, subcategorie, winkelketen, vorigeprijs, nieuweprijs) values (:productnaam, :categorie, :subcategorie, :winkelketen, :vorigeprijs, :nieuweprijs)");
                $productnaam = $this->getProductnaam();
                $categorie = $this->getCategorie();
                $subcategorie = $this->getSubcategorie();
                $winkelketen = $this->getWinkelketen();
                $vorigeprijs = $this->getVorigeprijs();
                $nieuweprijs = $this->getNieuweprijs();

                $statement->bindValue(":productnaam", $productnaam);
                $statement->bindValue(":categorie", $categorie);
                $statement->bindValue(":subcategorie", $subcategorie);
                $statement->bindValue(":winkelketen", $winkelketen);
                $statement->bindValue(":vorigeprijs", $vorigeprijs);
                $statement->bindValue(":nieuweprijs", $nieuweprijs);

                $result = $statement->execute();
                // return result
                return $result;
        }


        public static function getThreeDiscountProducts()
        {
                $conn = Db::getConnection();
                $statement = $conn->prepare("select * from producten where vorigeprijs != nieuweprijs LIMIT 9");
                $statement->execute();
                $products = $statement->fetchAll(PDO::FETCH_ASSOC);
                return $products;
        }

        public static function getAllBierenEnAperitievenInDiscount()
        {
                $conn = Db::getConnection();
                $statement = $conn->prepare("select * from producten where categorie = 'bier en aperitieven' && vorigeprijs != nieuweprijs");
                $statement->execute();
                $products = $statement->fetchAll(PDO::FETCH_ASSOC);
                return $products;
        }

        public static function getAllGroenteEnFruitInDiscount()
        {
                $conn = Db::getConnection();
                $statement = $conn->prepare("select * from producten where categorie = 'groenten en fruit' && vorigeprijs != nieuweprijs");
                $statement->execute();
                $products = $statement->fetchAll(PDO::FETCH_ASSOC);
                return $products;
        }


        public static function getStoreNames()
        {
                $conn = Db::getConnection();
                $statement = $conn->prepare("select winkelketen from producten GROUP BY winkelketen");
                $statement->execute();
                $winkels = $statement->fetchAll(PDO::FETCH_ASSOC);
                return $winkels;
        }

        /*order => een tabelnaam +> meestal op "nieuweprijs" of "relevant" of "winkelketen" */
        /*way => acs of decs*/
        public static function searchdatabase($tabel, $value, $order, $way){
                $conn = Db::getConnection();
                $statement = $conn->prepare("select * from producten where {$tabel} LIKE '%{$value}%' ORDER BY {$order} {$way}");
                $statement->execute();
                $products = $statement->fetchAll(PDO::FETCH_ASSOC);
                return $products;
        }

        public static function getbycategory($tabel, $value, $order, $way, $filter, $filtervalue)
        {
                $conn = Db::getConnection();
                $statement = $conn->prepare("select * from producten where {$filter} LIKE '%{$filtervalue}%' AND {$tabel} LIKE '%{$value}%' ORDER BY {$order} {$way}");
                $statement->execute();
                $products = $statement->fetchAll(PDO::FETCH_ASSOC);
                return $products;
        }
        // einde per categorie
        public static function cartcount()
        {
                $count = 0;
                $conn = Db::getConnection();
                $statement = $conn->prepare("select * from cart where userid = '{$_SESSION["userid"]}' AND amount > 0 order by amount DESC;");
                $statement->execute();   
                while ($row = $statement->fetch()) {
                        $count = $count + $row["amount"];
                }
                return $count;
        }
        public static function queryCart()
        {
                $conn = Db::getConnection();
                $statement = $conn->prepare("select * from cart where userid = '{$_SESSION["userid"]}' AND amount > 0 order by amount DESC;");
                $statement->execute();
                $error = "no results";

                while ($row = $statement->fetch()) {
                        $error = false;
                        $getitemfromid = $conn->prepare("select * from producten where productnummer = '{$row["productnummer"]}';");
                        $getitemfromid->execute();
                        while ($product = $getitemfromid->fetch()) {
                                $error = false;
                                ?>
                                <div class="item">
                                        <div class="checker">
                                                <i class="fa fa-circle-o"></i>
                                        </div>
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
                                        <div class="counter">
                                                <div data-productid="<?php echo $row['productnummer']; ?>">
                                                        <p class="min">-</p>
                                                        <p class="hoeveel">
                                                                <?php echo $row['amount']; ?>
                                                        </p>
                                                        <p class="plus">+</p>
                                                </div>
                                        </div>
                                </div>
                                <?php
                                break;
                        }
                }

                if ($error !== false) {
                        ?>
                        <div class="no-records">
                                <img src="assets/images/Uitwerking logo cheapcart.svg" alt="logo">
                                <h1>Uw winkelwagen is leeg</h1>
                                <p>Het lijkt erop dat je niets hebt toegevoegd aan je winkelwagen. Ga je gang en verken de categorieën.</p>
                        </div>
                        <?php
                }
        }

        // functie voor te zoeken
        public static function getSearchProducts()
        {
                // selecteer alle info van producten als de productnaam begint met '[text]' OF productnaam '[text]' met een spatie voor bevat, sorteer dat op relevantie
                // productnaam '[text]' met een spatie voor bevat is (meestal het 2e, 3e,... woord), behalve als u naam met een spatie begint : )
                // $statement = $conn->prepare("select * from producten where productnaam like '".$_GET["query"]."%' or productnaam like '% ".$_GET["query"]."%' order by relevant DESC;");
                $query = $_GET['query'];
                $query = "%" . $query . "%";
                $forbidden = array("'", '"', "_", ".", "$", "*");
                $query = str_replace($forbidden, "", $query);
                if (strlen($query) - 2 < 1 /*zoek lengte < min lengte */) {
                        $error = "too short";
                        return $error;
                } else {
                        $conn = Db::getConnection();
                        $statement = $conn->prepare("select * from producten where productnaam like '{$query}' order by relevant DESC;");
                        $statement->execute();
                        $error = "no results";
                        // error wordt overschreven als er meer als 1 resultaat is naar true
                        while ($product = $statement->fetch()) {

                                ?>
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
                                                <?php require("./views/product_prices.php");?>
                                        </div>
                                        <?php require("./views/addcart.php"); ?>
                                </div>
                                <?php
                                $error = true;
                        }
                        return $error;
                }
        }
}