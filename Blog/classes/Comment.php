<?php
class Comment {
    private $conn;
    private $table_name = "comments";

    public $id;
    public $post_id;
    public $user_id;
    public $content;
    public $created_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET post_id=:post_id, user_id=:user_id, content=:content";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":post_id", $this->post_id);
        $stmt->bindParam(":user_id", $this->user_id);
        $stmt->bindParam(":content", $this->content);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function readAllByPostId($post_id) {
        $query = "SELECT comments.*, users.username FROM " . $this->table_name . "
                  LEFT JOIN users ON comments.user_id = users.id
                  WHERE post_id = ? ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $post_id);
        $stmt->execute();
        return $stmt;
    }
}
?>