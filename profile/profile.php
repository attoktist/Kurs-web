<?php
 session_start(); 
 include_once('../bd/bd.php');

$login = $_SESSION['login'];
$id = $_SESSION['id'];
if(!empty($login))
{
$resultUsers = mysql_query("SELECT * FROM users WHERE login='$login'",$db); 
$rowUsers = mysql_fetch_array($resultUsers);


include('../bd/bd.php');
    


echo '<html>  
    <head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Профиль</title>
	<link rel="stylesheet" type="text/css" href="profile.css">	
    </head>
    <body>
	<div id="background"><img src="../images/Background.jpg" alt="background" id="batman"></div>
	<a class="link_back" href="../index.php">Вернуться на главную страницу</a>';
	
echo '<div class="data_text">
<label>Пользователь: '.$login.'</label></br>
<label>Фамилия: '.$rowUsers['LastName'].'</label></br>';
echo '<label>Имя: '.$rowUsers['FirstName'].'</label></br>';
echo '<label>Отчество: '.$rowUsers['MiddleName'].'</label></br>';
echo '<label>Дата рождения: '.$rowUsers['DateOfBirth'].'</label></br>';
echo '<label>e-mail: '.$rowUsers['e-mail'].'</label></br>
</div>';
echo '<div id="avatar">
		<label id="avatar_text">Аватар</label>
		<img src="'.$rowUsers['avatar'].'" alt="avatar" id="avatar">
	</div>';
	
echo '<input id="edit" type="button" name="edit" value="Изменить данные">
	<div class="data_change">
	<form action="profile_send.php" method="post" ENCTYPE="multipart/form-data">
	<input id="exit" type="button" name="exit" value="Закрыть">
	<p>
    <label>Фамилия:  </label>
    <input name="LastName" type="text" size="15" maxlength="15">
	</p>
	<p>
	<label>Имя:  </label>
    <input name="FirstName" type="text" size="15" maxlength="15">
    </p>
	<p>
	<label>Отчество:  </label>
    <input name="MiddleName" type="text" size="15" maxlength="15">
    </p>
	<p>
	<label>Дата рождения:  </label>
    <input name="DateOfBirth" type="date" ">
    </p>
	<p>
	<label>e-mail:  </label>
    <input name="e-mail" type="text" ">
    </p>
	<input name="img" type="file" value="">
	<br>
	<input  type="submit" name="submit" value="Изменить">
	</div>    	
	<script src="../Scripts/jquery-3.3.1.min.js"></script>
	<script src="../Scripts/profile.js"></script>
    </body>
    </html>';	
}
else
{
	echo '<html>
    <head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Профиль</title>
	<link rel="stylesheet" type="text/css" href="profile.css">
    </head>
    <body>
	<span>Доступ запрещён. Для доступа войдите в аккаунт</span>
	<a href="/index.php">Главная страница</a> 
	</body>
    </html>';
}
?>