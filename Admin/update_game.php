<?php
session_start();
include_once('../bd/bd.php');
$id_game = $_POST['option'];

$resultGames = mysql_query("SELECT * FROM Games WHERE id_game='$id_game'",$db); 
$row = mysql_fetch_array($resultGames);

echo '<html>
    <head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Обновление игры</title>
	<link rel="stylesheet" type="text/css" href="../css/game.css">	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="../Scripts/game.js"></script>	
    </head>
    <body>';	
	
echo'	<form action="script_update_game.php" method="POST" ENCTYPE="multipart/form-data">
			<label>Название </label><input name="Name" value="'.$row['Name'].'" type="text" size="15" maxlength="255"><br/>
			<label>Жанр </label><input name="Genre" value="'.$row['Genre'].'" type="text" size="15" maxlength="255"><br/>
			<label>Год </label><input name="Year" value="'.$row['Year'].'" type="text" size="15" maxlength="255"><br/>
			<label>Разработчик </label><input value="'.$row['Developer'].'" name="Developer" type="text" size="15" maxlength="255"><br/>
			<label>Описание </label><textarea name="Description" cols="50" rows="10">'.$row['Description'].'</textarea><br/>
			<label>Изображение </label><input name="Image" type="file" value=""><br/>
			<label>Суммарная оценка </label><input name="points" value="'.$row['points'].'" type="text" size="15" maxlength="255"><br/>
			<label>Количество проголосовавших</label><input name="votes" value="'.$row['votes'].'" type="text" size="15" maxlength="255"><br/>
			<input type="hidden" name="id_game" value="'.$id_game.'" />
			<input type="hidden" name="path" value="'.$row['Image'].'" />
			<input type="submit" value="Обновить данные об игре '.$row['Name'].'" />
		</form>';
		
echo '	<form action="delete_game.php" method="POST" >
			<input type="hidden" name="id_game" value="'.$id_game.'" />			
			<input type="submit" value="Удалить игру '.$row['Name'].'" />
		</form>';
	
	echo '</body>
    </html>';

?>