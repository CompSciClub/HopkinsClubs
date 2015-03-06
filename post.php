<?php
session_start();

$con=mysqli_connect("localhost","root","root","HopkinsClubs");
if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$username = $_SESSION["username"];
$password = $_SESSION["password"];
$result = mysqli_query($con, "SELECT * FROM Users WHERE username='$username'");
$row = mysqli_fetch_array($result);

if ($row['password'] == $password) {
	
	$title = mysqli_real_escape_string($con, $_POST['title']);
	$post = mysqli_real_escape_string($con, $_POST['post']);
	$id = mysqli_real_escape_string($con, $_POST['id']);
	
	$sql="INSERT INTO Posts (pageid, title, author, post)
	VALUES ('$id', '$title', '$username', '$post')";

	if (!mysqli_query($con, $sql)) {
		die('Error: ' . mysqli_error($con));
	}
	
	header("Location: club.php?id=" . $id);
}

else {
	echo "An error has occured.";
}

mysqli_close($con);
?>