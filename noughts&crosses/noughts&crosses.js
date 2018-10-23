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
var completeGameButton = document.createElement('button');
$(completeGameButton).text('complete game');
$(completeGameButton).addClass('greenButton');

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
			player.gamesWon++;
			if (player.gamesWon == player.gamesToWin) 
			{
				alert(player.name + ', ' + player.marker + ' is the winner');
				// FUNCTION TO END GAME
				endGame(player);
			}
			else
			{
				if (player.marker == 'noughts') 
				{
					$('#nought').text(player.gamesWon);
				}
				else if (player.marker == 'crosses')
				{
					$('#cross').text(player.gamesWon);
				}
				newGame();
			}
			
		}
	}
}

function endGame(player)
{
	$('.targetBoard').hide();
	$('.game').hide();
	$('.page').append(player.name + ' won');
	showStats(player);
	$('.page').append(completeGameButton);
	completeGameButton.onclick = function()
	{
		// UPDATE STATS & GO BACK TO ACCOUNT
		for (var i = 0; i < players.players.length; i++) 
		{
			updateStats(players.players[i]);
		}
		var user_username = location.search.split('?username=')[1];
		location.replace('../account.php?username=' + user_username);
	}
}

// SHOWS GAME STATS OF PLAYER
function showStats(player)
{
	var average = Number((player.targets / player.dartsUsed) * 100);
	player.average = average;
	var table = '<table>';
	table += '<tr><th>Darts Used</th><th>Total Targets</th><th>Targets Hit</th><th>Average</th></tr>';
	table += '<tr><td>' + player.dartsUsed + '</td>';
	table += '<td>' + player.targets + '</td>';
	table += '<td>' + player.targetsHit + '</td>';
	table += '<td>' + average + '%</tr>';
	table += '</table>';
	$('.page').append(table);
}

// UPDATE STATS
function updateStats( player )
{
	if (players.players.length == 2) 
	{
		for (var i = 0; i < players.players.length - 1; i++) 
		{
			if (player.name == players.players[i].name) 
			{
				// IF PLAYING A GUEST
				if (window.location.search.includes('guest')) 
				{
					// IF PLAYER NAME IS EQUAL TO GUEST NAME IN URL THEN OPPONENT NAME IS THE USERNAME IN URL
					var checkName = window.location.search.split("&")[1].split("guest=")[1];;
					if (player.name == checkName) 
					{
						var oppName = window.location.search.split("?username=")[1].split('&')[0];
					}
					else
					{
						var oppName = window.location.search.split("&")[1].split("guest=")[1];;
					}
				}
				// IF PLAYING OPPONENT
				else if (window.location.search.includes('opponent')) 
				{
					// IF PLAYER NAME IS EQUAL TO OPPONENT NAME IN URL THEN OPPONENT IS THE USERNAME IN URL
					var checkName = window.location.search.split("&")[1].split("opponent=")[1];
					if (player.name == checkName) 
					{
						var oppName = window.location.search.split("?username=")[1].split('&')[0];
					}
					else
					{
						var oppName = window.location.search.split("&")[1].split("opponent=")[1];
					}
				}
				else if (window.location.search.includes('playerOne'))
				{
					if (window.location.search.includes('playerTwo')) 
					{
						var checkName = window.location.search.split("&")[1].split("playerTwo=")[1];
						if (player.name == checkName) 
						{
							var oppName = window.location.search.split("&")[1].split("playerOne=")[1];
						}
						else
						{
							var oppName = window.location.search.split("&")[1].split("playerTwo=")[1];
						}
					}
					else
					{
						var oppName = 'no opponent';
					}
				}
			}
			else
			{
				var oppName = players.players[i].name;
			}
		}
	}
	else
	{
		var oppName = 'no opponent';
	}

	var firstTarget = player.targetsHit[0];
	var secondTarget = player.targetsHit[1];
	var thirdTarget = player.targetsHit[2];
	if (player.targetsHit.length > 2) 
	{
		var fourthTarget = player.targetsHit[3];
		var fifthTarget = player.targetsHit[4];
		var sixthTarget = player.targetsHit[5];
	}
	else
	{
		var fourthTarget = '';
		var fifthTarget = '';
		var sixthTarget = '';
	}
	if (player.gamesWon == player.gamesToWin) 
	{
		player.gameOutcome = 'win';
	}
	else
	{
		player.gameOutcome = 'lost';
	}
	var xmlhttp;
	xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function()
	{
		if (this.readyState == 4 && this.status == 200) 
		{
			$('#stats').innerHTML = this.responseText;
		}
	}
	xmlhttp.open('GET', '../updateStats.php?name='+player.name+
		'&game=ticTacToe'+
		'&marker='+player.marker+
		'&opponent='+oppName+
		'&games='+player.gamesToWin+
		'&gamesWon='+player.gamesWon+
		'&outcome='+player.gameOutcome+
		'&targets='+player.targets+
		'&targetOne='+firstTarget+
		'&targetTwo='+secondTarget+
		'&targetThree='+thirdTarget+
		'&targetFour='+fourthTarget+
		'&targetFive='+fifthTarget+
		'&targetSix='+sixthTarget+
		'&darts='+player.dartsUsed+
		'&average='+player.average, true);
	xmlhttp.send();
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

