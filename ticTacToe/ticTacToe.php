<?php

$user_username = $_GET['username'];
$opponent = $_GET['opponent'];
$guest = $_GET['guest'];
$games = $_GET['games'];

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- CSS FILES -->
	<link rel="stylesheet" type="text/css" href="../css/general.css">
	<link rel="stylesheet" type="text/css" href="../css/game.css">
</head>
<body>


	<div class="page">
		<span class="quitGame">X</span>
		<div class="playerOrder">
			<p>Top player is 'noughts' and throws first</p>
			<div class="playersToOrder"></div>
		</div>

		<div class="ticScoreboard">
			<div class="half">Noughts<p id="nought"></p></div>
			<div class="half">Crosses<p id="cross"></p></div>
		</div>
		<div class="ticGameBoard">
			<div class="innerSection"><p id="targetOne" class="targetText rowOne colOne diagOne"></p></div>
			<div class="innerSection"><p id="targetTwo" class="targetText rowOne colTwo"></p></div>
			<div class="innerSection"><p id="targetThree" class="targetText rowOne colThree diagTwo"></p></div>
			<div class="innerSection"><p id="targetFour" class="targetText rowTwo colOne"></p></div>
			<div class="innerSection"><p id="targetFive" class="targetText rowTwo colTwo diagOne diagTwo"></p></div>
			<div class="innerSection"><p id="targetSix" class="targetText rowTwo colThree"></p></div>
			<div class="innerSection"><p id="targetSeven" class="targetText rowThree colOne diagTwo"></p></div>
			<div class="innerSection"><p id="targetEight" class="targetText rowThree colTwo"></p></div>
			<div class="innerSection"><p id="targetNine" class="targetText rowThree colThree diagOne"></p></div>
		</div>
		<div class="gameButtons" id="ticButtons">
			<button class="redButton" id="reset">reset</button>
			<button class="greenButton" id="newBoard">new board</button>
		</div>
	</div>

	<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
<!--   <script type="text/javascript" src="possibleTargets.js"></script>
  <script type="text/javascript" src="ticTacToe.js"></script> -->
  <script type="text/javascript">

	var quitGame = $('.quitGame');
	$(quitGame).on('click', function()
	{
		var quit = confirm('are you sure you want to quit the game?');
		if (quit) 
		{
			location.replace('../account.php?username=<?=$user_username;?>');
		}
	})  	

	var user = '<?=$user_username;?>';
	var opponent = '<?=$opponent;?>';
	var guest = '<?=$guest;?>';
	var playerOne = '<?=$playerOne;?>';
	var playerTwo = '<?=$playerTwo;?>';

	var players = 
	{
		current: 0,
		players: []
	};

	function createPlayer( name )
	{
		var player = 
		{
			name: name,
			gamesToWin: Number('<?=$games;?>'),
			gamesWon: 0,
			targets: 0,
			targetsHit: [],
			dartsUsed: 0,
			dartsMissed: 0
		}
		players.players.push(player);
		localStorage.players = JSON.stringify(players.players);
	}

	if(user != '')
	{
		createPlayer(user);
	}

	var playerOrder = $('.playerOrder');
	var playersToOrder = $('.playersToOrder');
	var submitOrder = document.createElement('button');
	$(submitOrder).addClass('greenButton startGameButton');

	if (opponent != '') 
	{
		createPlayer(opponent);
		orderSelection();
	}
	else if (guest != '') 
	{
		createPlayer(guest);
		orderSelection();
	}
	else if (playerOne != '') 
	{
		createPlayer(playerOne);
		if (playerTwo != '') 
		{
			createPlayer(playerTwo);
			orderSelection();
		}
		else
		{
			$(playerOrder).hide();
			$.getScript('possibleTargets.js');
			$.getScript('ticTacToe.js');
		}
	}
	else
	{
		$(playerOrder).hide();
		$.getScript('possibleTargets.js');
		$.getScript('ticTacToe.js');
	}


	// FUNCTION TO MOVE AN ITEM IN THE ARRAY TO ANOTHER INDEX
	function arraymove(arr, fromIndex, toIndex) 
	{
	    var element = arr[fromIndex];
	    arr.splice(fromIndex, 1);
	    arr.splice(toIndex, 0, element);
	}

	function orderSelection()
	{
		$('.ticScoreboard').hide();
		$('.ticGameBoard').hide();
		$('#ticButtons').hide();
		submitOrder.textContent = 'submit order';
		playerOrder.prepend(submitOrder);
		for (var i = 0; i < players.players.length; i++) 
		{
			createOrder(players.players[i], i);
		}
		submitOrder.onclick = function()
		{
			var x = confirm('are you happy with the order of throw?');
			if (x) 
			{
				$('.ticScoreboard').show();
				$('.ticGameBoard').show();
				$('#ticButtons').show();
				localStorage.players = JSON.stringify(players.players);
				playerOrder.remove();
				$(this).remove();
				$.getScript('possibleTargets.js');
				$.getScript('ticTacToe.js');
			}
		}
	}

	// FUNCTION TO LISTS PLAYERS WITH OWN SECTION AND BUTTONS
	function createOrder( player, index )
	{
		var section = document.createElement('li');
		var moveUp = document.createElement('button');
		var moveDown = document.createElement('button');
		var buttons = document.createElement('div');
		$(moveUp).addClass('greenButton fa fa-angle-up');
		$(moveDown).addClass('redButton fa fa-angle-down');
		$(buttons).addClass('right');
		section.textContent = player.name;
		if (index == 0) 
		{
			$(buttons).append(moveDown);
		}
		else
		{
			$(buttons).append(moveUp)
		}
		section.append(buttons);

		playersToOrder.append(section);

		moveUp.onclick = function()
		{
			var current = $(this).closest('li');
			var previous = current.prev('li');
			if (index > 0) 
			{
				newIndex = index - 1;
			} 
			else 
			{
				newIndex = 0;
			}
			arraymove(players.players, index, newIndex );
			// var index = $(this).index();
			if (previous.length !== 0) 
			{
				current.insertBefore(previous);
				$(current).children().empty();
				$(current).children().append(moveDown);
				$(previous).children().empty();
				$(previous).children().append(moveUp);
			}
			localStorage.players = JSON.stringify(players.players);
			return false;
		}

		moveDown.onclick = function()
		{
			var current = $(this).closest('li');
			var next = current.next('li');
			if (index < players.players.length) 
			{
				newIndex = index + 1;
			} 
			else 
			{
				newIndex = players.players.length - 1;
			}
			arraymove(players.players, index, newIndex );
			// var index = $(this).index();
			if (next.length !== 0) 
			{
				current.insertAfter(next);
				$(current).children().empty();
				$(current).children().append(moveUp);
				$(next).children().empty();
				$(next).children().append(moveDown);
			}
			localStorage.players = JSON.stringify(players.players);
			return false;
		}
	}
  </script>

</body>
</html>