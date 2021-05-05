<?php
session_start();
include_once('../bd/bd.php');

$id_gm = $_GET["id_game"];;
$id_gmr = $_GET["id_game"];;
$resultGameReview = mysql_query("SELECT * FROM Games WHERE `id_game`='$id_gm'",$db); //извлекаем из базы все данные 
$rowGameReview = mysql_fetch_array($resultGameReview);

echo '<html>
    <head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Обзоры</title>
	<link rel="stylesheet" type="text/css" href="../css/review.css">
    </head>
    <body>	
	<a  href="game.php?id_game='.$id_gm.'">Обратно к странице игры</a></br>
    <h2 id="head_str">Обзоры на игру '.$rowGameReview["Name"].'</h2>';
	
$login_rewiew = $_SESSION['login'];
$result_review = mysql_query("SELECT * FROM users WHERE `login`='$login_rewiew'",$db);
$row_review = mysql_fetch_array($result_review);
	
$resultReviews = mysql_query("SELECT * FROM `reviews` WHERE `id_game`='$id_gmr'",$db); //извлекаем из базы все данные 
$rowReviews = mysql_fetch_array($resultReviews);
$num_rows_reviews = mysql_num_rows($resultReviews);
echo '<div class="obzors">';
for ($j = 0; $j < $num_rows_reviews; $j++) 
{	
	echo '<div><a href="review.php?id_review='.$rowReviews['id_review'].'">'.$rowReviews['Name_review'].'</a>';
	if($row_review['rights'] == 1)
	{
		echo '<a href="delete_game_review.php?id_review='.$rowReviews['id_review'].'"> Удалить</a></div>';
	}
	$rowReviews = mysql_fetch_array($resultReviews);	
}
echo '</div>';

echo '
</body>
    </html>';

?>