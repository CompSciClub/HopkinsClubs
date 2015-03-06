<?php
$con=mysqli_connect("localhost","root","root","Hopkinsclubs");
if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$username = mysqli_real_escape_string($con, $_POST['username']);
$password = mysqli_real_escape_string($con, $_POST['password']);
$email = mysqli_real_escape_string($con, $_POST['email']);
define("MAX_LENGTH", 6);
$intermediateSalt = md5(uniqid(rand(), true));
$salt = substr($intermediateSalt, 0, MAX_LENGTH);
$password = hash("sha256", $password . $salt);

$sql="INSERT INTO Users (username, password, email, salt)
VALUES ('$username', '$password', '$email' , '$salt')";

if (!mysqli_query($con,$sql)) {
	die('Error: ' . mysqli_error($con));
}
header("Location: /login.html");

mysqli_close($con);
?>