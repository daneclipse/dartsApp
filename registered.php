<?php 

$user_username = $_GET['username'];

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
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