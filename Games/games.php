<?php
session_start();
include_once('../bd/bd.php');

echo '<html>
    <head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Игры</title>
	<link rel="stylesheet" type="text/css" href="../css/games.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>	
	<script src="../Scripts/games.js"></script>
    </head>
    <body>
	<div id="background"></div>
    <h2 id="head_str">Игры</h2>
	<a  href="../index.php">На главную страницу</a></br>';
	
	echo '	<button id="anim_filter">Фильтр</button>
			<div id="Filter">
			<div><input type="text" placeholder="Поиск по названию" class="elem_filter_namesearch"></div>
				<ul id="genre">
					<li class="Header" data-name="header"> Жанр:</li>
				</ul>
			
				<ul id="year">
					<li class="Header" data-name="header"> Год:</li>
				</ul>
			
				<ul id="developer">
					<li class="Header" data-name="header"> Разработчик:</li>
				</ul>					
		</div>';
	
$resultGames = mysql_query("SELECT * FROM Games",$db); //извлекаем из базы все данные о пользователе с введенным логином
$row = mysql_fetch_array($resultGames);
$num_rows_games = mysql_num_rows($resultGames);


echo '<div class="table">';
for ($i = 0; $i < $num_rows_games; $i++) 
{	
echo '<div class="all" data-jkname="'.$row['Name'].'" data-genre="'.$row['Genre'].'" data-year="'.$row['Year'].'" data-developer="'.$row['Developer'].'">';
	echo '<img src="'.$row['Image'].'" alt="avatar" class="game_image">';
	echo '<a class="link" href="game.php?id_game='.$row['id_game'].'">'.$row['Name'].'</a></br>';
	echo '</div>';
	$row = mysql_fetch_array($resultGames);	
}
echo '</div>';

echo '</body>
    </html>';

?>