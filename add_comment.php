<?php
include 'Dao.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    // Redirect to login or handle unauthorized access
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dao = new Dao();

    $post_id = $_POST['post_id'];
    $comment_content = $_POST['comment_content'];
    $author_id = $_SESSION['user_id'];

    // Validate and sanitize user input here if needed

    $dao->addComment($post_id, $comment_content, $author_id);

    // Redirect back to the community page or any other page you prefer
    header("Location: community.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Comment</title>
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="add-comment">
        <h1>Add a Comment</h1>
        <form method="post" action="">
            <input type="hidden" name="post_id" value="<?php echo $_GET['post_id']; ?>">
            <textarea name="comment_content" placeholder="Add a comment" required></textarea>
            <input type="submit" value="Add Comment">
        </form>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>
