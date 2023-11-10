<?php
// Dao.php
// class for saving and getting comments from MySQL
class Dao {

    private $host = getenv('DB_HOST');
    private $dbname = getenv('DB_NAME');
    private $username = getenv('DB_USER');
    private $password = getenv('DB_PASS');

    public function getConnection() {
        return new PDO("mysql:host={$this->host};dbname={$this->db}", $this->user, $this->pass);
    }

    public function getComments() {
        $conn = $this->getConnection();
        return $conn->query("SELECT * FROM comments ORDER BY timestamp DESC")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteComment($id) {
        $conn = $this->getConnection();
        $deleteComment = "DELETE FROM comments WHERE comment_id = :comment_id";
        $q = $conn->prepare($deleteComment);
        $q->bindParam(":comment_id", $id);
        $q->execute();
    }

    public function saveComment($post_id, $content, $author_id) {
        $conn = $this->getConnection();
        $saveQuery = "INSERT INTO comments (post_id, content, author_id) VALUES (:post_id, :content, :author_id)";
        $q = $conn->prepare($saveQuery);
        $q->bindParam(":post_id", $post_id);
        $q->bindParam(":content", $content);
        $q->bindParam(":author_id", $author_id);
        $q->execute();
    }

    public function getForumPosts() {
        $conn = $this->getConnection();
        return $conn->query("SELECT * FROM forum_posts ORDER BY post_date DESC")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteForumPost($post_id) {
        $conn = $this->getConnection();
        $deletePost = "DELETE FROM forum_posts WHERE post_id = :post_id";
        $q = $conn->prepare($deletePost);
        $q->bindParam(":post_id", $post_id);
        $q->execute();
    }

    public function saveForumPost($user_id, $post_title, $post_content) {
        $conn = $this->getConnection();
        $saveQuery = "INSERT INTO forum_posts (user_id, post_title, post_content) VALUES (:user_id, :post_title, :post_content)";
        $q = $conn->prepare($saveQuery);
        $q->bindParam(":user_id", $user_id);
        $q->bindParam(":post_title", $post_title);
        $q->bindParam(":post_content", $post_content);
        $q->execute();
    }

    public function getCommentsByPost($post_id) {
        $conn = $this->getConnection();
        $getCommentsQuery = "SELECT * FROM comments WHERE post_id = :post_id";
        $q = $conn->prepare($getCommentsQuery);
        $q->bindParam(":post_id", $post_id);
        $q->execute();
        return $q->fetchAll(PDO::FETCH_ASSOC);
    }
} // end Dao