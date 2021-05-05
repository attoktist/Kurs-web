<?php
session_start();
include_once('../bd/bd.php');

  /* Принимаем данные из формы */  
  $id_review = $_POST["id_review"];
  $id_user = $_SESSION['id'];
  $text_review_comment = $_POST["text_review_comment"];
  
  $text_review_comment = htmlspecialchars($text_review_comment);// Преобразуем спецсимволы в HTML-сущности  
  $insert_review_comment = mysql_query("INSERT INTO `review_comments` (`id_review`, `id_user`, `text_review_comment`) VALUES ('$id_review', '$id_user', '$text_review_comment')",$db); 
  header("Location: ".$_SERVER["HTTP_REFERER"]);// Делаем реридект обратно
?>