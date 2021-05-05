<?php
session_start();
$id_game = $_POST["id_game"];

include_once('../bd/bd.php');

mysql_query("DELETE FROM `games` WHERE `id_game` = '$id_game'",$db); //Удаляем игру по id_game

//header("Location: ".$_SERVER["HTTP_REFERER"]);// Делаем реридект обратно
?>