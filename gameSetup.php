<?php

$user_username = $_GET['username'];
$game = $_GET['game'];

$opp_username = $_POST['opp_username'];
$opp_password = $_POST['opp_password'];

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
	<link rel="stylesheet" type="text/css" href="css/setup.css">
</head>
<body>
	<div class="page">
		<div class="user_area">
			<a href="editAccount.php?username=<?=$user_username;?>"><img src="images/user_icon.png"></a>
			<h2><?=$user_username;?></h2>
			<a class="logOutButton" href="index.php">Logout</a>
		</div>
		<select id="change_game">
			<option value="none">Change Game</option>
			<option value="cricket">Cricket</option>
			<option value="hundred">100 Darts</option>
			<option value="nandc">Noughts & Crosses</option>
			<option value="rtw">Round The World</option>
		</select>
		<div class="game_setup">
			<div class="setup_option" id="setup_opp">
				<h2>Select Opponent</h2>
				<p class="option opp_option">single player</p>
				<p class="option opp_option">v guest</p>
				<p class="option opp_option">v user</p>
				<div class="opponent"></div>
			</div>
			<div class="setup_option opaque" id="setup_target">
				<h2>Choose Target</h2>
				<p class="option game_target">1001</p>
				<p class="option game_target">601</p>
				<p class="option game_target">501</p>
				<p class="option game_target">301</p>
				<p class="option game_target">101</p>
			</div>
			<div class="setup_option opaque" id="setup_legs">
				<h2>Legs needed to win</h2>
				<p class="option game_legs">1</p>
				<p class="option game_legs">2</p>
				<p class="option game_legs">3</p>
				<p class="option game_legs">4</p>
				<p class="option game_legs">5</p>
			</div>	
		</div>
		<div class="game_summary">
			<p id="opp_selected"></p>
			<p id="target_selected"></p>
			<p id="legs_selected"></p>
			<a class="button greenButton" id="confirm_x01">confrim game</a>
		</div>
	</div>

<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
  
<script type="text/javascript">

var setup_options = $('.setup_option');
var confirm_button = $('#confirm_x01');

confirm_button.hide();

var user_form = '<form action="gameSetup.php" method="post"><div id="opp_form"><input class="option opp_input" type="text" name="opp_username" placeholder="Username" id="opp_username"><input class="option opp_input" type="password" name="opp_password" placeholder="Password" id="opp_password"></div><input class="button greenButton" type="submit" name="submit" value="Log in" id="opp_login"></form>';

var guest_form = '<input class="option opp_input" type="text" name="name" placeholder="Name" id="opp_username"><input class="button greenButton" type="submit" name="submit" value="Enter name" id="opp_login">';

// CHOOSE OPPONENT
var opponents = $('.opp_option');
opponents.on('click', function()
{
	for (var i = 0; i < opponents.length; i++) 
	{
		$(opponents[i]).addClass('opaque');
	}
	$(this).removeClass('opaque');
	var opponent = $(this).text();
	if (opponent == 'single player') 
	{
		$('.opponent').empty();
		$('#opp_selected').text(opponent);
	}
	else if (opponent == 'v guest')
	{
		$('.opponent').empty();
		$('.opponent').append(guest_form);
		$('#opp_selected').text(opponent);
	}
	else if (opponent == 'v user')
	{
		$('.opponent').empty();
		$('.opponent').append(user_form);
		$('#opp_selected').text(opponent);
	}
	$(setup_options[1]).removeClass('opaque');

	// CHOOSE TARGET
	var targets = $('.game_target');
	targets.on('click', function()
	{
		for (var i = 0; i < targets.length; i++) 
		{
			$(targets[i]).addClass('opaque');
		}
		$(this).removeClass('opaque');
		var target = $(this).text();
		$(setup_options[2]).removeClass('opaque');
		$('#target_selected').text(target);

		// CHOOSE NUMBER OF LEGS
		var game_legs = $('.game_legs');
		game_legs.on('click', function()
		{
			for (var i = 0; i < game_legs.length; i++) 
			{
				$(game_legs[i]).addClass('opaque');
			}
			$(this).removeClass('opaque');
			var legs = $(this).text();
			$('#legs_selected').text(legs);

			// SHOWS CONFRIM BUTTON AND CHANGES HREF TO GAME WITH OPPONENT, TARGET & LEGS SELECTED
			$(confirm_button).show();
			$(confirm_button).attr('href', 'game.php?username=<?=$user_username;?>&opp=' + opponent + '&target=' + target + '&legs=' + legs);
		})

	})

})


</script>


</body>
</html>