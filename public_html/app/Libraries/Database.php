<?php

namespace VFramework\Libraries;

use PDO;

class Database extends PDO
{
    /**
     * @var string
     */
    private $host = 'mysql';
    /**
     * @var string
     */
    private $user = 'root';
    /**
     * @var string
     */
    private $pass = 'rootpassword';
    /**
     * @var string
     */
    private $dbname = 'shareposts';
    /**
     * @var string
     */
    private $port = '3306';
    /**
     * @var string
     */
    private $error;

    public function __construct()
    {
        // Set DSN
        $dsn = "mysql:host=$this->host;dbname=$this->dbname;port=$this->port";
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO:: ERRMODE_EXCEPTION,

        );
        // Create PDO instance
        try {
            parent::__construct($dsn, $this->user, $this->pass, $options);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }
}
