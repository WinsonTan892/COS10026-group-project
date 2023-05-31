<?php
session_start();

require_once("settings.php");
$conn = mysqli_connect($host, $user, $pwd, $sql_db);

if (!$conn) {
    die('Failed to connect to the database: ' . mysqli_connect_error());
}

function sanitize($connection, $data) {
    $data = trim($data);
    $data = mysqli_real_escape_string($connection, $data);
    return $data;
}

// Login Form Submission
if (isset($_POST['login'])) {
    $username = sanitize($conn, $_POST['username']);
    $password = sanitize($conn, $_POST['password']);

    // Fetch the manager record from the database
    $query = "SELECT * FROM managers WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        $storedPassword = $row['password'];

        // Verify the password
        if ($password === $storedPassword) {
            // Login successful, store username in session and redirect to manage.php
            $_SESSION['username'] = $username;
            header("Location: manage.php");
            exit();
        } else {
            $loginError = "Invalid username or password.";
        }
    } else {
        $loginError = "Invalid username or password.";
    }
}

mysqli_close($conn);
?>
<?php include 'header.inc'; ?>
    <title>Manager Login</title>
</head>
<body>
    <h1 id="manage_heading">Manager Login</h1>

    <hr>

    <?php if (isset($_SESSION['registrationSuccess']) && $_SESSION['registrationSuccess']) { ?>
        <p>Registration successful. You can now login.</p>
        <?php unset($_SESSION['registrationSuccess']); ?>
    <?php } ?>

    <?php if (isset($loginError)) { ?>
        <p><?php echo $loginError; ?></p>
    <?php } ?>

    <h2 id="manage_mini_headings_login">Login:</h2>
    <form method="POST" action="" id="manage_form_login" class="manage_input_color">
        <label for="username" id="manage_label_login">Username:</label>
        <input type="text" name="username" id="username" class="manage_drop_menu" required>
        <br><br>
        <label for="password" id="manage_label_login">Password:</label>
        <input type="password" name="password" id="password"required>
        <br><br>
        <input type="submit" name="login" value="Login">
        <br><br>
        <a href="regmanager.php"><button type="button">Register</button></a>
    </form>
    <?php include 'footer.inc'; ?>
</body>
</html>
