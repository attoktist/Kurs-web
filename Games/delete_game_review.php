<?php
session_start();
$id_review = $_GET["id_review"];

include_once('../bd/bd.php');

mysql_query("DELETE FROM `reviews` WHERE `id_review` = '$id_review'",$db); //Удаляем обзор

header("Location: ".$_SERVER["HTTP_REFERER"]);// Делаем реридект обратно
?>