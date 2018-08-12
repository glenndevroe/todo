<?php 

include_once('Db.class.php');

    class Lijst {
        private $lijst_id;
        private $studenten_id;
        private $text;

        

        /**
         * Get the value of id
         */ 
        public function getLijst_id()
        {
                $conn = Db::getInstance();
                $stm = $conn->prepare("SELECT lijst_id FROM lijsten WHERE username = :username");
                $stm->bindValue(":username", $studenten);
                $stm->execute();
                $user = $stm->fetch(PDO::FETCH_ASSOC);

                $this->studenten_id = $studenten['id'];
                return $this->lijst_id;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setLijst_id($lijst_id)
        {
                $this->lijst_id = $lijst_id;

                return $this;
        }

        /**
         * Get the value of studenten_id
         */ 
        public function getStudenten_id()
        {
                return $this->studenten_id;
        }

        /**
         * Set the value of studenten_id
         *
         * @return  self
         */ 
        public function setStudenten_id($studenten)
        {
                $conn = Db::getInstance();
                $stm = $conn->prepare("SELECT id, username FROM studenten WHERE username = :username");
                $stm->bindValue(":username", $studenten);
                $stm->execute();
                $user = $stm->fetch(PDO::FETCH_ASSOC);

                $this->studenten_id = $studenten['id'];

                return $this;
        }

        /**
         * Get the value of text
         */ 
        public function getText()
        {
                return $this->text;
        }

        /**
         * Set the value of text
         *
         * @return  self
         */ 
        public function setText($text)
        {
                $this->text = $text;

                return $this;
        }

        public static function ShowLijst(){

            $conn = Db::getInstance();
            $statement = $conn->prepare("SELECT lijsten.text FROM lijsten");
            $statement->execute();

            return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    }

?>