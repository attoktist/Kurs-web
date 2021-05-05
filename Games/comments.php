<?php
session_start();
include_once('../bd/bd.php');

  /* Принимаем данные из формы */
  //$name = $_POST["name"];
  $id_gameC = $_POST["id_game"];
  $id_user = $_SESSION['id'];
  $text_comment = $_POST["text_comment"];
  //$name = htmlspecialchars($name);// Преобразуем спецсимволы в HTML-сущности
  $text_comment = htmlspecialchars($text_comment);// Преобразуем спецсимволы в HTML-сущности
  //$mysql = new mysql("localhost", "root", "", "db");// Подключается к базе данных
  //$mysql->query("INSERT INTO `comments` (`name`, `page_id`, `text_comment`) VALUES ('$name', '$page_id', '$text_comment')");// Добавляем комментарий в таблицу
  $insert_comment = mysql_query("INSERT INTO `comments` (`id_game`, `id_user`, `text_comment`) VALUES ('$id_gameC', '$id_user', '$text_comment')",$db); 
//$myrowGame = mysql_fetch_array($resultGame);
  header("Location: ".$_SERVER["HTTP_REFERER"]);// Делаем реридект обратно
?>