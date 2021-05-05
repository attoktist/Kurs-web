<html>
    <head>
    <title>Регистрация</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" type="text/css" href="../css/reg.css">
    </head>
    <body>
    <h2>Регистрация</h2>
	<div id="background"><img src="../images/Background.jpg" alt="background" id="batman"></div>

    <form action="/save_user/save_user.php" method="post">
    <!--**** save_user.php - это адрес обработчика.  То есть, после нажатия на кнопку "Зарегистрироваться", данные из полей  отправятся на страничку save_user.php методом "post" ***** -->
	<div id="reg">
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
		<input type="submit" name="submit" value="Зарегистрироваться">
<!--**** Кнопочка (type="submit") отправляет данные на страничку save_user.php ***** --> 
		</p>
	</div>
</form>
    </body>
    </html>