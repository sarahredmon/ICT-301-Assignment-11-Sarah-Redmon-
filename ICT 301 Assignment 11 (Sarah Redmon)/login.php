<?php
// Check if the form has been submitted:
$email = $_POST['email'];
$pass = $_POST['pass'];
$errors = []; // Initialize error array.

if (empty($email)) {
        $errors[] = 'You forgot to enter your email address.';
    }

if (empty($pass)) {
        $errors [] = 'You forgot to enter your password.';
    }


if (!empty($email) && !empty($pass)) {
        require_once('mysqli_connect.php');
        $q = "SELECT * FROM users WHERE email='$email' AND pass=SHA2 ('$pass', 512) ";
        $result = @mysqli_query($dbc, $q); // Run the query.
        $row = mysqli_fetch_array ($result, MYSQLI_ASSOC);
        if ($row) {
            session_start();
            $_SESSION['id'] = $row['id'];
            $_SESSION['first_name'] = $row['first_name'];
            $_SESSION['last_name'] = $row['last_name'];
            $_SESSION['email'] = $row['email'];
            // Redirect
            header("Location: loggedin.php");
            
            exit(); // Quit the script
        }
}

$errors[] = 'Your email address and password do not match.';
if (!empty($errors)) {
    echo '<h1>Error!</h1>
    <p>The following error (s) occurred: <br>';
    foreach ($errors as $msg) {
        echo "$msg<br>";
    }
    echo '</p><p><a href=index.php>Please try again.</a></p>';
}

mysqli_close($dbc); // Close the database connection.
?>