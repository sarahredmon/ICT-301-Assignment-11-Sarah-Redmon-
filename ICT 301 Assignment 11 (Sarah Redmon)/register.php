<?php
if (isset($_POST['submitted'])) {
	$errors = [];
	require_once('mysqli_connect.php');
	if (empty($_POST['first_name'])) {
		$errors[] = 'You forgot to enter your first name.';
	} else {
		$first_name = mysqli_real_escape_string($dbc, $_POST['first_name']);
	}
	if (empty($_POST['last_name'])) {
		$errors[] = 'You forgot to enter your last name.';
	} else {
		$last_name = mysqli_real_escape_string($dbc, $_POST['last_name']);
	}
	if (empty($_POST['email'])) {
		$errors[] = 'You forgot to enter your email address.';
	} else {
		$email = mysqli_real_escape_string($dbc, $_POST['email']);
	}
	if (!empty($_POST['password1']) && !empty($_POST['password2'])) {
		if ($_POST['password1'] != $_POST['password2']) {
			$errors[] = 'Your password did not match the confirmed password.';
		} else {
			$password = $_POST['password1'];
		}
	} else {
		$errors[] = 'You forgot to enter your password.';
	}
	if (empty($errors)) {
		$query = "SELECT * FROM users WHERE email='$email'";
		$result = mysqli_query($dbc, $query);
		if (mysqli_num_rows($result) == 0) {
			$query = "INSERT INTO users (first_name, last_name, email, pass, registration_date)
			VALUES ('$first_name', '$last_name', '$email', SHA2('$password', 512), NOW() )";
			$result = @mysqli_query ($dbc, $query);
			if ($result) {
				echo "<p>You are now registered. Please, login to our website.</p>";
				echo "<a href=index.php>Login</a>";
				mysqli_close($dbc);
				exit();
			} else { 
				$errors[] = 'You could not be registered due to a system error. We apologize for any inconvenience.';
				$errors[] = mysqli_error($dbc);
			}
		} else {
			$errors[] = 'The email address has already been registered.';
		}
	}
	
	if(!empty($errors)){
		echo '<h1>Error!</h1>
		<p>The following error(s) occurred:<br />';
		foreach ($errors as $msg) {
			echo "$msg<br>";
		}
		echo '</p><p>Please try again.</p>';
	}
	mysqli_close($dbc);
}
?>

<h2>Register</h2>
<form action="register.php" method="post">
	<p>First Name: <input type="text" name="first_name" size="15" maxlength="20"/></p>
	<p>Last Name: <input type="text" name="last_name" size="15" maxlength="40"/></p>
	<p>Email Address: <input type="text" name="email" size="20" maxlength="60"/></p>
	<p>Password: <input type="password" name="password1" size="10" maxlength="20"/></p>
	<p>Confirm Password: <input type="password" name="password2" size="10"  maxlength="20" /></p>
	<p><input type="submit" name="submitted" value="Register"></p>
</form>