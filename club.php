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
			<?php
			$con=mysqli_connect("localhost","root","root","HopkinsClubs");
			// Check connection
			if (mysqli_connect_errno()) {
				echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}
			
			$id = $_GET['id'];
			$result = mysqli_query($con, "SELECT * FROM Clubs WHERE id='$id'");
			$row = mysqli_fetch_array($result);
			
			echo "<img src='" . $row{'imgurl'} . "'style='width:500px;height:200px'></img>";
			echo "<h1>" . $row{'name'} . "</h1>";
			echo "<p>" . $row{'description'} . "</p>";
			
			echo "</center>";
			
			$result = mysqli_query($con,"SELECT * FROM Posts WHERE pageid='$id'");
			while($row = mysqli_fetch_array($result)) {
				echo "<h3>" . $row{'title'} . "</h3><h6>By: " . $row{'author'} . "</h6><p>" . $row{'post'} . "</p><br>";
			}
			
			//check user account for posting
			if (isset($_SESSION["username"]) || isset($_SESSION["password"])) {
				echo "<form action='post.php' method='post'> 
					Title: <input type='text' name='title' />
					<br />
					<p>Post:</p>
					<textarea name='post'></textarea>
					<br />
					<input type='submit' value='Post'/><input style='visibility: hidden;' type='text' name='id' value='" . $id . "' />
				</form>";
			}					
			
			mysqli_close($con);
			?>
	</body>
</html>