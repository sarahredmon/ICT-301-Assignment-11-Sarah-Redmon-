<html>
<body>
<center>
<table width="700" cellpadding="10">
<tr><td>
<?php
session_start();
if (!empty($_SESSION['email'])) {
    echo "<a href=loggedin.php>Home<a> |
        <a href=logout.php>Logout<a><br><br>";
    echo "<h2>Thank you, " . $_SESSION['first_name'] . "<h2><br>";
    echo "<h2> You are logged in! <h2>";
    echo "Your email is " . $_SESSION['email'];
}
?>
</td></tr>
</table>
</center>
</body>
</html>