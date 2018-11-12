<!-- USED TO BE LOGIN.PHP -->

<?php

include('connection.php');

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- CSS FILES -->
	<link rel="stylesheet" type="text/css" href="css/general.css">
</head>
<body>
	<div class="page">
		<div class="form smallForm">
			<div class="messages">
				<?php 

					if (isset($_POST['submit'])) 
					{
						$user_username = $_POST['username'];
						$user_password = $_POST['password'];

						if (!empty($user_username) && !empty($user_password)) 
						{
							include('connection.php');

							$select = "SELECT * FROM users WHERE username='" . $user_username . "'";
							$selectQuery = mysqli_query($dbc, $select);
							$selectRows = mysqli_num_rows($selectQuery);

							if ($selectRows > 0) 
							{
								while ($row = mysqli_fetch_array($selectQuery)) 
								{
									$dbPassword = $row['password'];	
									if ($dbPassword === $user_password) 
									{
										header('Location: account.php?username=' . $user_username);
									}
									else
									{
										echo '<p class="redButton alertMessage">Incorrect password</p>';
									}
								}
							}
							else
							{
								echo '<p class="redButton alertMessage">Invalid username</p>';
							}
							
						}
						else
						{
							header('Location: index.php');
						}
					}

				?>
			</div>
			<form action="index.php" method="post">
				<div class="form_inputs smallForm_inputs">	
					<input type="text" name="username" placeholder="Username">
					<input type="password" name="password" placeholder="Password">
				</div>
				<input class="button greenButton" type="submit" name="submit" value="Log in">
			</form>
		</div><!-- CLOSES DIV WITH CLASS FORM -->
		<p class="form_message"><a href="register.php">dont have an account? sign up</a></p>
	<!-- 	<p><a href="newGameSetup.php">dont want an account, play a quick game</a></p> -->
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