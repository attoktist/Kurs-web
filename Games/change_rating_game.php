<?php
session_start();
include_once('../bd/bd.php');
if (is_numeric($_POST["obj_id"])) $obj=$_POST["obj_id"];
else $obj='';
if ($_POST["rating"]>=0 and $_POST["rating"]<=5) $ocenka=$_POST["rating"];
else $ocenka='';

if ($ocenka!='' and $obj>0) {
 $time=$_SERVER['REQUEST_TIME'];
 $ip=$_SERVER['REMOTE_ADDR'];
 
 $res=mysql_query("DELETE FROM votes_game WHERE date<".($time-604800),$db);
 $res=mysql_query("SELECT count(id) FROM votes_game WHERE id_game='$obj' and ip=INET_ATON('".$ip."')",$db);
 $number=mysql_fetch_array($res);
 if ($number[0]==0) {
    $res=mysql_query("INSERT INTO votes_game (date,id_game,ip,rating)
        values (".$time.",".$obj.",INET_ATON('".$ip."'),".$ocenka.")",$db);
	//$oc = mysql_query("SELECT * FROM games WHERE id_game='$obj')",$db);
	//$oca = mysql_fetch_array($oc);
	//$points = $oca['points']+$ocenka;
	//$votes = $oca['votes']+1;
	
	$res1=mysql_query("UPDATE games
        SET points=(points+".$ocenka."),votes=(votes+1) WHERE id_game='$obj' LIMIT 1",$db); 	
    echo 'Спасибо, Ваш голос учтен!';
 }
 else echo 'Вы уже сегодня голосовали!';
}
?>