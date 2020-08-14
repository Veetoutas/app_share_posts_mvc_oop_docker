<?php

    class User {
        private $db;

        // Instantiates 'Database' class
        public function __construct() {
            $this->db = new Database;
        }

        // Register user
        public function register($data) {
            // First we prepare the statement with query() function
            $this->db->query('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)');
            // Then we bind the values to the parameters
            $this->db->bind(':name', $data['name']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':password', $data['password']);
            // Then we insert the into DB and call the execute method
            if ($this->db->execute()) {
                return true;
            }
            else {
                return false;
            }
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