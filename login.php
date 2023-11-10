<!DOCTYPE html>
<html>
<head>
    <title>Travel Forum - Login or Sign Up</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f6f8fa;
        }

        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-form {
            background-color: #fff;
            border: 1px solid #e1e4e8;
            border-radius: 6px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 300px;
            text-align: center;
            margin: 10px;
        }

        .login-form h2 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .login-input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            align-items: center;
        }

        .login-button {
            background-color: #28a745; /* Green color */
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            cursor: pointer;
        }

        .login-button:hover {
            background-color: #218838; /* Darker green for hover */
        }

        .error {
            color: #f00;
        }

        /* Style for the "Sign Up" button/link */
        .signup-link {
            text-decoration: none;
            color: #007bff; /* Blue color */
        }

        .signup-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <?php include 'db.php'; 
    session_start();
    ?>
    <div class="login-container">
        <div class="login-form">
            <h2>Login to Your Account</h2>

            <?php
            // Initialize variables to empty values
            $loginUsername = $loginPassword = "";
            $loginUsernameErr = $loginPasswordErr = "";
            if (isset($_SESSION['user_id'])) {
                // User is logged in
                header("Location: index.php"); // Redirect to the homepage
                exit();
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
                // Handle login submission
                if (empty($_POST["loginUsername"])) {
                    $loginUsernameErr = "Username is required";
                } else {
                    $loginUsername = $_POST["loginUsername"];
                }
                
                // Validate the password
                if (empty($_POST["loginPassword"])) {
                    $loginPasswordErr = "Password is required";
                } else {
                    $loginPassword = $_POST["loginPassword"];
                }

                $sql = "SELECT user_id, username, password FROM users WHERE username = ?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$loginUsername]);
                $user = $stmt->fetch();
            
                if ($user && password_verify($loginPassword, $user['password'])) {
                    // Successful login
                    session_start();
                    $_SESSION['user_id'] = $user['user_id'];
                    $_SESSION['username'] = $user['username'];
                    header("Location: index.php"); // Redirect to the homepage
                    exit();
                }
            }
            ?>

            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <label for="loginUsername">Username:</label>
                <input class="login-input" type="text" id="loginUsername" name="loginUsername" value="<?php echo $loginUsername; ?>">
                <span class="error"><?php echo $loginUsernameErr; ?></span><br>

                <label for="loginPassword">Password:</label>
                <input class="login-input" type="password" id="loginPassword" name="loginPassword">
                <span class="error"><?php echo $loginPasswordErr; ?></span><br>

                <button class="login-button" type="submit" name="login">Login</button>
            </form>
        </div>

        <div class="login-form">
            <h2>Sign Up for an Account</h2>

            <?php
            // Initialize variables to empty values
            $signupUsername = $signupPassword = $signupEmail = "";
            $signupUsernameErr = $signupPasswordErr = $signupEmailErr = "";

            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["signup"])) {
                // Handle sign-up submission
                if (empty($_POST["signupUsername"])) {
                    $signupUsernameErr = "Username is required";
                } else {
                    $signupUsername = $_POST["signupUsername"];
                }
                
                // Validate the password
                if (empty($_POST["signupPassword"])) {
                    $signupPasswordErr = "Password is required";
                } else {
                    $signupPassword = password_hash($_POST["signupPassword"], PASSWORD_DEFAULT);
                }
                //Validate the email
                if (empty($_POST["signupEmail"])) {
                    $signupEmailErr = "Email is required";
                } else {
                    $signupEmail = $_POST["signupEmail"];
                }

                $sql = "INSERT INTO users (username, password, email) VALUES (?, ?, ?)";
                $stmt = $pdo->prepare($sql);
                if ($stmt->execute([$signupUsername, $signupPassword, $signupEmail])) {
                    header("Location: index.php");
                    exit();
                } else {
                    // Registration failed (username is already in use)
                    echo "Username is already taken. Please choose another.";
                }
            }
            ?>

            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <label for="signupUsername">Username:</label>
                <input class="login-input" type="text" id="signupUsername" name="signupUsername" value="<?php echo $signupUsername; ?>">
                <span class="error"><?php echo $signupUsernameErr; ?></span><br>

                <label for="signupPassword">Password:</label>
                <input class="login-input" type="password" id="signupPassword" name="signupPassword">
                <span class="error"><?php echo $signupPasswordErr; ?></span><br>

                <label for="signupEmail">Email:</label>
                <input class="login-input" type="email" id="signupEmail" name="signupEmail" value="<?php echo $signupEmail; ?>">
                <span class="error"><?php echo $signupEmailErr; ?></span><br>

                <button class="login-button" type="submit" name="signup">Sign Up</button>
            </form>


            
        </div>
    </div>
</body>
</html>
