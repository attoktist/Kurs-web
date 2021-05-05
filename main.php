<?php
session_start();
$login = $_SESSION['login'];
$id = $_SESSION['id'];

if(!empty($login))
{
print('<html>
    <head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Главная страница</title>
	<link rel="stylesheet" type="text/css" href="css/index.css">
    </head>
    <body>
	<div id="background"><img src="images/Background.jpg" alt="background" id="batman"></div>
    <h2 id="head_str">Главная страница</h2>
	<div class="link">
	<a  href="/profile/profile.php">Профиль</a>
	<a  href="Games/games.php">Игры</a>
	<a  href="exit.php">Выход</a>  
	</div>
	<button id="enter">Войти под другим</br>пользователем</button>
	<label id="text">Вы вошли как '.$_SESSION['login'].' </label>
<div class="okno">
    <form action="testreg/testreg.php" method="post">
    <!--****  testreg.php - это адрес обработчика. То есть, после нажатия на кнопку  "Войти", данные из полей отправятся на страничку testreg.php методом  "post" ***** -->
 <p>
	<input id="exit" type="button" name="exit" value="Закрыть">
    <label>Ваш логин:<br></label>
    <input name="login" type="text" size="15" maxlength="15">
    </p>
    <!--**** В текстовое поле (name="login" type="text") пользователь вводит свой логин ***** --> 
    <p>
    <label>Ваш пароль:<br></label>
    <input name="password" type="password" size="15" maxlength="15">
    </p>
    <!--**** В поле для паролей (name="password" type="password") пользователь вводит свой пароль ***** --> 
    <p>
    <input type="submit" name="submit" value="Войти">
    <!--**** Кнопочка (type="submit") отправляет данные на страничку testreg.php ***** --> 
<br>

</div>
 
	<script src="Scripts/jquery-3.3.1.min.js"></script>
	<script src="Scripts/index.js"></script>
    </body>
    </html>');
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