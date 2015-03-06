<!DOCTYPE html>
<?php
	session_start();
?>
<html>
	<head>
		<link rel="stylesheet" href="/css/bootstrap.min.css">
		<script src="/js/jquery-1.11.1.min.js"></script>
		<script src="/js/bootstrap.min.js"></script>
	</head>
	<body>
		<nav class="navbar navbar-inverse" role="navigation">
		  <div class="container-fluid">
		    <!-- Brand and toggle get grouped for better mobile display -->
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </button>
		      <a class="navbar-brand" href="/">HopkinsClubs</a>
		    </div>
			
		    <!-- Collect the nav links, forms, and other content for toggling -->
		    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		      <ul class="nav navbar-nav navbar-right">
  				<?php					
					if (!isset($_SESSION["username"]) || !isset($_SESSION["password"])) {
		  				echo "<li><a href='/login.html'>Log In</a></li>";
					}
					else {
						echo "<li><a href='/logout.php'>Log Out " . $_SESSION["username"] . "</a></li>";
					}
  				?>
		      </ul>
		    </div><!-- /.navbar-collapse -->
		  </div><!-- /.container-fluid -->
		</nav>
		<center>
			<h1>HopkinsClubs - Club List</h1>
		</center>
		<?php
		$con=mysqli_connect("localhost","root","root","HopkinsClubs");
		// Check connection
		if (mysqli_connect_errno()) {
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}

		$result = mysqli_query($con,"SELECT * FROM Clubs ORDER BY id DESC");

		while($row = mysqli_fetch_array($result)) {
			echo "<p><a href='/club.php?id=" . $row{'id'} . "'>" . $row{'name'} . "</a><br>" . $row{'shortdescription'} . "</p><br>";
		}
		mysqli_close($con);
		?>
	</body>
</html>
