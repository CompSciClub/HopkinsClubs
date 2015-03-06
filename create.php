<!DOCTYPE html>
<?php
	session_start();
	if (!isset($_SESSION["username"]) || !isset($_SESSION["password"])) {
		session_unset();
		session_destroy();
		echo "<script>window.location = 'login.html';</script>";
		exit();
	}
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
					echo "<li><a href='/logout.php'>Log Out " . $_SESSION["username"] . "</a></li>";
  				?>
		      </ul>
		    </div><!-- /.navbar-collapse -->
		  </div><!-- /.container-fluid -->
		</nav>
		<center>
			<h1>Create a Club</h1>
			<form action="createclub.php" method="post"> 
				Club Name: <input type="text" name="name" />
				<br />
				Short Description: <input type="text" name="sdescription" />
				<br />
				Image Url: <input type="text" name="imgurl" />
				<br />
				<p>Description:</p> <textarea name="description"></textarea>
				<br />
				<br />
				<input type="submit" value="Create"/></a>
			</form>
		</center>
	</body>
</html>