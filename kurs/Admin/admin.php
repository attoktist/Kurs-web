<?php
session_start();
include_once('../bd/bd.php');
$login=$_SESSION['login'];

$result_user = mysql_query("SELECT * FROM users WHERE `login`='$login'",$db);
$row_user = mysql_fetch_array($result_user);



if($row_user['rights'] != 1)
{
	exit("У вас нет прав для доступа к этой странице.");
}
else
{		
echo '<html>
    <head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Панель админа</title>
	<link rel="stylesheet" type="text/css" href="../css/game.css">	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="../Scripts/game.js"></script>	
    </head>
    <body>';	
echo '	<form action="update_game.php" method="POST">
			<select name="option">
			<option selected disabled>Выберите игру</option>';
$resultGames = mysql_query("SELECT * FROM Games",$db); 
$row = mysql_fetch_array($resultGames);
$num_rows_games = mysql_num_rows($resultGames);
			for ($i = 0; $i < $num_rows_games; $i++) 
			{	
				echo '<option value="'.$row['id_game'].'">'.$row['Name'].'</option>';
				$row = mysql_fetch_array($resultGames);	
			}								
echo '		</select>
			<input type="submit" value="Обновить данные по игре" />
		</form> ';
	
	echo '	<form action="add_game.php" method="POST">
				<input type="submit" value="Добавить игру в базу" />
			</form>';
	
echo '	<form action="update_user.php" method="POST">
			<select name="option_user">
			<option selected disabled>Выберите пользователя</option>';	
$resultUsers = mysql_query("SELECT * FROM users",$db); 
$rowUsers = mysql_fetch_array($resultUsers);
$num_rows_users = mysql_num_rows($resultUsers);
			for ($j = 0; $j < $num_rows_users; $j++) 
			{	
				echo '<option value="'.$rowUsers['id'].'">'.$rowUsers['login'].'</option>';
				$rowUsers = mysql_fetch_array($resultUsers);	
			}								
echo '		</select>
			<input type="submit" value="Обновить данные о пользователе" />
		</form> ';
		
	echo '</body>
    </html>';
	
}

?>