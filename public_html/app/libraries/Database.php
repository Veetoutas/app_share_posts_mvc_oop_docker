<?php

    // PDO Database Class
    // Connect to databse
    // Create prepared statements
    // Bind values
    // Return row and results

    class Database {
        private $host = 'mysql';
        private $user = 'root';
        private $pass = 'rootpassword';
        private $dbname = 'shareposts';
        private $port = '3306';

        // Database handler
        private $dbh;
        private $stmt;
        private $error;

        public function __construct() {
            // Set DSN
            $dsn = "mysql:host=$this->host;dbname=$this->dbname;port=$this->port";
            $options = array(
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_ERRMODE => PDO:: ERRMODE_EXCEPTION,

            );
            // Create PDO instance
            try {

// SITA EILUTE NULAUZIA KODA !!!
                $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
            }
            catch(PDOException $e) {
                var_dump($e->getMessage());
                var_dump($e->getCode());
                die;
                $this->error = $e->getMessage();
                echo $this->error;
            }
        }

        // Prepare stmt with query
        public function query($query) {
            $this->stmt = $this->dbh->prepare($query);
        }

        // Bind values
        public function bind($param, $value, $type = null) {
            // Check value type
            if (is_null($type)) {
                switch(true) {
                    case is_int($value):
                        $type = PDO::PARAM_INT;
                        break;
                    case is_bool($value):
                        $type = PDO::PARAM_BOOL;
                        break;
                    case is_null($value):
                        $type = PDO::PARAM_NULL;
                        break;
                    default:
                        $type = PDO::PARAM_STR;
                }
            }

            $this->stmt->bindValue($param, $value, $type);

        }

        // Execute the prepared statement
        public function execute() {
            return $this->stmt->execute();
        }

        // Get result set as array of objects
        public function resultSet() {
            $this->execute();
            return $this->stmt->fetchAll(PDO::FETCH_OBJ);
        }

        // Get single record as object
        public function single() {
            $this->execute();
            return $this->stmt->fetch(PDO::FETCH_OBJ);
        }

        // Get row count
        public function rowCount() {
            return $this->stmt->rowCount();
        }
    }
