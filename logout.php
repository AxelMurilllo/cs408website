<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    // If logged in, destroy the session to log the user out
    session_destroy();
    header("Location: logout.php"); // Redirect to the login page
}

// If not logged in, redirect to the login page
header("Location: login.php");
exit();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Logout</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f6f8fa;
            text-align: center;
        }

        .container {
            margin-top: 100px;
        }

        .message {
            font-size: 24px;
        }
    </style>
</head>
<body>
<?php include 'header.php'; ?>
    <div class="container">
        <div class="message">
            You have been successfully logged out.
        </div>
    </div>
</body>
</html>
