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
	$count = mysqli_query($con, "SELECT count(1) FROM Clubs");
	$count = mysqli_fetch_array($count);
	
	$name = mysqli_real_escape_string($con, $_POST['name']);
	$sdescription = mysqli_real_escape_string($con, $_POST['sdescription']);
	$imgurl = mysqli_real_escape_string($con, $_POST['imgurl']);
	$description = mysqli_real_escape_string($con, $_POST['description']);
	
	
	$sql="INSERT INTO Clubs (id, name, description, shortdescription, imgurl)
	VALUES ('$count[0]', '$name', '$description', '$sdescription', '$imgurl')";

	if (!mysqli_query($con, $sql)) {
		die('Error: ' . mysqli_error($con));
	}
	
	header("Location: club.php?id=" . $count[0]);
}

else {
	echo "An error has occured.";
}

mysqli_close($con);
?>