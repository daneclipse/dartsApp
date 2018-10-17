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
		$(sections[i]).removeClass('green');
		$(sections[i]).removeClass('red');
		$(sections[i]).addClass('neutral');
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
		section.removeClass('neutral');
		section.removeClass('red');
		section.addClass('green');
		section.text('O');
	}
	else if (targets.length == 2)
	{
		section.removeClass('.neutral');
		section.removeClass('green');
		section.addClass('red');
		section.text('X');
	}
	else
	{
		section.removeClass('green');
		section.removeClass('red');
		section.addClass('neutral')
		section.text(targets[0]);
		targets.length = 0;
		targets = [];
	}
	console.log(targets);
}

var completeBoardButton = document.createElement('button');
completeBoardButton.textContent = 'complete game';

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
				}
				else if (first == 'X')
				{
					alert('CROSSES WIN');
					crossScore++;
					$('#cross').text(crossScore);
				}
				newGame();
				$(this).remove();
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

