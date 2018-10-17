<?php

include('connection.php');

$user_username = $_GET['username'];

$getData = "SELECT * FROM users WHERE username='" . $user_username . "'";
$dataQuery = mysqli_query($dbc, $getData);
$dataRows = mysqli_num_rows($dataQuery);

if ($dataRows > 0) {
	while ($rowData = mysqli_fetch_array($dataQuery)) 
	{
		$dbUsername = $rowData['username'];
		$dbPassword = $rowData['password'];
	}
}

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
		<h1 class="accountName"><?= $user_username;?></h1>
		<a href="account.php?username=<?=$user_username;?>">Back to account</a>
		<span class="logOutButton"><a href="login.php" >Log out</a></span>
	</div>

	<div class="page">
		<div class="form">
			<h2>Change Username</h2>
			<?php
				if ($_GET['message'] == 'success') 
				{
					echo '<p class="greenButton alertMessage">Username changed</p>';
				}
				if (isset($_POST['submitUsername'])) 
				{
					$newUsername = $_POST['newUsername'];
					$confirmPassword = $_POST['password'];

					if (!empty($newUsername) && !empty($confirmPassword)) 
					{
						if ($dbPassword === $confirmPassword) 
						{
							$checkName = "SELECT * FROM users WHERE username='" . $newUsername . "'";
							$checkQuery = mysqli_query($dbc, $checkName);
							$result = mysqli_num_rows($checkQuery);
							if ($result > 0) 
							{
								echo '<p class="redButton alertMessage">Username not available</p>';
							}
							else
							{
								$updateUsers = mysqli_query($dbc, "UPDATE users SET username='$newUsername' WHERE username='$user_username'");
								$updateUserStats = mysqli_query($dbc, "UPDATE userStats SET username='$newUsername' WHERE username='$user_username'");
								$updateLegStats = mysqli_query($dbc, "UPDATE legStats SET username='$newUsername' WHERE username='$user_username'");
								$rows = mysqli_affected_rows($dbc);
								if ($rows > 0) 
								{
									header('Location: editAccount.php?username='.$newUsername.'&message=success');
								}
								else
								{
									echo '<p class="redButton alertMessage">System error - username not changed!</p>';
								}
							}
						}
						else
						{
							echo '<p class="redButton alertMessage">Incorrect password</p>';
						}
					}
					else
					{
						echo '<p class="redButton alertMessage">Fill out all fields</p>';
					}
				}
			?>
			<form action="editAccount.php?username=<?=$user_username;?>" method="post">
				<input type="text" name="newUsername" placeholder="New Username">
				<input type="password" name="password" placeholder="Password">
				<input class="submitForm" type="submit" name="submitUsername" value="Change Username">
			</form>
		</div>

		<br />

		<div class="form">
			<?php 
				if (isset($_POST['submitPassword'])) 
				{
					$currentPassword = $_POST['password'];
					$newPassword = $_POST['newPassword'];
					$confirmNewPassword = $_POST['confirmNewPassword'];

					if (!empty($currentPassword) && !empty($newPassword) && !empty($confirmNewPassword)) 
					{
						if ($dbPassword === $currentPassword) 
						{
							if ($newPassword === $confirmNewPassword) 
							{
								$updatePassword = mysqli_query($dbc, "UPDATE users SET password='$newPassword' WHERE username='$user_username'");
								$rows = mysqli_affected_rows($dbc);
								if ( $rows > 0) 
								{
									echo '<p class="greenButton alertMessage">Password changed</p>';
								}
								else
								{
									echo '<p class="redButton alertMessage">System error - password not changed!</p>';
								}
							}
							else
							{
								echo '<p class="redButton alertMessage">Password dont match</p>';
							}
						}
						else
						{
							echo '<p class="redButton alertMessage">Incorrect password</p>';
						}
					}
					else
					{
						echo '<p class="redButton alertMessage">Fill out all fields</p>';
					}
				}
			?>
			<h2>Change Password</h2>
			<form action="editAccount.php?username=<?=$user_username;?>" method="post">
				<input type="password" name="password" placeholder="Current Password">
				<input type="password" name="newPassword" placeholder="New Password">
				<input type="password" name="confirmNewPassword" placeholder="Confirm Password">
				<input class="submitForm" type="submit" name="submitPassword" value="Change Password">
			</form>
		</div>
	</div>

<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>

<script type="text/javascript">
	var alertMessage = $('.alertMessage');
	$(alertMessage).slideDown(1000, function(){
		setTimeout(function(){
			$(alertMessage).slideUp(500)
		}, 2000);
	})
</script>

</body>
</html>