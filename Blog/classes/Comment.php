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
        $query = "INSERT INTO " . $this->table_name . " SET post_id=:post_id, user_id=:user_id, content=:content, created_at=:created_at";
        $stmt = $this->conn->prepare($query);

        $currentDateTime = date('Y-m-d H:i:s');

        $this->post_id = htmlspecialchars(strip_tags($this->post_id));
        $this->content = htmlspecialchars(strip_tags($this->content));

        if (!is_null($this->user_id)) {
            $this->user_id = htmlspecialchars(strip_tags($this->user_id));
        }

        $stmt->bindParam(":post_id", $this->post_id);
        if (!is_null($this->user_id)) {
            $stmt->bindParam(":user_id", $this->user_id, PDO::PARAM_INT);
        } else {
            $stmt->bindValue(":user_id", null, PDO::PARAM_NULL);
        }
        $stmt->bindParam(":content", $this->content);
        $stmt->bindParam(":created_at", $currentDateTime);

        if ($stmt->execute()) {
            return true;
        } else {
            printf("Error: %s.\n", $stmt->errorInfo()[2]);
            return false;
        }
    }

    public function readAll() {
        $query = "SELECT comments.*, users.username FROM " . $this->table_name . " LEFT JOIN users ON comments.user_id = users.id ORDER BY comments.created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function readAllByPostId($post_id) {
        $query = "SELECT comments.*, users.username FROM " . $this->table_name . " LEFT JOIN users ON comments.user_id = users.id WHERE comments.post_id = ? ORDER BY comments.created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $post_id);
        $stmt->execute();
        return $stmt;
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(1, $this->id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            printf("Error: %s.\n", $stmt->error);
            return false;
        }
    }
}
?>