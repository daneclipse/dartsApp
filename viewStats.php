<?php

  include('connection.php');
  $user_username = $_GET['username'];
  
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
  <link rel="stylesheet" type="text/css" href="css/general.css">
  <style type="text/css">
    .navBar h1 {
      width: 33.3%;
    }
  </style>
</head>
<body>

<div class="navBar">
  <h1 class="accountName"><?= $user_username;?></h1>
  <a href="account.php?username=<?=$user_username;?>">Back to account</a>
  <span class="logOutButton"><a href="login.php" >Log out</a></span>
</div><!-- CLOSE DIV WITH CLASS NAVBAR -->

<div class="page">
  <div class="viewStatsButtons">
    <a class="viewStatsButton" href="X01/viewX01Stats.php?username=<?=$user_username;?>">X01 Stats</a>
    <a class="viewStatsButton" href="100DartsAt/view100DartsStats.php?username=<?=$user_username;?>">100 Darts Stats</a>
    <a class="viewStatsButton" href="roundTheWorld/viewWorldStats.php?username=<?=$user_username;?>">Round the world stats</a>
    <a class="viewStatsButton" href="cricket/viewCricketStats.php?username=<?=$user_username;?>">Cricket stats</a>
  </div><!-- CLOSE DIV WITH ID VIEWSTATSBUTTON -->

</div><!-- CLOSE DIV WITH CLASS PAGE -->

<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>


 <!--  <script type="text/javascript">
  	var legStats = $('#legStats');
  	var overallStats = $('#overallStats');
  	var viewStats = $('#viewStats');

  	legStats.on('click', function()
  	{
      $(viewStats).empty();
      var xmlhttp;
      xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function()
      {
        if (this.readyState == 4 && this.status == 200) 
        {
          $(viewStats).html(this.responseText);
        }
      }
      xmlhttp.open('GET', 'viewStats.php?username=<?=$user_username;?>'+'&stats=leg', true);
      xmlhttp.send();
  	})

  	overallStats.on('click', function()
    {
      $(viewStats).empty();
      var xmlhttp;
      xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function()
      {
        if (this.readyState == 4 && this.status == 200) 
        {
          $(viewStats).html(this.responseText);
        }
      }
      xmlhttp.open('GET', 'viewStats.php?username=<?=$user_username;?>'+'&stats=overall', true);
      xmlhttp.send();
    })

  </script> -->



</body>
</html>