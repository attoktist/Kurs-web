<?php
session_start();
include_once('../bd/bd.php');

echo '<html>
    <head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Добавление игры</title>
	<link rel="stylesheet" type="text/css" href="../css/game.css">	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="../Scripts/game.js"></script>	
    </head>
    <body>';	
	
echo'	<form action="script_add_game.php" method="POST" ENCTYPE="multipart/form-data">
			<label>Название </label><input name="Name" value="Новая игра" type="text" size="15" maxlength="255"><br/>
			<label>Жанр </label><input name="Genre"  type="text" size="15" maxlength="255"><br/>
			<label>Год </label><input name="Year"  type="text" size="15" maxlength="255"><br/>
			<label>Разработчик </label><input  name="Developer" type="text" size="15" maxlength="255"><br/>
			<label>Описание </label><textarea name="Description" cols="50" rows="10"></textarea><br/>
			<label>Изображение </label><input name="Image" type="file" value=""><br/>
			<label>Суммарная оценка </label><input name="points" value="0" type="text" size="15" maxlength="255"><br/>
			<label>Количество проголосовавших</label><input name="votes" value="0" type="text" size="15" maxlength="255"><br/>			
			<input type="submit" value="Добавить игру" />
		</form>';
	
	echo '</body>
    </html>';

?>