<?php


namespace VFramework\Models;

use PDO;
use VFramework\Tools\Validator;

class User extends AbstractModel
{
    /**
     * @var Validator
     */
    private Validator $validator;

    public function __construct()
    {
        parent::__construct();
        $this->validator = new Validator($this);
    }

    /**
     * @var string
     */
    protected $table = 'users';

    /**
     * @param string $email
     * @param string $password
     * @return bool|mixed
     */
    public function login (string $email, string $password)
    {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE email = :email LIMIT 1');
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        // Take the user row with the same user email
        $row = $stmt->fetch(PDO::FETCH_OBJ);

        $passwordsMatch = $this->validator->rightPassword([
            'password' => $password,
            'password_hash' => $row->password
        ]);

        if (!$this->validator->isValid()) {
            throw new \Exception($this->validator->getErrors()[0]);
        }
        // Store the hashed password of a user into a variable
        // If hashed password and the entered password matches, return the row of a user
        if ($passwordsMatch) {
            return $row;
        }
        return false;
    }
}
