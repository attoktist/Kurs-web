<?php
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

session_start();

if (!empty($_COOKIE['fm']))
            {//если есть    необходимые переменные
                     $_SESSION['fmail'] = $_COOKIE['fm'];
			}

$log = generateRandomString();
if(isset($_POST['email']))
{
	$_SESSION['fmail'] = $_POST['email'];
	setcookie("fm",    $_POST['email'], time()+9999999);
$subject    = "Восстановление пароля";//тема сообщения
$message    = "Перейдите    по ссылке, чтобы изменить пароль:\nhttp://kurs/forgotPassword/recovery.php?login=".$log."\n";//содержание сообщение
            mail($_POST['email'],    $subject, $message, "Content-type:text/plane;    Charset=windows-1251\r\n");//отправляем сообщение
                     
            echo    "Вам на E-mail выслано письмо с cсылкой, для восстановления пароля. <a href='index.php'>Главная    страница</a>"; //говорим о    отправленном письме пользователю
}
echo '<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Восстановление пароля</title>	
	<link rel="stylesheet" type="text/css" href="../css/review.css">
    </head>
    <body>		
	<p>
	<form action="" method="post">
    <label>Введите e-mail адрес:  </label>
    <input name="email" type="text" size="20" maxlength="255">
	</p>	
	<input  type="submit" name="submit" value="Восстановить пароль">
	</form>   	
    </body>
    </html>';
	//echo $_POST['email'];
	?>