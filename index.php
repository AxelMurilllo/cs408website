<?php include_once("index.html"); ?>
<?php 
session_start();
if (isset($_SESSION['user_id'])) {
    // User is logged in
    echo '<a href="profile.php">Profile</a>';
}
?>