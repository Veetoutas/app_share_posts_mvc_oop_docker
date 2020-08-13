<?php

    class User {
        private $db;

        // Instantiates 'Database' class
        public function __construct() {
            $this->db = new Database;
        }

        // Find user by email
        public function findUserByEmail($email) {
            // query() is a function from class 'Database' which we instantiated
            $this->db->query('SELECT * FROM users WHERE email = :email');
            $this->db->bind(':email', $email);

            $row = $this->db->single();

            // Check row
            if($this->db->rowCount() > 0) {
                return true;
            }
            else {
                return false;
            }
        }
    }