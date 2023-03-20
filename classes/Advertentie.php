<?php
include_once(__DIR__ . "/Db.php");
class Advertentie
{
        private $source;
        private $winkelketen;
        
        /**
         * Get the value of source
         */ 
        public function getSource()
        {
                return $this->source;
        }

                /**
         * Set the value of source
         *
         * @return  self
         */ 
        public function setSource($source)
        {
                $this->source = $source;

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

        public function save()
        {
                // conn
                $conn = Db::getConnection();
                // insert query
                $statement = $conn->prepare("insert into users (source, winkelketen) values (:source, :winkelketen)");
                $source = $this->getSource();
                $winkelketen = $this->getWinkelketen();

                $statement->bindValue(":source", $source);
                $statement->bindValue(":winkelketen", $winkelketen);

                $result = $statement->execute();
                // return result
                return $result;
        }


        public static function getDelhaizeAd()
        {
                $conn = Db::getConnection();
                $statement = $conn->prepare("select * from advertenties where winkelketen = 'Delhaize'");
                $statement->execute();
                $advertenties = $statement->fetchAll(PDO::FETCH_ASSOC);
                return $advertenties;
        }

        public static function getAldiAd()
        {
                $conn = Db::getConnection();
                $statement = $conn->prepare("select * from advertenties where winkelketen = 'Aldi'");
                $statement->execute();
                $advertenties = $statement->fetchAll(PDO::FETCH_ASSOC);
                return $advertenties;
        }

        public static function getColruytAd()
        {
                $conn = Db::getConnection();
                $statement = $conn->prepare("select * from advertenties where winkelketen = 'Colruyt'");
                $statement->execute();
                $advertenties = $statement->fetchAll(PDO::FETCH_ASSOC);
                return $advertenties;
        }
}