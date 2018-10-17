<?php 

include('connection.php');

$user_username = $_GET['username'];

$userQuery = mysqli_query($dbc, "SELECT * FROM users WHERE username='" . $user_username . "'");
$numRows = mysqli_num_rows($userQuery);
if ($numRows <= 0) 
{
	header('Location: index.php');
}

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/general.css">
	<style type="text/css">
		.navBar a {
			width: 20%;
			height: 100%;
			float: left;
		}
	</style>
</head>
<body>

<div class="navBar">
	<h1 class="accountName"><?= $user_username;?></h1>
	<a href="gameSetup.php?username=<?=$user_username;?>">Start a game</a>
	<a href="viewStats.php?username=<?=$user_username;?>">View stats</a>
	<a href="editAccount.php?username=<?=$user_username;?>">Edit account details</a>
	<span class="logOutButton"><a href="login.php">Log out</a></span>
</div>

<div class="page"></div>

</body>
</html>