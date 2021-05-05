<?php
session_start();
$id_game = $_GET["id_game"];

include_once('../bd/bd.php');

$resultGame = mysql_query("SELECT * FROM Games WHERE id_game='$id_game'",$db); 
$myrowGame = mysql_fetch_array($resultGame);


echo '<html>
    <head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Добавление скриншота</title>
	<link rel="stylesheet" type="text/css" href="../css/game.css">	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="../Scripts/game.js"></script>	
    </head>
    <body>';
	
	echo '<form name="screenshot" action="script_add_game_screenshot.php" method="post" ENCTYPE="multipart/form-data">  
  <p>
    <label>Название скриншота:</label>
    <br />
    <input name="Name_screenshot" type="text" size="15" maxlength="255">
  </p>
  <p>
	<input type="hidden" name="id_game" value="'.$id_game.'" />
    <input name="screenshot" type="file" value="">
    <input type="submit" value="Отправить" />
  </p>
</form>';
	
echo '</body>
    </html>';
?>