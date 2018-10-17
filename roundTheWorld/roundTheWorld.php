<?php

$user_username = $_GET['username'];
$gameType = $_GET['game']; // single, double, treble etc ..

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
		<h3>
			<?php

			if ($gameType == 'singles') 
			{
				echo 'Hit every single, extra points for doubles & trebles hit<br />';
				echo '1 point for single, 2 points for double, 3 points for treble';
			}
			else if ($gameType == 'doubles')
			{
				echo 'Hit every double, minus points for singles & trebles hit<br />';
				echo '2 points for double, minus 1 for single, minus 3 for treble';
			}
			else if ($gameType == 'trebles')
			{
				echo 'Hit every treble, minus points for singles & doubles hit<br />';
				echo '3 points for treble, minus 1 for single, minus 2 for double';
			}

			?>
		</h3>
		<br />
		<div class="scoreboard">
			<div class="half numbersNeeded">
				<div class="inner_half"><p class="regularText">1</p></div>
				<div class="inner_half"><p class="regularText">2</p></div>
				<div class="inner_half"><p class="regularText">3</p></div>
				<div class="inner_half"><p class="regularText">4</p></div>
				<div class="inner_half"><p class="regularText">5</p></div>
				<div class="inner_half"><p class="regularText">6</p></div>
				<div class="inner_half"><p class="regularText">7</p></div>
				<div class="inner_half"><p class="regularText">8</p></div>
				<div class="inner_half"><p class="regularText">9</p></div>
				<div class="inner_half"><p class="regularText">10</p></div>
				<div class="inner_half"><p class="regularText">11</p></div>
				<div class="inner_half"><p class="regularText">12</p></div>
				<div class="inner_half"><p class="regularText">13</p></div>
				<div class="inner_half"><p class="regularText">14</p></div>
				<div class="inner_half"><p class="regularText">15</p></div>
				<div class="inner_half"><p class="regularText">16</p></div>
				<div class="inner_half"><p class="regularText">17</p></div>
				<div class="inner_half"><p class="regularText">18</p></div>
				<div class="inner_half"><p class="regularText">19</p></div>
				<div class="inner_half"><p class="regularText">20</p></div>
			</div>
			<div class="half numbersHit">
				<div class="inner_half"><p class="regularText" id="1"></p></div>
				<div class="inner_half"><p class="regularText" id="2"></p></div>
				<div class="inner_half"><p class="regularText" id="3"></p></div>
				<div class="inner_half"><p class="regularText" id="4"></p></div>
				<div class="inner_half"><p class="regularText" id="5"></p></div>
				<div class="inner_half"><p class="regularText" id="6"></p></div>
				<div class="inner_half"><p class="regularText" id="7"></p></div>
				<div class="inner_half"><p class="regularText" id="8"></p></div>
				<div class="inner_half"><p class="regularText" id="9"></p></div>
				<div class="inner_half"><p class="regularText" id="10"></p></div>
				<div class="inner_half"><p class="regularText" id="11"></p></div>
				<div class="inner_half"><p class="regularText" id="12"></p></div>
				<div class="inner_half"><p class="regularText" id="13"></p></div>
				<div class="inner_half"><p class="regularText" id="14"></p></div>
				<div class="inner_half"><p class="regularText" id="15"></p></div>
				<div class="inner_half"><p class="regularText" id="16"></p></div>
				<div class="inner_half"><p class="regularText" id="17"></p></div>
				<div class="inner_half"><p class="regularText" id="18"></p></div>
				<div class="inner_half"><p class="regularText" id="19"></p></div>
				<div class="inner_half"><p class="regularText" id="20"></p></div>
			</div>
		</div><!-- CLOSE DIV WITH CLASS SCOREBOARD -->
		<div class="board" id="board">
			<svg height="100%" version="1.1" viewBox="-225 -225 450 450" width="100%" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">

			  <defs>
			    <line id="refwire" stroke="Silver" stroke-width="1" x1="2.566" x2="26.52" y1="16.20" y2="167.4"/>
			    <path d="M 0 0 L 15.64 98.77 A 100 100 0 0 1 -15.64 98.77 Z" id="SLICE" stroke-width="0"/>
			    <use id="double" transform="scale(1.695)" xlink:href="#SLICE"/>
			    <use id="outer" transform="scale(1.605)" xlink:href="#SLICE"/>
			    <use id="triple" transform="scale(1.065)" xlink:href="#SLICE"/>
			    <use id="inner" transform="scale(0.975)" xlink:href="#SLICE"/>
			  </defs>

			  <g transform="scale(1,-1)">
			    <circle class="black" r="226"/>
			    <g id="dartboard">
			      <g>
			        <use class="red double scalable" data-value="20" xlink:href="#double" id="d20"/>
			        <use class="black single" data-value="20" xlink:href="#outer" id="s20"/>
			        <use class="red treble scalable" data-value="20" xlink:href="#triple" id="t20"/>
			        <use class="black single" data-value="20" xlink:href="#inner" id="s20"/>
			      </g><!-- 20 AREA -->
			      <g transform="rotate(18)">
			        <use class="green double scalable" data-value="5" xlink:href="#double" id="d5"/>
			        <use class="white single" data-value="5" xlink:href="#outer" id="s5"/>
			        <use class="green treble scalable" data-value="5" xlink:href="#triple" id="t5"/>
			        <use class="white single" data-value="5" xlink:href="#inner"/>
			      </g><!-- 5 AREA -->
			      <g transform="rotate(36)">
			        <use class="red double scalable" data-value="12" xlink:href="#double" id="d12"/>
			        <use class="black single" data-value="12" xlink:href="#outer" id="s12"/>
			        <use class="red treble scalable" data-value="12" xlink:href="#triple" id="t12"/>
			        <use class="black single" data-value="12" xlink:href="#inner"/>
			      </g><!-- 12 AREA -->
			      <g transform="rotate(54)">
			        <use class="green double scalable" data-value="9" xlink:href="#double" id="d9"/>
			        <use class="white single" data-value="9" xlink:href="#outer" id="s9"/>
			        <use class="green treble scalable" data-value="9" xlink:href="#triple" id="t9"/>
			        <use class="white single" data-value="9" xlink:href="#inner"/>
			      </g><!-- 9 AREA -->
			      <g transform="rotate(72)">
			        <use class="red double scalable" data-value="14" xlink:href="#double" id="d14"/>
			        <use class="black single" data-value="14" xlink:href="#outer" id="s14"/>
			        <use class="red treble scalable" data-value="14" xlink:href="#triple" id="t14"/>
			        <use class="black single" data-value="14" xlink:href="#inner"/>
			      </g><!-- 14 AREA -->
			      <g transform="rotate(90)">
			        <use class="green double scalable" data-value="11" xlink:href="#double" id="d11"/>
			        <use class="white single" data-value="11" xlink:href="#outer" id="s11"/>
			        <use class="green treble scalable" data-value="11" xlink:href="#triple" id="t11"/>
			        <use class="white single" data-value="11" xlink:href="#inner"/>
			      </g><!-- 11 AREA -->
			      <g transform="rotate(108)">
			        <use class="red double scalable" data-value="8" xlink:href="#double" id="d8"/>
			        <use class="black single" data-value="8" xlink:href="#outer" id="s8"/>
			        <use class="red treble scalable" data-value="8" xlink:href="#triple" id="t8"/>
			        <use class="black single" data-value="8" xlink:href="#inner"/>
			      </g><!-- 8 AREA -->
			      <g transform="rotate(126)">
			        <use class="green double scalable" data-value="16" xlink:href="#double" id="d16"/>
			        <use class="white single" data-value="16" xlink:href="#outer" id="s16"/>
			        <use class="green treble scalable" data-value="16" xlink:href="#triple" id="t16"/>
			        <use class="white single" data-value="16" xlink:href="#inner"/>
			      </g><!-- 16 AREA -->
			      <g transform="rotate(144)">
			        <use class="red double scalable" data-value="7" xlink:href="#double" id="d7"/>
			        <use class="black single" data-value="7" xlink:href="#outer" id="s7"/>
			        <use class="red treble scalable" data-value="7" xlink:href="#triple" id="t7"/>
			        <use class="black single" data-value="7" xlink:href="#inner"/>
			      </g><!-- 7 AREA -->
			      <g transform="rotate(162)">
			        <use class="green double scalable" data-value="19" xlink:href="#double" id="d19"/>
			        <use class="white single" data-value="19" xlink:href="#outer" id="s19"/>
			        <use class="green treble scalable" data-value="19" xlink:href="#triple" id="t19"/>
			        <use class="white single" data-value="19" xlink:href="#inner"/>
			      </g><!-- 19 AREA -->
			      <g transform="rotate(180)">
			        <use class="red double scalable" data-value="3" xlink:href="#double" id="d3"/>
			        <use class="black single" data-value="3" xlink:href="#outer" id="s3"/>
			        <use class="red treble scalable" data-value="3" xlink:href="#triple" id="t3"/>
			        <use class="black single" data-value="3" xlink:href="#inner"/>
			      </g><!-- 3 AREA -->
			      <g transform="rotate(198)">
			        <use class="green double scalable" data-value="17" xlink:href="#double" id="d17"/>
			        <use class="white single" data-value="17" xlink:href="#outer" id="s17"/>
			        <use class="green treble scalable" data-value="17" xlink:href="#triple" id="t17"/>
			        <use class="white single" data-value="17" xlink:href="#inner"/>
			      </g><!-- 17 AREA -->
			      <g transform="rotate(216)">
			        <use class="red double scalable" data-value="2" xlink:href="#double" id="d2"/>
			        <use class="black single" data-value="2" xlink:href="#outer" id="s2"/>
			        <use class="red treble scalable" data-value="2" xlink:href="#triple" id="t2"/>
			        <use class="black single" data-value="2" xlink:href="#inner"/>
			      </g><!-- 2 AREA -->
			      <g transform="rotate(234)">
			        <use class="green double scalable" data-value="15" xlink:href="#double" id="d15"/>
			        <use class="white single" data-value="15" xlink:href="#outer" id="s15"/>
			        <use class="green treble scalable" data-value="15" xlink:href="#triple" id="t15"/>
			        <use class="white single" data-value="15" xlink:href="#inner"/>
			      </g><!-- 15 AREA -->
			      <g transform="rotate(252)">
			        <use class="red double scalable" data-value="10" xlink:href="#double" id="d10"/>
			        <use class="black single" data-value="10" xlink:href="#outer" id="s10"/>
			        <use class="red treble scalable" data-value="10" xlink:href="#triple" id="t10"/>
			        <use class="black single" data-value="10" xlink:href="#inner"/>
			      </g><!-- 10 AREA -->
			      <g transform="rotate(270)">
			        <use class="green double scalable" data-value="6" xlink:href="#double" id="d6"/>
			        <use class="white single" data-value="6" xlink:href="#outer" id="s6"/>
			        <use class="green treble scalable" data-value="6" xlink:href="#triple" id="t6"/>
			        <use class="white single" data-value="6" xlink:href="#inner"/>
			      </g><!-- 6 AREA -->
			      <g transform="rotate(288)">
			        <use class="red double scalable" data-value="13" xlink:href="#double" id="d13"/>
			        <use class="black single" data-value="13" xlink:href="#outer" id="s13"/>
			        <use class="red treble scalable" data-value="13" xlink:href="#triple" id="t13"/>
			        <use class="black single" data-value="13" xlink:href="#inner"/>
			      </g><!-- 13 AREA -->
			      <g transform="rotate(306)">
			        <use class="green double scalable" data-value="4" xlink:href="#double" id="d4"/>
			        <use class="white single" data-value="4" xlink:href="#outer" id="s4"/>
			        <use class="green treble scalable" data-value="4" xlink:href="#triple" id="t4"/>
			        <use class="white single" data-value="4" xlink:href="#inner"/>
			      </g><!-- 4 AREA -->
			      <g transform="rotate(324)">
			        <use class="red double scalable" data-value="18" xlink:href="#double" id="d18"/>
			        <use class="black single" data-value="18" xlink:href="#outer" id="s18"/>
			        <use class="red treble scalable" data-value="18" xlink:href="#triple" id="t18"/>
			        <use class="black single" data-value="18" xlink:href="#inner"/>
			      </g><!-- 18 AREA -->
			      <g transform="rotate(342)">
			        <use class="green double scalable" data-value="1" xlink:href="#double" id="d1"/>
			        <use class="white single" data-value="1" xlink:href="#outer" id="s1"/>
			        <use class="green treble scalable" data-value="1" xlink:href="#triple" id="t1"/>
			        <use class="white single" data-value="1" xlink:href="#inner"/>
			      </g><!-- 1 AREA -->
			      <g class="scalable">
				      <circle class="green single scaleTwo" data-value="25" r="16.4" stroke-width="0" id="s25"/>
				      <circle class="red double scaleTwo" data-value="25" r="6.85" stroke-width="0" id="bullseye"/>
				  </g><!-- BULLSEYE AREA -->
			      <g class="scalable" id="grid">
			        <use xlink:href="#refwire"/>
			        <use transform="rotate(18)" xlink:href="#refwire"/>
			        <use transform="rotate(36)" xlink:href="#refwire"/>
			        <use transform="rotate(54)" xlink:href="#refwire"/>
			        <use transform="rotate(72)" xlink:href="#refwire"/>
			        <use transform="rotate(90)" xlink:href="#refwire"/>
			        <use transform="rotate(108)" xlink:href="#refwire"/>
			        <use transform="rotate(126)" xlink:href="#refwire"/>
			        <use transform="rotate(144)" xlink:href="#refwire"/>
			        <use transform="rotate(162)" xlink:href="#refwire"/>
			        <use transform="rotate(180)" xlink:href="#refwire"/>
			        <use transform="rotate(198)" xlink:href="#refwire"/>
			        <use transform="rotate(216)" xlink:href="#refwire"/>
			        <use transform="rotate(234)" xlink:href="#refwire"/>
			        <use transform="rotate(252)" xlink:href="#refwire"/>
			        <use transform="rotate(270)" xlink:href="#refwire"/>
			        <use transform="rotate(288)" xlink:href="#refwire"/>
			        <use transform="rotate(306)" xlink:href="#refwire"/>
			        <use transform="rotate(324)" xlink:href="#refwire"/>
			        <use transform="rotate(342)" xlink:href="#refwire"/>
			        <!-- from here down some bytes could be saved with CSS -->
			        <circle fill="none" r="169.5" stroke="Silver" stroke-width="1"/>
			        <circle class="dontScale" fill="none" r="160.5" stroke="Silver" stroke-width="1"/>
			        <circle fill="none" r="106.5" stroke="Silver" stroke-width="1"/>
			        <circle class="dontScale" fill="none" r="97.5" stroke="Silver" stroke-width="1"/>
			        <circle class="scaleTwo" fill="none" r="16.4" stroke="Silver" stroke-width="1"/>
			        <circle class="scaleTwo" fill="none" r="6.85" stroke="Silver" stroke-width="1"/>
			      </g><!-- WIRES/ OUTER RINGS -->
			    </g><!-- CLOSE G WITH ID DARTBOARD -->
			  </g><!-- CLOSE G WITH TRANSFORM SCALE -->

			  <g id="numbers">
			    <!-- alignment-baseline:middle; doesn't do what i expected it too, therefore i've changed y="200" to y="220" as a ugly hack -->
			    <!-- the characters should be about the same thickness as the wiring, cause in reality they're made from wiring -->
			    <text fill="Silver" font-size="30" style="text-anchor:middle;font-weight:200;alignment-baseline:middle;" transform="rotate(-270)" y="-204">6</text>
			    <text fill="Silver" font-size="30" style="text-anchor:middle;font-weight:200;alignment-baseline:middle;" transform="rotate(-288)" y="-204">13</text>
			    <text fill="Silver" font-size="30" style="text-anchor:middle;font-weight:200;alignment-baseline:middle;" transform="rotate(-306)" y="-204">4</text>
			    <text fill="Silver" font-size="30" style="text-anchor:middle;font-weight:200;alignment-baseline:middle;" transform="rotate(-324)" y="-204">18</text>
			    <text fill="Silver" font-size="30" style="text-anchor:middle;font-weight:200;alignment-baseline:middle;" transform="rotate(-342)" y="-204">1</text>
			    <text fill="Silver" font-size="30" style="text-anchor:middle;font-weight:200;alignment-baseline:middle;" y="-204">20</text>
			    <text fill="Silver" font-size="30" style="text-anchor:middle;font-weight:200;alignment-baseline:middle;" transform="rotate(-18)" y="-204">5</text>
			    <text fill="Silver" font-size="30" style="text-anchor:middle;font-weight:200;alignment-baseline:middle;" transform="rotate(-36)" y="-204">12</text>
			    <text fill="Silver" font-size="30" style="text-anchor:middle;font-weight:200;alignment-baseline:middle;" transform="rotate(-54)" y="-204">9</text>
			    <text fill="Silver" font-size="30" style="text-anchor:middle;font-weight:200;alignment-baseline:middle;" transform="rotate(-72)" y="-204">14</text>
			    <text fill="Silver" font-size="30" style="text-anchor:middle;font-weight:200;alignment-baseline:middle;" transform="rotate(-90)" y="-204">11</text>
			    <text fill="Silver" font-size="30" style="text-anchor:middle;font-weight:200;alignment-baseline:middle;" transform="rotate(72)" y="208">8</text>
			    <text fill="Silver" font-size="30" style="text-anchor:middle;font-weight:200;alignment-baseline:middle;" transform="rotate(54)" y="208">16</text>
			    <text fill="Silver" font-size="30" style="text-anchor:middle;font-weight:200;alignment-baseline:middle;" transform="rotate(36)" y="208">7</text>
			    <text fill="Silver" font-size="30" style="text-anchor:middle;font-weight:200;alignment-baseline:middle;" transform="rotate(18)" y="208">19</text>
			    <text fill="Silver" font-size="30" style="text-anchor:middle;font-weight:200;alignment-baseline:middle;" y="208">3</text>
			    <text fill="Silver" font-size="30" style="text-anchor:middle;font-weight:200;alignment-baseline:middle;" transform="rotate(-18)" y="208">17</text>
			    <text fill="Silver" font-size="30" style="text-anchor:middle;font-weight:200;alignment-baseline:middle;" transform="rotate(-36)" y="208">2</text>
			    <text fill="Silver" font-size="30" style="text-anchor:middle;font-weight:200;alignment-baseline:middle;" transform="rotate(-54)" y="208">15</text>
			    <text fill="Silver" font-size="30" style="text-anchor:middle;font-weight:200;alignment-baseline:middle;" transform="rotate(-72)" y="208">10</text>
			  </g><!-- CLOSE G WITH ID NUMBERS -->

			</svg><!-- CLOSE SVG/ DARTBOARD -->
		</div><!-- CLOSE DIV WITH CLASS BOARD -->
		<div class="gameButtons">
			<button id="undoScore">undo</button>
			<button id="friendly">Friendly</button>
		</div>
		<div class="lower_scoreboard">
			<div class="inner_scoreboard">Aim at<p id="aimAt"></p></div>
			<div class="inner_scoreboard">Singles Hit<p id="gameSingles"></p></div>
			<div class="inner_scoreboard">Doubles Hit<p id="gameDoubles"></p></div>
			<div class="inner_scoreboard">Trebles Hit<p id="gameTrebles"></p></div>
			<div class="inner_scoreboard">Game Score<p id="gameScore"></p></div>
			<div class="inner_scoreboard">Darts Missed<p id="missed"></p></div>
		</div>
	</div><!-- CLOSE DIV WITH CLASS PAGE -->

	<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>

  <script type="text/javascript">
  	var players = [];
  	function createPlayer(name)
  	{
  		var player = 
  		{
  			name: name,
  			gameType: '<?=$gameType;?>',
  			targetNum: 1,
  			numDarts: 0,
  			singlesHit: 0,
  			doublesHit: 0,
  			treblesHit: 0,
  			scores: [],
  			dartsMissed: 0,
  			totalScored: 0
  		}
  		players.push(player);
  		localStorage.world = JSON.stringify(players);
  	}

  	createPlayer('<?=$user_username;?>');
  </script>

  <script type="text/javascript" src="roundTheWorld.js"></script>

</body>
</html>