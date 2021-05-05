<?php
session_start();
$id_review = $_GET["id_review"];

include_once('../bd/bd.php');

$resultRev = mysql_query("SELECT * FROM Reviews WHERE id_review='$id_review'",$db); 
$myrowRev = mysql_fetch_array($resultRev);
$rating = $myrowRev['points']/$myrowRev['votes'];
$name = $myrowRev['id_user'];

$result_name_review = mysql_query("SELECT login FROM users WHERE `id`='$name'",$db);
	$row_name_review = mysql_fetch_array($result_name_review);

	

echo '<html>
    <head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>'.$myrowRev['Name_review'].'</title>
	<link rel="stylesheet" type="text/css" href="../css/review.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="../Scripts/review.js"></script>
    </head>
    <body>
	<a  href="reviews.php?id_game='.$myrowRev['id_game'].'">Обратно к списку обзоров</a></br>
    <h2 id="head_str">'.$myrowRev['Name_review'].'</h2>';
echo '<div class="obzor"><span>Писатель: </span>'.$row_name_review['login'].'<br/> '.$myrowRev['text_review'].'</br></div>';
echo '
<div id="rating">
<div class="param">Информативность:</div>
<div><div class="stars"></div><p class="progress" id="p1"></p></div>
<div class="rating" id="param1">5.0</div>

<div class="param">Читабельность:</div>
<div><div class="stars"></div><p class="progress" id="p2"></p></div>
<div class="rating" id="param2">5.0</div>

<div class="param">Краткость:</div>
<div><div class="stars"></div><p class="progress" id="p3"></p></div>
<div class="rating" id="param3">5.0</div>

<div class="param">Ваша общая оценка:</div>
<div><div id="sum_stars"></div><p id="sum_progress"></p></div>
<div id="summ">5.00</div>

<div id="rating_obzor">
<div  class="param">Оценка обзора:</div>
<div><div id="sum_stars_all"></div><p id="sum_progress_all"></p></div>
<div id="summ_all">'.$rating.'</div>
</div>

<input id="el_'.$id_review.'" type="submit" value="Отправить!">
<p id="message"></p>
</div>';


   $result_set_review = mysql_query("SELECT * FROM review_comments WHERE `id_review`='$id_review'",$db); 
 
 $num_rows_comments_review = mysql_num_rows($result_set_review);
 echo '<div class="review_comments">
	';
 for ($j = 0; $j < $num_rows_comments_review; $j++) 
{	
	$row_set_review = mysql_fetch_array($result_set_review);		
	$id_login_review = $row_set_review[2];
	$result_name_rev = mysql_query("SELECT login FROM users WHERE `id`='$id_login_review'",$db);
	$row_name_rev = mysql_fetch_array($result_name_rev);
	echo "<br />";
	print($row_name_rev['login']);
    echo "<br />";	
	print($row_set_review[3]);
    echo "<br />";
}


echo '<form name="review_comment" action="review_comments.php" method="post">  
  <p>
    <label>Комментарий:</label>
    <br />
    <textarea name="text_review_comment" cols="30" rows="10"></textarea>
  </p>
  <p>
    <input type="hidden" name="id_review" value="'.$id_review.'" />
    <input type="submit" value="Отправить" />
  </p>
</form></div>';
	
echo '</body>
    </html>';

?>