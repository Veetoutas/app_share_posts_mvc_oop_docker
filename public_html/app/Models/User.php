<?php


namespace VFramework\Models;

use PDO;

class User extends AbstractModel
    {
        /**
         * @var string
         */
        protected $table = 'users';

        // Login User
        /**
         * @param string $email
         * @param string $password
         * @return bool|mixed
         */
        public function login ($email, $password)
        {
            $stmt = $this->db->prepare('SELECT * FROM users WHERE email = :email LIMIT 1');
            $stmt->bindValue(':email', $email);
            $stmt->execute();
            // Take the user row with the same user email
            $row = $stmt->fetch(PDO::FETCH_OBJ);
            // Store the hashed password of a user into a variable
            $hashed_password = $row->password;
            // If hashed password and the entered password matches, return the row of a user
            if(password_verify($password, $hashed_password)) {
                return $row;
            }
                return false;
        }

        // Find user by email
        /**
         * @param $email
         * @return bool
         */
        public function findByEmail($email)
        {
            $query = "SELECT * FROM users WHERE email = :email";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':email', $email);
            $stmt->execute();
            // Check row
            if($stmt->rowCount() > 0) {
                return true;
            }
                return false;
        }
    }
