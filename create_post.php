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

    $post_title = $_POST['post_title'];
    $post_content = $_POST['post_content'];
    $user_id = $_SESSION['user_id'];

    // Validate and sanitize user input here if needed

    $dao->createForumPost($user_id, $post_title, $post_content);

    // Redirect back to the community page or any other page you prefer
    header("Location: community.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create New Post</title>
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="create-post">
        <h1>Create a New Post</h1>
        <form method="post" action="">
            <input type="text" name="post_title" placeholder="Post Title" required>
            <textarea name="post_content" placeholder="Post Content" required></textarea>
            <input type="submit" value="Create Post">
        </form>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>
