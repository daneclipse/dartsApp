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
</head>
<body>


<!-- <div class="navBar">
	<div class="accountName">
		<h1><?= $user_username;?></h1>
		<span class="logOutButton"><a href="index.php">Log out</a></span>
	</div>
	<a href="editAccount.php?username=<?=$user_username;?>">Edit account details</a>
	<p id="gamesButton">Start a game</p>
	<div class="listOfGames hide">
		<a href="newGameSetup.php?username=<?=$user_username;?>">X01</a>
		<a href="newGameSetup.php?username=<?=$user_username;?>">Cricket</a>
		<a href="newGameSetup.php?username=<?=$user_username;?>">100 Darts</a>
		<a href="newGameSetup.php?username=<?=$user_username;?>">Round the world</a>
		<a href="newGameSetup.php?username=<?=$user_username;?>">Tic Tac Toe</a>
	</div>

	<p id="statsButton">View Stats</p>
	<div class="listOfStats hide">
		<a href="X01/viewX01Stats.php?username=<?=$user_username;?>">X01</a>
		<a href="newGameSetup.php?username=<?=$user_username;?>">Cricket</a>
		<a href="newGameSetup.php?username=<?=$user_username;?>">100 Darts</a>
		<a href="newGameSetup.php?username=<?=$user_username;?>">Round the world</a>
		<a href="newGameSetup.php?username=<?=$user_username;?>">Tic Tac Toe</a>
	</div>
</div> 


<div class="page">
	<div class="gameOptions">
		<div class="gameOption">
			<h2>X01</h2>
			<p class="gameInfo hidden" id="x01Info">
				Traditional game of darts. Can select target score, number of players & number of legs.
			</p>
			<p class="showGameInfo fa fa-info-circle"></p>
		</div>

		<div class="gameOption">
			<h2>100 Darts</h2>
			<p class="gameInfo hidden" id="x01Info">
				Choose a target to throw 100 darts at, score the maximum points possible.
			</p>
			<p class="showGameInfo fa fa-info-circle"></p>
		</div>

		<div class="gameOption">
			<h2>Cricket</h2>
			<p class="gameInfo hidden" id="x01Info">
				Bowler needs to bowl the batsman out for the lowest score possible. Get a wicket by hitting the bullseye and score runs by scoring over 41.
			</p>
			<p class="showGameInfo fa fa-info-circle"></p>
		</div>

		<div class="gameOption">
			<h2>Round the world</h2>
			<p class="gameInfo hidden" id="x01Info">
				Hit every number on the board in the least darts possible.
			</p>
			<p class="showGameInfo fa fa-info-circle"></p>
		</div>

		<div class="gameOption">
			<h2>Tic Tac Toe</h2>
			<p class="gameInfo hidden" id="x01Info">
				Game of tic tac toe, using targets on the dartboard.
			</p>
			<p class="showGameInfo fa fa-info-circle"></p>
		</div>
	</div>
</div> -->

<div class="navBar">
	<div class="navbar_image" id="user_div">
		<a href="editAccount.php?username=<?=$user_username;?>">
			<img src="images/white_icons/user_icon.png" id="user_icon">
		</a>
	</div>
	<p class="logOutButton"><a href="index.php">log out</a></p>
	<div class="navbar_image icon_clicked">
		<a href="account.php?username=<?=$user_username;?>">
			<img src="images/white_icons/home_icon.png">
		</a>
	</div>
	<div class="navbar_image">
		<a href="newGameSetup.php?username=<?=$user_username;?>">
			<img src="images/white_icons/game_icon.png">
		</a>
	</div>
	<div class="navbar_image">
		<img src="images/white_icons/stats_icon.png">
	</div>
</div>

<div class="page">
	<h1 class="accountName">Welcome, <?=$user_username;?></h1>
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
				<p>X01 is a traditional game of darts, where the first person to hit the target possible, ending on a double, wins the game.</p>
			</div>
			<a href="gameSetup.php?username=<?=$user_username;?>" class="button greenButton">start game</a>
		</div>
		
	</div>
</div>



<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
  <script type="text/javascript">
  	var nav_icons = $('.navbar_image');
  	$(nav_icons).on('click', function()
  	{
  		for (var i = 0; i < icons.length; i++) 
  		{
  			if ($(nav_icons[i]).hasClass('icon_clicked')) 
  			{
  				$(nav_icons[i]).removeClass('icon_clicked');
  			}
  		}
  		$(this).addClass('icon_clicked');
  	})

  	var game_icons = $('.game');
  	$(game_icons).on('click', function()
  	{
  		for (var i = 0; i < game_icons.length; i++) 
  		{
  			if ($(game_icons[i]).hasClass('game_clicked')) 
  			{
  				$(game_icons[i]).removeClass('game_clicked');
  			}
  		}
  		$(this).addClass('game_clicked');
  		var id = $(this).attr('id');
  		if (id == 'trad') 
  		{
	  		$('.game_text').html(traditional);
	  	}
	  	else if (id == 'cricket')
	  	{
	  		$('.game_text').html(cricket);
	  	}
	  	else if (id == 'rtw')
	  	{
	  		$('.game_text').html(rtw);
	  	}
	  	else if (id == 'nandc')
	  	{
	  		$('.game_text').html(nandc);
	  	}
	  	else if (id == 'darts')
	  	{
	  		$('.game_text').html(darts)
	  	}
	  	else
	  	{
	  		$('.game_text').empty();
	  	}
  	})

  	var traditional = '<h2>X01</h2><p>X01 is a traditional game of darts, where the first person to hit the target possible, ending on a double, wins the game.</p>';
  	var cricket = '<h2>Cricket</h2><p>Cricket is a game between two players, one bowler, one batsman. The bowler has to hit 10 bullseye to bowl the batsman out. The batsman scores runs for every score over 41.</p>';
  	var rtw = '<h2>Round the world</h2><p>Round the world is a single player game, where the player needs to hit every section of the dart board, in the fewest darts possible.</p>';
  	var nandc = '<h2>Tic tac toe</h2><p>Typical game of tic tac toe, but to get a marker on the board you have to hit designated targets on the dartboard.<p>';
  	var darts = '<h2>100 Darts</h2><p>Single player game, where the player chooses a target and has 100 darts to throw, scoring as high as possible.</p>';

  </script>
</body>
</html>