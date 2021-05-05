<?php
session_start();
$id_screenshot = $_GET["id_screenshot"];

include_once('../bd/bd.php');

$myresultVideo = mysql_query("DELETE FROM `game_screenshots` WHERE `id_screenshot` = '$id_screenshot'",$db); //Удаляем скриншот по id_screenshot

header("Location: ".$_SERVER["HTTP_REFERER"]);// Делаем реридект обратно
?>