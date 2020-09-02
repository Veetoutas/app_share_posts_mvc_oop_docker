<?php

namespace VFramework\Models;

 use PDO;
 use VFramework\Libraries\Database;

 abstract class AbstractModel
 {
     /**
      * @var Database
      */
     protected $db;

     // Instantiates 'Database' class
     public function __construct()
     {
         $this->db = new Database();
     }


     /**
      * @param array $data
      */
     public function add($data)
     {
         unset($data['confirm_password']);
         $columns = implode(', ', array_keys($data));  //get key(columns' names)
         $values = implode(", :", array_keys($data));  //get values (values to be inserted)
         $query = 'INSERT INTO ' .$this->table. ' ('.$columns.') VALUES (:'.$values.')';
         $stmt = $this->db->prepare($query);

         foreach ($data as $key => $value)
         {
             $bindKey = sprintf(':%s', $key);
             $stmt->bindValue($bindKey, $value);
         }
         return $stmt->execute();
     }

     /**
      * @param $data
      * @return array
      */
     public function get($data): array
     {
         $columns = implode(', ', array_keys($data));  //get key(columns' names)
         $values = implode(", :", array_keys($data));
         $query = 'SELECT * FROM ' .$this->table. ' WHERE ' . ' '.$columns.' = :'.$values.'';
         $stmt = $this->db->prepare($query);

         foreach ($data as $key => $value)
         {
             $bindKey = sprintf(':%s', $key);
             $stmt->bindValue($bindKey, $value);
         }

         $stmt->execute();
         return $stmt->fetchAll();
     }

     public function getBy($data, $fetchSingle = true)
     {
         $columns = implode(', ', array_keys($data));  //get key(columns' names)
         $values = implode(", :", array_values($data));
         $query = 'SELECT * FROM ' .$this->table. ' WHERE ' . ' '.$columns.' = :'.$columns.'';
         $stmt = $this->db->prepare($query);
         $stmt->bindValue(':'.$columns, $values);
         $stmt->execute();

         if ($fetchSingle) {
             return $stmt->fetch(PDO::FETCH_OBJ);
         }
         return $stmt->fetchAll();
     }
 }
