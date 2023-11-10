<!-- header.php -->

<header>
    <style> 
    .login-button, .logout-button {
        display: inline-block;
        padding: 10px 20px;
        margin: 0 10px;
        background-color: #007bff;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    .login-button:hover, .logout-button:hover {
        background-color: #0056b3;
    }

    .logged-in {
        background-color: #28a745;
    }

    .logged-in:hover {
        background-color: #218838;
    }

    </style>
    <link rel="stylesheet" href="styles.css">
    <div class="logo">
        <!-- Add logo image or text here -->
        <a href="index.php">Logo</a>
    </div>
    <nav>
    <div class="search-bar">
        <input type="text" placeholder="Search">
        <button>Search</button>
    </div>
        <ul class = "header-links">
            <li><a href="community.php">Community</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="destinations.php">Destinations</a></li>
            <li><a href="travel.php">Travel</a></li>
            <li><a href="tips.php">Tips</a></li>
            <li><a href="resources.php">Resources</a></li>
        </ul>
    </nav>
    <button class="login-button"><a href = "login.php">Login</a></button>
    <button class="logout-button"><a href = "logout.php">Logout</a></button>
</header>


