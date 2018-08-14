<?php
session_start();
?>

<!DOCTYPE html>
<?php error_reporting(E_ALL) ?>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<link rel="stylesheet" type="text/css" href="style.css">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">	
	</head>
<body>

<header>
<nav>

<div class="main-wrapper">
	<ul id="headButtons">
		<li><a href="index.php">Home</a></li>
		<li><a href="about.php">About</a></li>
		<li><a href="gallery.php">Gallery</a></li>
		<li><a href="contact.php">Contact</a></li>
		<?php
		if (isset($_SESSION['u_id'])){
			echo '<li><a href="forum.php">Forum</a></li>';
			}
		?>
		
	</ul>
	<div class="nav-login">
		<?php
		if (isset($_SESSION['u_id'])){
			echo '<form action="includes/logout.inc.php" method="POST">
			<button type="submit" name="submit">Logout</button>
			</form>';
		} else {
			echo '<form action="includes/login.inc.php" method="POST">
			<input type="text" name="uid" placeholder="Username/Email">
			<input type="password" name="pwd" placeholder="Password">
			<button type="submit" name="submit">Login</button>
			</form>
			<a href="signup.php">Register</a>';
		} if (isset($_SESSION['u_id'])) {
			echo '<a href="userSettings.php">Settings</a>';
		}
		?>
		
	</div>
</div>
</nav>
</header>
