<?php
// Start the session to maintain user state
session_start();

// Include the database access object
require_once 'Dao.php';
// Include the header file
include 'header.php';

// Instantiate the data access object
$dao = new Dao();

// Check if a new forum post has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['forum_post'])) {
    // Sanitize and validate inputs
    $user_id = $_SESSION['user_id']; // Assuming the user ID is stored in the session
    $post_title = filter_input(INPUT_POST, 'post_title', FILTER_SANITIZE_STRING);
    $post_content = filter_input(INPUT_POST, 'post_content', FILTER_SANITIZE_STRING);

    // Save the new forum post
    $dao->saveForumPost($user_id, $post_title, $post_content);
}

// Fetch all forum posts to be displayed
$forum_posts = $dao->getForumPosts();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Community Forum</title>
    <!-- Add any stylesheets or scripts here -->
</head>
<body>
    <div class="community-forum">
        <h1>Community Forum</h1>

        <!-- Section for creating a new forum post -->
        <section class="new-forum-post">
            <h2>Create a new post</h2>
            <form action="community.php" method="post">
                <label for="post_title">Title:</label>
                <input type="text" id="post_title" name="post_title" required>

                <label for="post_content">Content:</label>
                <textarea id="post_content" name="post_content" required></textarea>

                <button type="submit" name="forum_post">Post</button>
            </form>
        </section>

        <!-- Section to display all forum posts -->
        <section class="forum-posts">
            <h2>Forum Posts</h2>
            <?php foreach ($forum_posts as $post): ?>
                <article class="forum-post">
                    <h3><?= htmlspecialchars($post['post_title']) ?></h3>
                    <p><?= htmlspecialchars($post['post_content']) ?></p>
                    <!-- Add a link or form here to comment on a post -->
                    <!-- ... -->
                </article>
            <?php endforeach; ?>
        </section>
    </div>

    <!-- Include the footer file -->
    <?php include 'footer.php'; ?>
</body>
</html>
