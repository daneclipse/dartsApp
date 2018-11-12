<?php

$user_username = $_GET['username'];
$game = $_GET['game'];

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- CSS FILES -->
	<link rel="stylesheet" type="text/css" href="css/general.css">
	<link rel="stylesheet" type="text/css" href="css/account.css">
	<link rel="stylesheet" type="text/css" href="css/gameSetup.css">
	<style type="text/css">

	</style>
</head>
<body>

	<div class="navBar">
		<div class="navbar_image" id="user_div">
			<a href="editAccount.php?username=<?=$user_username;?>">
				<img src="images/white_icons/user_icon.png" id="user_icon">
			</a>
		</div>
		<p class="logOutButton"><a href="index.php">log out</a></p>
		<div class="navbar_image">
			<a href="account.php?username=<?=$user_username;?>">
				<img src="images/white_icons/home_icon.png">
			</a>
		</div>
		<div class="navbar_image icon_clicked">
			<a href="newGameSetup.php?username=<?=$user_username;?>">
				<img src="images/white_icons/game_icon.png">
			</a>
		</div>
		<div class="navbar_image">
			<img src="images/white_icons/stats_icon.png">
		</div>
	</div>

	<div class="page">
		<?php

		if (!isset($_GET['username'])) 
		{
			echo '<div class="form"><form action="newGameSetup.php" method="get"><input type="text" name="username" placeholder="Name"><br /><input class="button greenButton" type="submit" value="Enter name"></form></div><p><a href="index.php">already have an account, log in</a></p>';
			$name = $_GET['username'];
			header('newGameSetup.php?username=' .$name);
		}
		else 
		{
			echo '
				<h1 class="accountName">Welcome, ' . $user_username . '</h1>
				<div class="content">
					<div class="listOfGames">
						<div class="game game_clicked" id="trad">
							<p>X01</p>
						</div>
						<div class="game" id="cricket">
							<img src="images/cricket_icon.png">
						</div>
						<div class="game" id="rtw">
							<img src="images/rtw_icon.png">
						</div>
						<div class="game" id="nandc">
							<img src="images/nandc_icon.png">
						</div>
						<div class="game" id="darts">
							<img src="images/dart_icon.png">
						</div>
					</div>
					<div class="game_info">
						<div class="game_text">
							<h2>X01</h2>
							<p>set up game</p>
						</div>
						<a href="gameSetup.php?username=<?=$user_username;?>" class="button greenButton">start game</a>
					</div>	
				</div>';
		}

		?>

		<div class="opponent">
			<?php

				if ($_SERVER['REQUEST_METHOD'] == 'POST') 
				{
					include('connection.php');

					$opponentUsername = $_POST['opponentUsername'];
					$opponentPassword = $_POST['opponentPassword'];

					if (!empty($opponentUsername) && !empty($opponentPassword)) 
					{
						$selectOpp = "SELECT * FROM users WHERE username='" . $opponentUsername . "'";
						$selectOppQuery = mysqli_query($dbc, $selectOpp);
						$numRows = mysqli_num_rows($selectOppQuery);

						if ($numRows > 0) {
							while($row = mysqli_fetch_array($selectOppQuery))
							{
								$oppUsername = $row['username'];
								$oppPassword = $row['password'];

								if ($opponentPassword === $oppPassword) 
								{
									if ($oppUsername === $user_username) 
									{
										echo '<p class="alertMessage redButton">User already logged in, choose another player</p>';
									}
									else
									{
										if (isset($_GET['game'])) 
										{
											$game = $_GET['game'];
											if ($game == 'cricket') 
											{
												if (isset($_GET['innings'])) 
												{
													$innings = $_GET['innings'];
													header('Location: cricket/cricketGame.php?username='.$user_username.'&opponent='.$oppUsername.'&innings='.$innings);
												}
											}
											else if ($game == 'ticTacToe')
											{
												if (isset($_GET['games'])) 
												{
													$games = $_GET['games'];
													header('Location: noughts&crosses/noughts&crosses.php?username='.$user_username.'&opponent='.$oppUsername.'&games='.$games);
												}
											}
										}
										else
										{
											header('Location: gameSetupUser.php?username='.$user_username.'&opponent='.$oppUsername);
										}
									}
								}
								else
								{
									echo '<p class="alertMessage redButton">Password incorrect</p>';
								}
							}
						}
						else
						{
							echo '<p class="alertMessage redButton">No user found</p>';
						}
					}
					else
					{
						echo 'Enter opponents account details';
					}
				}

			?>
		</div>

	</div>

<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
  

</body>
</html>