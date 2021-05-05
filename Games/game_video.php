<?php
session_start();
$id_video = $_GET["id_video"];

include_once('../bd/bd.php');

$myresultVideo = mysql_query("SELECT * FROM game_video WHERE id_video='$id_video'",$db); //извлекаем из базы все данные о пользователе с введенным логином
$myrowVideo = mysql_fetch_array($myresultVideo);

echo '<html>
    <head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>'.$myrowVideo['Name_video'].'</title>
	<link rel="stylesheet" type="text/css" href="../css/game.css">	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script type="text/javascript" src="../FlowPlayer/flowplayer-3.2.2.min.js"></script>
	
    </head>
    <body>
	<a  href="game.php?id_game='.$myrowVideo['id_game'].'">Обратно к странице игры</a></br>';


echo '<div class="player"><a href="'.$myrowVideo['path'].'" style="display: block; width: 500px; height: 400px;" id="player"></a>
<script language="JavaScript">
  flowplayer("player", {src : "http://kurs/FlowPlayer/flowplayer-3.2.2.swf", wmode: "transparent"});
</script></div>';

echo '</body>
    </html>';