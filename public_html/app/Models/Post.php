<?php

namespace VFramework\Models;

use PDO;

class Post extends AbstractModel
{
    /**
     * @var string
     */
    protected $table = 'posts';

    /**
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        $query = 'SELECT * FROM posts WHERE id = :id';
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_OBJ);
        return $row;
    }

    /**
     * @return array
     *
     */
    // Gets ALL posts as objects and joins posts id to users id
    public function getAll()
    {
        $query = '
                SELECT *,
                posts.id as postId,
                users.id as userId,
                posts.created_at as postCreated,
                users.created_at as userCreated
                FROM posts
                INNER JOIN users
                ON posts.user_id = users.id
                ORDER BY posts.created_at DESC
                ';
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $results;
    }
}
