<?php

$user_username = $_GET['username'];
$opponent = $_GET['opponent'];
$games = $_GET['games'];

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

	<div class="navBar">
		<h1 class="accountName"><?= $user_username;?></h1>
		<a href="../gameSetup.php?username=<?=$user_username;?>">Choose different game</a>
		<a href="../account.php?username=<?=$user_username;?>">Back to account</a>
		<a href="../index.php">Home</a>
	</div>

	<div class="page">
		<div class="scoreboard">
			<div class="half">Noughts<p id="nought"></p></div>
			<div class="half">Crosses<p id="cross"></p></div>
		</div>
		<div class="gameBoard">
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
		<div class="gameButtons">
			<button id="reset">reset</button>
			<button id="newBoard">new board</button>
		</div>
	</div>

	<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
  <script type="text/javascript" src="possibleTargets.js"></script>
  <script type="text/javascript" src="ticTacToe.js"></script>

</body>
</html>