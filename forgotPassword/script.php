<?php
session_start();
$pass = $_POST['pass'];
$pass    = md5($pass);//шифруем пароль
$pass    = strrev($pass);// для надежности добавим реверс
$pass   = $pass."b3p6f";
$em = $_SESSION['fmail'];

include ("../bd/bd.php");// файл bd.php должен быть в той же папке, что и все остальные, если это не так, то просто измените путь 
 
$result = mysql_query("SELECT * FROM users WHERE `e-mail`='$em'",$db); //извлекаем из базы все данные о пользователе с введенным логином
    $myrow = mysql_fetch_array($result);
	$idd = $myrow['id'];
	mysql_query("UPDATE  `users` SET  `password` =  '$pass' WHERE  `id` ='$idd'",$db) or die(mysql_error());
	echo '<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Главная страница</title>
	<link rel="stylesheet" type="text/css" href="../css/review.css">
    </head>
    <body>
	<span>Пароль изменён</span></br>
	<a href="../index.php">На главную страницу</a>
	</body>
    </html>';
?>