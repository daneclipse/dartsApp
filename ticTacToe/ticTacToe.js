var firstSection = $('#targetOne');
var secondSection = $('#targetTwo');
var thirdSection = $('#targetThree');
var fourthSection = $('#targetFour');
var fifthSection = $('#targetFive');
var sixthSection = $('#targetSix');
var seventhSection = $('#targetSeven');
var eighthSection = $('#targetEight');
var ninthSection = $('#targetNine');

var resetButton = $('#reset');
resetButton.on('click', function()
{
	newGame();
	noughtScore = 0;
	crossScore = 0;
	noughtScoreSection.text('');
	crossScoreSection.text('');
})

var newBoard = $('#newBoard');
newBoard.on('click', function()
{
	newGame();
})

// WHEN PAGE FIRST LOADS - SETS TARGETS AS SELECTION OF RANDOM ITEMS FROM POSSIBLE TARGETS ARRAY
var sections = $('.targetText');
for (var i = 0; i < sections.length; i++) 
{
	var randomTarget = possibleTargets[Math.floor(Math.random()*possibleTargets.length)].target;
	$(sections[i]).text(randomTarget);
}

// RESETS THE GAME & SETS THE TARGETS AND A NEW SELECTION OF RANDOM ITEMS FROM THE POSSIBLE TARGETS ARRAY
function newGame()
{
	var sections = $('.targetText');
	for (var i = 0; i < sections.length; i++) 
	{
		var randomTarget = possibleTargets[Math.floor(Math.random()*possibleTargets.length)].target;
		$(sections[i]).removeClass('greenText');
		$(sections[i]).removeClass('redText');
		$(sections[i]).addClass('neutralText');
		$(sections[i]).text(randomTarget);
	}
	targetsOne = [];
	targetsTwo = [];
	targetsThree = [];
	targetsFour = [];
	targetsFive = [];
	targetsSix = [];
	targetsSeven = [];
	targetsEight = [];
	targetsNine = [];
}

var count = 0;
var topRow = $('.rowOne');
var middleRow = $('.rowTwo');
var bottomRow = $('.rowThree');
var leftCol = $('.colOne');
var middleCol = $('.colTwo');
var rightCol = $('.colThree');
var diagOne = $('.diagOne');
var diagTwo = $('.diagTwo');

var noughtScoreSection = $('#nought');
var crossScoreSection = $('#cross');

var noughtScore = 0;
var crossScore = 0;

var targetsOne = [];
var targetsTwo = [];
var targetsThree = [];
var targetsFour = [];
var targetsFive = [];
var targetsSix = [];
var targetsSeven = [];
var targetsEight = [];
var targetsNine = [];

firstSection.on('click', function()
{
	targetsOne.push($(this).text());
	changeScore(targetsOne, $(this));
	checkBoard(topRow);
	checkBoard(leftCol);
	checkBoard(diagOne);
})

secondSection.on('click', function()
{
	targetsTwo.push($(this).text());
	changeScore(targetsTwo, $(this));
	checkBoard(topRow);
	checkBoard(middleCol);
})

thirdSection.on('click', function()
{
	targetsThree.push($(this).text());
	changeScore(targetsThree, $(this));
	checkBoard(topRow);
	checkBoard(rightCol);
	checkBoard(diagTwo);
})

fourthSection.on('click', function()
{
	targetsFour.push($(this).text());
	changeScore(targetsFour, $(this));
	checkBoard(middleRow);
	checkBoard(leftCol);
})

fifthSection.on('click', function()
{
	targetsFive.push($(this).text());
	changeScore(targetsFive, $(this));
	checkBoard(middleRow);
	checkBoard(middleCol);
	checkBoard(diagOne);
	checkBoard(diagTwo);
})

sixthSection.on('click', function()
{
	targetsSix.push($(this).text());
	changeScore(targetsSix, $(this));
	checkBoard(middleRow);
	checkBoard(rightCol);
})

seventhSection.on('click', function()
{
	targetsSeven.push($(this).text());
	changeScore(targetsSeven, $(this));
	checkBoard(bottomRow);
	checkBoard(leftCol);
	checkBoard(diagTwo);
})

eighthSection.on('click', function()
{
	targetsEight.push($(this).text());
	changeScore(targetsEight, $(this));
	checkBoard(bottomRow);
	checkBoard(middleCol);
})

ninthSection.on('click', function()
{
	targetsNine.push($(this).text());
	changeScore(targetsNine, $(this));
	checkBoard(bottomRow);
	checkBoard(rightCol);
	checkBoard(diagOne);
})

// CHANGE THE TEXT IN THE SECTION PRESSED
// FIRST CLICK - CHANGE TO 0
// SECOND CLICK - CHANGE TO X
// THIRD CLICK - CHANGE BACK TO TARGET
function changeScore(targets, section)
{
	if (targets.length == 1) 
	{
		section.removeClass('neutralText');
		section.removeClass('redText');
		section.addClass('greenText');
		section.text('O');
		players.players[0].targets++;
		players.players[0].targetsHit.push(targets[0]);
		console.log(players.players[0]);
	}
	else if (targets.length == 2)
	{
		section.removeClass('.neutralText');
		section.removeClass('greenText');
		section.addClass('redText');
		section.text('X');
		players.players[0].targets--;
		players.players[0].targetsHit.pop();
		players.players[1].targets++;
		players.players[1].targetsHit.push(targets[0]);
		console.log(players);
	}
	else
	{
		section.removeClass('greenText');
		section.removeClass('redText');
		section.addClass('neutralText')
		section.text(targets[0]);
		players.players[1].targets--;
		players.players[1].targetsHit.pop();
		targets.length = 0;
		targets = [];
	}
	// console.log(targets);
}

var completeBoardButton = document.createElement('button');
completeBoardButton.textContent = 'complete board';
$(completeBoardButton).addClass('greenButton');

var completeGame = document.createElement('button');
completeGame.textContent = 'complete game';
$(completeGame).addClass('greenButton');

// CHECK THE BOARD TO SEE IF THERE IS THREE IN A ROW
function checkBoard(area)
{
	var first = area[0].textContent;
	var second = area[1].textContent;
	var third = area[2].textContent;

	if (first == second || first == third || second == third) 
	{
		if (second == third && third == first) 
		{
			$('.gameButtons').prepend(completeBoardButton);
			$(completeBoardButton).on('click', function()
			{
				// all three match - game won
				if (first == 'O') 
				{
					alert('NOUGHTS WIN');
					noughtScore++;
					$('#nought').text(noughtScore);
					players.players[0].gamesWon++;
					if (players.players[0].gamesWon == players.players[0].gamesToWin) 
					{
						$('.gameButtons').prepend(completeGame);
						completeGame.onclick = function()
						{
							var complete = confirm('finish the game, ' + players.players[0].name + ' is the winner');
							if (complete) 
							{
								updateStats( players.players[0] );
								location.replace('../account.php?username=<?=$user_username;?>');
							}
						}
					}
					else
					{
						newGame();
						$(this).remove();
					}
				}
				else if (first == 'X')
				{
					alert('CROSSES WIN');
					crossScore++;
					$('#cross').text(crossScore);
					players.players[1].gamesWon++;
					if (players.players[1].gamesWon == players.players[1].gamesToWin) 
					{
						$('.gameButtons').prepend(completeGame);
						completeGame.onclick = function()
						{
							var complete = confirm('finish the game, ' + players.players[1].name + ' is the winner');
							if (complete) 
							{
								updateStats( players.players[1] );
								location.replace('../account.php?username=<?=$user_username;?>');
							}
						}
					}
					else
					{
						newGame();
						$(this).remove();
					}
				}
			})

		}
		else
		{
			$(completeBoardButton).remove();
			// only two match - carry on with game
			// alert('first & second match');
		}
	}
	else
	{
		// no match - carry on with game
		// alert('NO MATCH');
	}
}

function updateStats( player )
{
	if (players.players.length == 2) 
	{
		for (var i = 0; i < players.players.length - 1; i++) 
		{
			if (player.name == players.players[i].name) 
			{
				if (window.location.search.includes('guest')) 
				{
					var oppName = window.location.search.split("&")[1].split("guest=")[1];
				}
				else if (window.location.search.includes('opponent')) 
				{
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
		'&targets='+player.targets+
		'&targetOne='+firstTarget+
		'&targetTwo='+secondTarget+
		'&targetThree='+thirdTarget+
		'&targetFour='+fourthTarget+
		'&targetFive='+fifthTarget+
		'&targetSix='+sixthTarget+
		'&darts='+player.dartsUsed, true);
	xmlhttp.send();
}
