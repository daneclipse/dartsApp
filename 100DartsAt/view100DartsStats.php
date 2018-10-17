<?php

include('../connection.php');

$user_username = $_GET['username'];
$stats = $_GET['stats'];

// <th><a href="viewStats.php?username=' . $user_username . '&stats=every">Date</a></th>

function showTable($row, $arr, $user_username)
  {
      echo
      '<table border = "1">
      <tr>
      <th><a href="view100DartsStats.php?username=' . $user_username . '&stats=every&page=1&order=date">Game Date</a></th>
      <th>Target Number</th>
      <th><a href="view100DartsStats.php?username=' . $user_username . '&stats=every&page=1&order=single">Singles Hit</a></th>
      <th><a href="view100DartsStats.php?username=' . $user_username . '&stats=every&page=1&order=double">Doubles Hit</a></th>
      <th><a href="view100DartsStats.php?username=' . $user_username . '&stats=every&page=1&order=treble">Trebles Hit</a></th>
      <th><a href="view100DartsStats.php?username=' . $user_username . '&stats=every&page=1&order=points">Points Scored</a></th>
      <th><a href="view100DartsStats.php?username=' . $user_username . '&stats=every&page=1&order=score">Total Scored</a></th>
      <th>Darts Missed</th>
      </tr>';
      // $order = $_GET['order'];

      while ($row = mysqli_fetch_array($arr)) 
      {
        $date = $row['game_date'];
        $targetNumber = $row['targetNumber'];
        $singlesHit = $row['singlesHit'];
        $doublesHit = $row['doublesHit'];
        $treblesHit = $row['treblesHit'];
        $pointsScored = $row['pointsScored'];
        $totalScored = $row['totalScored'];
        $dartsMissed = $row['dartsMissed'];

        echo '<td>' . $date . '</td>';
        echo '<td>' . $targetNumber . '</td>';
        echo '<td>' . $singlesHit . '</td>';
        echo '<td>' . $doublesHit . '</td>';
        echo '<td>' . $treblesHit . '</td>';
        echo '<td>' . $pointsScored . '</td>';
        echo '<td>' . $totalScored . '</td>';
        echo '<td>' . $dartsMissed . '</td></tr>';
      }
      echo '</table><br />';
  } // END OF SHOWTABLE FUNCTION

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../css/general.css">
	<link rel="stylesheet" type="text/css" href="100DartsAt.css">
</head>
<body>

	<div class="navBar">
	  <h1 class="accountName"><?= $user_username;?></h1>
	  <a href="../account.php?username=<?=$user_username;?>">Back to account</a>
	  <span class="logOutButton"><a href="login.php" >Log out</a></span>
	</div><!-- CLOSE DIV WITH CLASS NAVBAR -->

	<div class="page">
		<div class="viewStatsButtons">
	      <a class="viewStatsButton" href="../X01/viewX01Stats.php?username=<?=$user_username;?>">X01 Stats</a>
	      <a class="viewStatsButton" href="../roundTheWorld/viewWorldStats.php?username=<?=$user_username;?>">Round the world stats</a>
	      <a class="viewStatsButton" href="../cricket/viewCricketStats.php?username=<?=$user_username;?>">Cricket stats</a>
	    </div><!-- CLOSE DIV WITH ID VIEWSTATSBUTTON -->
		<h1>100 Darts Stats</h1>
		<div class="viewStatsButtons">
			<a id="everyButton" class="viewStatsButton" href="view100DartsStats.php?username=<?=$user_username;?>&stats=every&page=1">EVERY GAME</a>
			<a id="bestButton" class="viewStatsButton" href="view100DartsStats.php?username=<?=$user_username;?>&stats=best">BEST GAME</a>
		</div>

		<div id="viewStats">
			
			<?php

			if (isset($_GET['stats'])) 
			{
				if ($_GET['stats'] == 'every') 
				{
	                $page = $_GET['page'];
	                $perPage = 10;
	                if ($page == '' || $page == 1) 
	                {
	                    $currentPage = 0;
	                }
	                else
	                {
	                    $currentPage = ($page * $perPage) - $perPage;
	                }

	                if (isset($_GET['order'])) 
	                {
	                	if ($_GET['order'] == 'date') 
	                	{
			                $getStats = "SELECT * FROM hundredDarts WHERE username='$user_username' ORDER BY game_date DESC LIMIT $currentPage, $perPage";
			                $statsQuery = mysqli_query($dbc, $getStats);
			                $numRows = mysqli_num_rows($statsQuery);
	                	}
	                	else if ($_GET['order'] == 'single')
	                	{
			                $getStats = "SELECT * FROM hundredDarts WHERE username='$user_username' ORDER BY singlesHit DESC LIMIT $currentPage, $perPage";
			                $statsQuery = mysqli_query($dbc, $getStats);
			                $numRows = mysqli_num_rows($statsQuery);
	                	}
	                	else if ($_GET['order'] == 'double')
	                	{
			                $getStats = "SELECT * FROM hundredDarts WHERE username='$user_username' ORDER BY doublesHit DESC LIMIT $currentPage, $perPage";
			                $statsQuery = mysqli_query($dbc, $getStats);
			                $numRows = mysqli_num_rows($statsQuery);
	                	}
	                	else if ($_GET['order'] == 'treble')
	                	{
			                $getStats = "SELECT * FROM hundredDarts WHERE username='$user_username' ORDER BY treblesHit DESC LIMIT $currentPage, $perPage";
			                $statsQuery = mysqli_query($dbc, $getStats);
			                $numRows = mysqli_num_rows($statsQuery);
	                	}
	                	else if ($_GET['order'] == 'points')
	                	{
			                $getStats = "SELECT * FROM hundredDarts WHERE username='$user_username' ORDER BY pointsScored DESC LIMIT $currentPage, $perPage";
			                $statsQuery = mysqli_query($dbc, $getStats);
			                $numRows = mysqli_num_rows($statsQuery);
	                	}
	                	else if ($_GET['order'] == 'score')
	                	{
			                $getStats = "SELECT * FROM hundredDarts WHERE username='$user_username' ORDER BY totalScored DESC LIMIT $currentPage, $perPage";
			                $statsQuery = mysqli_query($dbc, $getStats);
			                $numRows = mysqli_num_rows($statsQuery);
	                	}
	                	else
	                	{
			                $getStats = "SELECT * FROM hundredDarts WHERE username='$user_username' ORDER BY game_date DESC LIMIT $currentPage, $perPage";
			                $statsQuery = mysqli_query($dbc, $getStats);
			                $numRows = mysqli_num_rows($statsQuery);
	                	}
	                }
	                else
	                {
		                $getStats = "SELECT * FROM hundredDarts WHERE username='$user_username' ORDER BY game_date DESC LIMIT $currentPage, $perPage";
		                $statsQuery = mysqli_query($dbc, $getStats);
		                $numRows = mysqli_num_rows($statsQuery);
		            }

	                if ($numRows > 0) 
	                {
	                	showTable($numRows, $statsQuery, $user_username);
	                    $query = mysqli_query($dbc, "SELECT * FROM hundredDarts WHERE username='$user_username'");
	                    $totalRows = mysqli_num_rows($query);
	                    // how many records per page we want
	                    // work out total number of pages needed 
	                    // ceil gives you the next integar
	                    $totalPages = ceil($totalRows / $perPage);

	                    if ($page > 1) 
	                    {
	                        echo '<a class="pagination" href="view100DartsStats.php?username=' . $user_username . '&stats=every&page=' . ($page - 1) . '"><< Previous</a>';
	                    }

	                    for($i = 1; $i <= $totalPages; $i++)
	                    {
	                        if ($page == $i) 
	                        {
	                          echo '<a class="pagination activePage" href="view100DartsStats.php?username=' . $user_username . '&stats=every&page=' . $i . '">' . $i . '</a>';
	                        }
	                        else
	                        {
	                          echo '<a class="pagination" href="view100DartsStats.php?username=' . $user_username . '&stats=every&page=' . $i . '">' . $i . '</a>';
	                        }
	                    }

	                    if ($page < $totalPages) 
	                    {
	                        echo '<a class="pagination" href="view100DartsStats.php?username=' . $user_username . '&stats=every&page=' . ($page + 1) . '">Next >></a>';
	                    }
	                }
	                else
	                {
	                	echo '<p class="alertMessage redButton">NO STATS AVAILABLE</p>';
	                	echo '<button class="logIn"><a href="../gameSetup.php?username=' . $user_username . '">Start a game</a></button>';
	                }
				}
				else if ($_GET['stats'] == 'best') 
				{
	                $getStats = "SELECT * FROM hundredDarts WHERE username='$user_username' ORDER BY pointsScored DESC LIMIT 1";
	                $statsQuery = mysqli_query($dbc, $getStats);
	                $numRows = mysqli_num_rows($statsQuery);

	                if ($numRows > 0) 
	                {
	            	    echo
					    '<table border = "1">
					    <tr>
					    <th>Game Date</th>
					    <th>Target Number</th>
					    <th>Singles Hit</th>
					    <th>Doubles Hit</th>
					    <th>Trebles Hit</th>
					    <th>Points Scored</th>
					    <th>Total Scored</th>
					    <th>Darts Missed</th>
					    </tr>';
					    // $order = $_GET['order'];

					    while ($row = mysqli_fetch_array($statsQuery)) 
					    {
					      $date = $row['game_date'];
					      $targetNumber = $row['targetNumber'];
					      $singlesHit = $row['singlesHit'];
					      $doublesHit = $row['doublesHit'];
					      $treblesHit = $row['treblesHit'];
					      $pointsScored = $row['pointsScored'];
					      $totalScored = $row['totalScored'];
					      $dartsMissed = $row['dartsMissed'];

					      echo '<td>' . $date . '</td>';
					      echo '<td>' . $targetNumber . '</td>';
					      echo '<td>' . $singlesHit . '</td>';
					      echo '<td>' . $doublesHit . '</td>';
					      echo '<td>' . $treblesHit . '</td>';
					      echo '<td>' . $pointsScored . '</td>';
					      echo '<td>' . $totalScored . '</td>';
					      echo '<td>' . $dartsMissed . '</td></tr>';
					    }
					    echo '</table><br />';
	                }
	                else
	                {
	                	echo '<p class="alertMessage redButton">NO STATS AVAILABLE</p>';
	                	echo '<button class="logIn"><a href="../gameSetup.php?username=' . $user_username . '">Start a game</a></button>';
	                }
				}
				else
				{
					echo '<p class="alertMessage redButton">NO STATS AVAILABLE</p>';
					echo '<button class="logIn"><a href="../gameSetup.php?username=' . $user_username . '">Start a game</a></button>';
				}
			}

			?>

		</div>

	</div>


<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>

  <script type="text/javascript">
  	var type = location.search.split('&')[1].split('=')[1];
  	if (type == 'every') 
  	{
  		$('#everyButton').addClass('active');
  		$('#bestButton').removeClass('active');
  	}
  	else if (type == 'best') 
  	{
  		$('#bestButton').addClass('active');
  		$('#everyButton').removeClass('active');
  	}
  </script>

</body>
</html>