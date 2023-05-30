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

// Registration Form Submission
if (isset($_POST['register'])) {
    $username = sanitize($conn, $_POST['username']);
    $password = sanitize($conn, $_POST['password']);

    // Validate unique username
    $checkUsernameQuery = "SELECT * FROM managers WHERE username = '$username'";
    $checkUsernameResult = mysqli_query($conn, $checkUsernameQuery);

    if (mysqli_num_rows($checkUsernameResult) > 0) {
        $registrationError = "Username already exists. Please choose a different username.";
    } else {
        // Validate password rule (minimum length of 6 characters)
        if (strlen($password) < 6) {
            $registrationError = "Password must be at least 6 characters long.";
        } else {
            // Hash the password before storing it in the database

            // Insert the new manager record into the database
            $insertQuery = "INSERT INTO managers (username, password) VALUES ('$username', '$password')";
            $insertResult = mysqli_query($conn, $insertQuery);

            if ($insertResult) {
                // Registration successful, redirect to login page
                $_SESSION['registrationSuccess'] = true;
                header("Location: manager_login.php");
                exit();
            } else {
                $registrationError = "Registration failed. Please try again.";
            }
        }
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manager Registration</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <h1 id="manage_heading">Manager Registration</h1>
    <hr>

    <?php if (isset($registrationError)) { ?>
        <p><?php echo $registrationError; ?></p>
    <?php } ?>

    <h2 id="manage_mini_headings_login">Register:</h2>
    <form method="POST" action="" id="manage_form_login" class="manage_input_color">
        <label for="username" id="manage_label_login">Username:</label>
        <input type="text" name="username" id="username" class="manage_drop_menu" required>
        <br>
        <br>
        <label for="password" id="manage_label_login">Password:</label>
        <input type="password" name="password" id="password" required>
        <br>
        <br>
        <input type="submit" name="register" value="Register">
        <br><br>
		<a href="manager_login.php"><button type="button">Go Back</button></a>
    </form>
</body>
</html>

