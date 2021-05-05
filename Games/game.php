<?php
session_start();
$id_game = $_GET["id_game"];

include_once('../bd/bd.php');

$resultGame = mysql_query("SELECT * FROM Games WHERE id_game='$id_game'",$db); 
$myrowGame = mysql_fetch_array($resultGame);
$rating = $myrowGame['points']/$myrowGame['votes'];

echo '<html>
    <head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>'.$myrowGame['Name'].'</title>
	<link rel="stylesheet" type="text/css" href="../css/game.css">	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="../Scripts/game.js"></script>	
    </head>
    <body>
	<a  href="games.php">Обратно к списку игр</a></br>';

echo '<h2 id="head_str">'.$myrowGame['Name'].'</h2><div id="data">';
echo '<div><span class="text">Жанр: '.$myrowGame['Genre'].'</span></div>';
echo '<div><span class="text">Год: '.$myrowGame['Year'].'</span></div>';
echo '<div><span class="text">Разработчик: '.$myrowGame['Developer'].'</span></div>';
echo '<div class="text"><span >Описание: '.$myrowGame['Description'].'</span></div></br>';
echo '<div class="logo"><img src="'.$myrowGame['Image'].'" alt="avatar" id="avatar"></div></div>'; 

echo '
<div id="rating">
<div class="param">Сюжет:</div>
<div><div class="stars"></div><p class="progress" id="p1"></p></div>
<div class="rating" id="param1">5.0</div>

<div class="param">Геймплей:</div>
<div><div class="stars"></div><p class="progress" id="p2"></p></div>
<div class="rating" id="param2">5.0</div>

<div class="param">Реиграбельность:</div>
<div><div class="stars"></div><p class="progress" id="p3"></p></div>
<div class="rating" id="param3">5.0</div>

<div class="param">Ваша общая оценка:</div>
<div><div id="sum_stars"></div><p id="sum_progress"></p></div>
<div id="summ">5.00</div>

<div id="ocenka">
<div class="param">Общая оценка:</div>
<div><div id="sum_stars_all"></div><p id="sum_progress_all"></p></div>
<div id="summ_all">'.$rating.'</div>
</div>

<input id="el_'.$id_game.'" type="submit" value="Отправить!">
<p id="message"></p>
</div>';




 $result_set = mysql_query("SELECT * FROM comments WHERE `id_game`='$id_game'",$db); 
echo '<div class="comments">';
 $num_rows_comments = mysql_num_rows($result_set);
 for ($j = 0; $j < $num_rows_comments; $j++) 
{	
	$row_set = mysql_fetch_array($result_set);		
	$id_login = $row_set[2];
	$result_name = mysql_query("SELECT login FROM users WHERE `id`='$id_login'",$db);
	$row_name = mysql_fetch_array($result_name);
	echo "<br />";
	print($row_name['login']);
    echo "<br />";	
	print($row_set[3]);
    echo "<br />";		
}
echo '<div class="form_comment"><form name="comment" action="comments.php" method="post">  
  <p>
    <label>Комментарий:</label>
    <br />
    <textarea name="text_comment" cols="30" rows="10"></textarea>
  </p>
  <p>
    <input type="hidden" name="id_game" value="'.$id_game.'" />
    <input type="submit" value="Отправить" />
  </p>
</form></div>
</div>';
$login_rewiew = $_SESSION['login'];
$result_review = mysql_query("SELECT * FROM users WHERE `login`='$login_rewiew'",$db);
$row_review = mysql_fetch_array($result_review);
if(($row_review['rights'] == 2) || ($row_review['rights'] == 1))
{
	echo '<a class="write_review" href="write_review.php?id_game='.$id_game.'">Написать обзор</a></br>';
}

echo '<a class="reviews" href="reviews.php?id_game='.$id_game.'">Обзоры</a></br>';

$resultVideos = mysql_query("SELECT * FROM game_video WHERE id_game='$id_game'",$db); //извлекаем из базы все данные о пользователе с введенным логином
$rowVideos = mysql_fetch_array($resultVideos);
$num_rows_videos = mysql_num_rows($resultVideos);


echo '<div class="videos">
<span class="v_text">Видео</span><br/>
<a class="add_video" href="add_game_video.php?id_game='.$id_game.'">Добавить видео</a><br/><br/>';
for ($i = 0; $i < $num_rows_videos; $i++) 
{	
	echo '<a href="game_video.php?id_video='.$rowVideos['id_video'].'">'.$rowVideos['Name_video'].'</a>';
	if($row_review['rights'] == 1)
	{
		echo '<a href="delete_game_video.php?id_video='.$rowVideos['id_video'].'"> Удалить</a>';
	}
	echo '</br>';
	$rowVideos = mysql_fetch_array($resultVideos);	
}
echo '</div>';
$resultScreenshots = mysql_query("SELECT * FROM game_screenshots WHERE id_game='$id_game'",$db); //извлекаем из базы все данные о пользователе с введенным логином
$rowScreenshots = mysql_fetch_array($resultScreenshots);
$num_rows_screenshots = mysql_num_rows($resultScreenshots);

echo '
<div id="screens"><span class="sc_text">Скриншоты</span><br/>
<a class="add_screenshot" href="add_game_screenshot.php?id_game='.$id_game.'">Добавить скриншот</a></br>';

for ($i = 0; $i < $num_rows_screenshots; $i++) 
{	
	echo '<img src="'.$rowScreenshots['path'].'" alt="'.$rowScreenshots['Name_screenshot'].'" class="screenshots">'; 
	if($row_review['rights'] == 1)
	{
		echo '<a href="delete_game_screenshot.php?id_screenshot='.$rowScreenshots['id_screenshot'].'"> Удалить</a>';
	}
	echo '</br>';
	$rowScreenshots = mysql_fetch_array($resultScreenshots);	
}
echo '</div>';


echo '';
	
echo '</body>
    </html>';

?>