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
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- CSS FILES -->
	<link rel="stylesheet" type="text/css" href="css/general.css">
	<link rel="stylesheet" type="text/css" href="css/account.css">
</head>
<body>

	<div class="page">
		<div class="user_area">
			<h2><?=$user_username;?></h2>
			<p>Logout</p>
		</div>
		
		<!-- AREA TO SHOW INFORMATION ABOUT EACH GAME -->
		<div class="account_areas">
			<div class="game_names">
				<div class="game_name game_selected" id="x01">
					<p>X01</p>
				</div>
				<div class="game_name" id="cricket">
					<p>Cricket</p>				
				</div>
				<div class="game_name" id="hundred">
					<p>100 Darts</p>			
				</div>
				<div class="game_name" id="nandc">
					<p>Noughts & Crosses</p>		
				</div>
				<div class="game_name" id="rtw">
					<p>Round the world</p>	
				</div>
			</div>
			<div class="game_info">
				<p>Traditional game of darts, where the first person to 0 by hitting a double wins the leg. Set up the game by selecting an opponent, target and legs needed to win the game. Game can be set up for a single player or play against a guest or user. After each leg you can view stats for each player. The winner is the person who wins the number of legs selected before the start of the game.</p>
				<a class="button greenButton" href="newGameSetup.php?username=<?=$user_username;?>&game=x01">start game</a>
			</div>
		</div>
		<!-- AREA THAT CYCLES THROUGH THE USERS STATS -->
		<div class="account_areas" id="user_stats">
			<div class="user_stats" id="x01_stats">
				<h2>X01 title</h2>
				<?php
					$stats = "SELECT * FROM userStats WHERE username = '$user_username'";
					$stats_query = mysqli_query($dbc, $stats);
					$numRows = mysqli_num_rows($stats_query);
					if ($numRows > 0) 
					{
						while($row = mysqli_fetch_array($stats_query))
						{
							$legsPlayed = $row['legsPlayed'];
							$legsWon = $row['legsWon'];
						}
						$average = ($legsWon / $legsPlayed) * 100;
						$winAverage = round($average, 2);
						echo 
						'<table>
							<tr>
								<th>Legs Played</th><th>Win %</th><th>Legs Won</th>
							</tr>
							<tr>
								<td>' . $legsPlayed . '</td><td>' . $winAverage . '</td><td>' . $legsWon . '</td>
							</tr>
						</table>';
					}
					else
					{
						echo 'no stats';
					}
				?>
			</div>
<!-- 			<div class="user_stats" id="cricket_stats">
				<h2>Cricket title</h2>
				<table><tr><th>Games Played</th><th>Win %</th><th>Games Won</th></tr><tr><td>0</td><td>0</td><td>0</td></tr></table>
			</div>
			<div class="user_stats" id="hundred_stats">
				<h2>100 Darts title</h2>
				<table><tr><th>Single %</th><th>Double %</th><th>Treble %</th></tr><tr><td>30</td><td>2</td><td>10</td></tr></table>
			</div>
			<div class="user_stats" id="nandc_stats">
				<h2>Noughts & crosses title</h2>
				<table><tr><th>Games Played</th><th>Win %</th><th>Games Won</th></tr><tr><td>15</td><td>20</td><td>3</td></tr></table>
			</div>
			<div class="user_stats" id="rtw_stats">
				<h2>RTW title</h2>
				<table><tr><th>Games Played</th><th>Hit %</th><th>Best Score</th></tr><tr><td>50</td><td>60</td><td>100</td></tr></table>
			</div> -->
		</div>
	</div>


<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
  <script type="text/javascript">
  	var gameTabs = $('.game_name');
  	gameTabs.on('click', function()
  	{
  		for (var i = 0; i < gameTabs.length; i++) 
  		{
  			$(gameTabs).removeClass('game_selected');
  			$(this).addClass('game_selected');
  			if ($(this).attr('id') == 'x01') 
  			{
  				$('.game_info').html(x01_info);
  			}
  			else
  			{
  				$('.game_info').empty();
  			}
  		}
  	})

  	var x01_info = '<p>Traditional game of darts, where the first person to 0 by hitting a double wins the leg. Set up the game by selecting an opponent, target and legs needed to win the game. Game can be set up for a single player or play against a guest or user. After each leg you can view stats for each player. The winner is the person who wins the number of legs selected before the start of the game.</p>';
 //  	var myIndex = 0;
 //  	function carousel() 
 //  	{
	//     var x = $('.user_stats');
	//     for (var i = 0; i < x.length; i++) 
	//     {
	//        x[i].style.display = "none";  
	//     }
	//     myIndex++;
	//     if (myIndex > x.length) {myIndex = 1}    
	//     x[myIndex-1].style.display = "block";  
	//     setTimeout(carousel, 5000); // Change image every 5 seconds
	// }

	// carousel();
 
  </script>
</body>
</html>