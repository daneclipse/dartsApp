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
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
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