<?php

namespace VFramework\Models;

use PDO;

class Post extends AbstractModel
{
    /**
     * @var string
     */
    protected $table = 'posts';

    // Gets ALL posts as objects and joins posts id to users id

    /**
     * @return array
     */
    public function getAll(): array
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
