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
      * @return bool
      */
     public function add(array $data): bool
     {
         $columns = implode(', ', array_keys($data));
         $values = implode(", :", array_keys($data));
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
      * @param array $data
      * @param bool $fetchSingle
      * @return array|mixed
      */
     public function getBy(array $data, bool $fetchSingle = true)
     {
         $columns = implode(', ', array_keys($data));
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

     /**
      * @param array $data
      * @return bool
      */
     public function delete(array $data): bool
     {
         $columns = implode(', ', array_keys($data));
         $values = implode(", :", array_values($data));
         $query = 'DELETE FROM ' .$this->table. ' WHERE ' . ' '.$columns.' = :'.$columns.'';
         $stmt = $this->db->prepare($query);
         $stmt->bindValue(':'.$columns, $values);

         if ($stmt->execute()) {
             return true;
         }

         return false;
     }
 }
