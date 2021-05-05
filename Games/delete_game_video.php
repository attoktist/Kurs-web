<?php
session_start();
$id_video = $_GET["id_video"];

include_once('../bd/bd.php');

$myresultVideo = mysql_query("DELETE FROM `game_video` WHERE `id_video` = '$id_video'",$db); //Удаляем видео по id_video

header("Location: ".$_SERVER["HTTP_REFERER"]);// Делаем реридект обратно
?>