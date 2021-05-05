<?php
    //  вся процедура работает на сессиях. Именно в ней хранятся данные  пользователя, пока он находится на сайте. Очень важно запустить их в  самом начале странички!!!
    session_start();
	
	$pass    = md5($password);//шифруем пароль          
	$pass    = strrev($pass);// для надежности добавим реверс          
	$pass    = $pass."b3p6f";
	 if (isset($_COOKIE['auto']) and    isset($_COOKIE['login']) and isset($_COOKIE['password']))
            {//если есть    необходимые переменные
                     if ($_COOKIE['auto'] == 'yes') { // если    пользователь желает входить автоматически, то запускаем сессии
                                   $_SESSION['password']=$_COOKIE['password']; //в куках    пароль был не зашифрованный, а в сессиях обычно храним зашифрованный
                                $_SESSION['login']=$_COOKIE['login'];//сессия с логином 
                                $_SESSION['id']=$_COOKIE['id'];//идентификатор    пользователя
					 }
			}
		else
		{
			
	$login =  $_SESSION['login'];
if(!empty($login))
{	
echo '<meta http-equiv="refresh" content="1; URL=main.php" />';
	
}
else
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
	
	</div>
	<button id="enter_i">Войти</button>
<div class="okno">
    <form action="testreg\testreg.php" method="post">
    <!--****  testreg.php - это адрес обработчика. То есть, после нажатия на кнопку  "Войти", данные из полей отправятся на страничку testreg.php методом  "post" ***** -->
 <p>
	<input id="exit" type="button" name="exit" value="Закрыть">
	<p>
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
<a href="reg\reg.php">Зарегистрироваться</a> <br>
<a href="forgotPassword/forgotPassword.php">Забыли пароль?</a>    
</div>
 
	<script src="Scripts/jquery-3.3.1.min.js"></script>
	<script src="Scripts/index.js"></script>
    </body>
    </html>');
}
		}
	?>