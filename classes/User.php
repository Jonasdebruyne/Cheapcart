<?php
    include_once(__DIR__ . "/Db.php");
    class User {
        private $firstname;
        private $lastname;
        private $phoneNumber;
        private $postalCode;
        private $city;
        private $street;
        private $houseNumber;
        private $email;
        private $password;        

        /**
         * Get the value of firstname
         */ 
        public function getFirstname()
        {
                return $this->firstname;
        }

        /**
         * Set the value of firstname
         *
         * @return  self
         */ 
        public function setFirstname($firstname)
        {
            if(empty($firstname)){
                throw new Exception("Firstname cannot be empty");
            }
            $this->firstname = $firstname;
            
            return $this;
        }

        /**
         * Get the value of lastname
         */ 
        public function getLastname()
        {
                return $this->lastname;
        }

        /**
         * Set the value of lastname
         *
         * @return  self
         */ 
        public function setLastname($lastname)
        {
                $this->lastname = $lastname;

                return $this;
        }

        /**
         * Get the value of phoneNumber
         */ 
        public function getPhoneNumber()
        {
                return $this->phoneNumber;
        }

        /**
         * Set the value of phoneNumber
         *
         * @return  self
         */ 
        public function setPhoneNumber($phoneNumber)
        {
                $this->phoneNumber = $phoneNumber;

                return $this;
        }

        /**
         * Get the value of postalCode
         */ 
        public function getPostalCode()
        {
                return $this->postalCode;
        }

        /**
         * Set the value of postalCode
         *
         * @return  self
         */ 
        public function setPostalCode($postalCode)
        {
                $this->postalCode = $postalCode;

                return $this;
        }

        /**
         * Get the value of city
         */ 
        public function getCity()
        {
                return $this->city;
        }

        /**
         * Set the value of city
         *
         * @return  self
         */ 
        public function setCity($city)
        {
                $this->city = $city;

                return $this;
        }

        /**
         * Get the value of street
         */ 
        public function getStreet()
        {
                return $this->street;
        }

        /**
         * Set the value of street
         *
         * @return  self
         */ 
        public function setStreet($street)
        {
                $this->street = $street;

                return $this;
        }

        /**
         * Get the value of houseNumber
         */ 
        public function getHouseNumber()
        {
                return $this->houseNumber;
        }

        /**
         * Set the value of houseNumber
         *
         * @return  self
         */ 
        public function setHouseNumber($houseNumber)
        {
                $this->houseNumber = $houseNumber;

                return $this;
        }

        /**
         * Get the value of email
         */ 
        public function getEmail()
        {
                return $this->email;
        }

        /**
         * Set the value of email
         *
         * @return  self
         */ 
        public function setEmail($email)
        {
                $this->email = $email;

                return $this;
        }

        /**
         * Get the value of password
         */ 
        public function getPassword()
        {
                return $this->password;
        }

        /**
         * Set the value of password
         *
         * @return  self
         */ 
        public function setPassword($password)
        {
                $this->password = $password;

                return $this;
        }

        public function save(){
            // conn
            $conn = Db::getConnection();
            // insert query
            $statement = $conn->prepare("insert into users (firstname, lastname, phoneNumber, postalCode, city, street, houseNumber, email, password) values (:firstname, :lastname, :phoneNumber, :postalCode, :city, :street, :houseNumber, :email, :password)");
            $firstname = $this->getFirstname();
            $lastname = $this->getLastname();
            $phoneNumber = $this->getPhoneNumber();
            $postalCode = $this->getPostalCode();
            $city = $this->getCity();
            $street = $this->getStreet();
            $houseNumber = $this->getHouseNumber();
            $email = $this->getEmail();
            $password = $this->getPassword();
            
            $statement->bindValue(":firstname", $firstname);
            $statement->bindValue(":lastname", $lastname);
            $statement->bindValue(":phoneNumber", $phoneNumber);
            $statement->bindValue(":postalCode", $postalCode);
            $statement->bindValue(":city", $city);
            $statement->bindValue(":street", $street);
            $statement->bindValue(":houseNumber", $houseNumber);
            $statement->bindValue(":email", $email);
            $statement->bindValue(":password", $password);

            $result = $statement->execute();
            // return result
            return $result;

        }

        public static function getAll(){
            $conn = Db::getConnection();
            $statement = $conn->prepare("select * from users");
            $statement->execute();
            $users = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $users;
        }
    }