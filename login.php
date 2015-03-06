<?php
session_start();
session_unset();
session_destroy();

$con=mysqli_connect("localhost","root","root","HopkinsClubs");
if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$username = mysqli_real_escape_string($con, $_POST['username']);
$password = mysqli_real_escape_string($con, $_POST['password']);
$result = mysqli_query($con, "SELECT * FROM Users WHERE username='$username'");
$row = mysqli_fetch_array($result);
$salt = $row['salt'];
$password = hash("sha256", $password . $salt);

if ($row['password'] == $password) {
	session_start();
	$_SESSION["username"] = $username;
	$_SESSION["password"] = $password;
	header("Location: index.php");
}
else {
	echo "Invalid Login.";
}

mysqli_close($con);
?>