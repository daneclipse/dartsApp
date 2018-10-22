var targetsUsed =[];
var sections = $('.targetText');
function newGame()
{
	for (var i = 0; i < sections.length; i++) 
	{
		var randomTarget = possibleTargets[Math.floor(Math.random()*possibleTargets.length)].target;
		// CHECKT TO SEE IF RANDOM TARGET IS ALREADY IN TARGETSUSED ARRAY
		// IF IT IS - GET A NEW RANDOM NUMBER
		if ($.inArray(randomTarget, targetsUsed) > -1) 
		{
			var newRandomTarget = possibleTargets[Math.floor(Math.random()*possibleTargets.length)].target;
			targetsUsed.push(newRandomTarget);
			$(sections[i]).text(newRandomTarget);
		}
		else
		{
			targetsUsed.push(randomTarget);
			$(sections[i]).text(randomTarget);
		}

		$(sections[i]).removeClass('greenText');
		$(sections[i]).removeClass('redText');
		$(sections[i]).css('font-size', '24px');
		
	}
}

var targetOne = $('#targetOne').text();
var targetTwo = $('#targetTwo').text();
var targetThree = $('#targetThree').text();
var targetFour = $('#targetFour').text();
var targetFive = $('#targetFive').text();
var targetSix = $('#targetSix').text();
var targetSeven = $('#targetSeven').text();
var targetEight = $('#targetEight').text();
var targetNine = $('#targetNine').text();

var topRow = $('.rowOne');
var middleRow = $('.rowTwo');
var bottomRow = $('.rowThree');
var leftCol = $('.colOne');
var middleCol = $('.colTwo');
var rightCol = $('.colThree');
var diagOne = $('.diagOne');
var diagTwo = $('.diagTwo');

var single = $('.single');
var double = $('.double');
var treble = $('.treble');
var board = $('.board');

var dart = 0;

var nameSection = $('#nandcName');
var firstSeciton = $('#nandcFirst');
var secondSection = $('#nandcSecond');
var thirdSection = $('#nandcThird');

newGame();
var resetButton = $('.reset');

$(nameSection).text(players.players[0].name + ' - O');
$(firstSeciton).text('');
$(secondSection).text('');
$(thirdSection).text('');

single.on('click', function(e)
{
	var currentPlayer = players.players[players.current];
	e.stopPropagation();
	var hit = 's' + $(this).attr('data-value');
	if (hit == 's25') 
	{
		hit = 'outerbull';
	}
	// CHECK TO SEE IF NUMBER HIT ON DARTBOARD IS IN THE TARGETS USED ARRAY
	// IF NOT THEN HIT = MISS - AS IT IS NOT ONE OF THE TARGETS ON THE TIC TAC TOE BOARD
	if ($.inArray(hit, targetsUsed) > -1) 
	{
		checkDart(currentPlayer, hit);
	}
	else
	{
		hit = 'miss';
		checkDart(currentPlayer, hit);
	}
})

double.on('click', function(e)
{
	var currentPlayer = players.players[players.current];
	e.stopPropagation();
	var hit = 'd' + $(this).attr('data-value');
	if (hit == 'd25') 
	{
		hit = 'bull';
	}
	if ($.inArray(hit, targetsUsed) > -1) 
	{
		checkDart(currentPlayer, hit);
	}
	else
	{
		hit = 'miss';
		checkDart(currentPlayer, hit);
	}
})

treble.on('click', function(e)
{
	var currentPlayer = players.players[players.current];
	e.stopPropagation();
	var hit = 't' + $(this).attr('data-value');
	if ($.inArray(hit, targetsUsed) > -1) 
	{
		checkDart(currentPlayer, hit);
	}
	else
	{
		hit = 'miss';
		checkDart(currentPlayer, hit);	
	}
	
})

board.on('click', function(e)
{
	var currentPlayer = players.players[players.current];
	e.stopPropagation();
	var hit = 'miss';
	checkDart(currentPlayer, hit);
})

resetButton.on('click', function()
{
	newGame();
	players.current = 0;
	var currentPlayer = players.players[players.current];
	$(nameSection).text(currentPlayer.name + ' - O');
	resetStats(players.players[0]);
	resetStats(players.players[1]);
})

function resetStats(player)
{
	player.gamesWon = 0;
	player.dartsUsed = 0;
	player.dartsMissed = 0;
	player.targets = 0;
	player.targetsHit = [];
}

function checkDart(player, score)
{
	dart++;
	if (dart < 3) 
	{
		player.dartsUsed++;
		if (dart == 1) 
		{
			$(firstSeciton).text(score);
		}
		else if (dart == 2)
		{
			$(secondSection).text(score);
		}
		checkArea(player, score);
	}
	else
	{
		if (dart == 3) 
		{
			$(thirdSection).text(score);
		}
		player.dartsUsed++;
		checkArea(player, score);
		playerGo();
		var newPlayer = players.players[players.current];
		dart = 0;
		if (newPlayer.marker == 'noughts') 
		{
			var marker = 'O';
		}
		else
		{
			var marker = 'X';
		}
		$(nameSection).text(newPlayer.name + ' - ' + marker );
		$(firstSeciton).text('');
		$(secondSection).text('');
		$(thirdSection).text('');
	}

}

// CHECKS THE NUMBER HIT ON THE DARTBOARD IS ON THE TIC TAC TOE BOARD
// IF IT IS, CHANGE THE TEXT FOR THAT BOX TO THE MARKER DEPENDING ON THE PLAYER
// USE CHECKGAME FUNTION TO SEE IF THE GAME HAS BEEN WON BY THE PLAYER
function checkArea(player, score)
{
	if (score == 'miss') 
	{
		player.dartsMissed++;
	}
	else
	{
		for (var i = 0; i < sections.length; i++) 
		{
			var text = $(sections[i]).text();
			if (score == text) 
			{
				if (player.marker == 'noughts') 
				{
					player.targetsHit.push(text);
					player.targets++;
					$(sections[i]).text('O');
					$(sections[i]).addClass('greenText');
					$(sections[i]).css('font-size', '40px');
					checkGame(player);
				}
				else if (player.marker == 'crosses')
				{
					player.targetsHit.push(text);
					player.targets++;
					$(sections[i]).text('X');
					$(sections[i]).addClass('redText');
					$(sections[i]).css('font-size', '40px');
					checkGame(player);
				}
			}
		}
	}
	// NEED TO ADD SOMETHING THAT ADD ONE TO DARTSMISSED IF THE NUMBER HIT ISNT IN THE TIC TAC TOE BOARD
}

// CHECKS THE BOAD TO SEE IF THERE ARE 3 OF THE SAME MARKER
function checkBoard(area, player)
{
	var first = $(area[0]).text();
	var second = $(area[1]).text();
	var third = $(area[2]).text();

	if (first == second || first == third || second == third) 
	{
		if (second == third && third == first) 
		{
			alert(player.name + ', ' + player.marker + ' is the winner');
		}
	}
}

// CHECK ALL POSSIBILITES OF WINNING THE GAME
function checkGame(player)
{
	checkBoard(topRow, player);
	checkBoard(middleRow, player);
	checkBoard(bottomRow, player);
	checkBoard(leftCol, player);
	checkBoard(middleCol, player);
	checkBoard(rightCol, player);
	checkBoard(diagOne, player);
	checkBoard(diagTwo, player);
}

function playerGo() 
{
	if ( players.current >= ( players.players.length - 1 ) ) 
	{
		players.current = 0;
	} 
	else 
	{
		players.current++;
	}
};

