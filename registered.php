<?php 

$user_username = $_GET['username'];

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/general.css">
	<style type="text/css">
		.navBar h1 {
			width: 33.3%;
		}
	</style>
</head>
<body>

	<div class="navBar">
		<h1 class="accountName"><?= $user_username ;?></h1>
		<a href="login.php">Log in</a>
		<a href="index.php">Home</a>
	</div><!-- CLOSES DIV WITH CLASS NAVBAR -->

	<div class="page">
		<h1>Registered, please now log in</h1>
		<button class="logIn"><a href="login.php">Log in</a></button>
	</div>

</body>
</html>