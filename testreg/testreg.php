<?php

header('Refresh: 0; url=/main.php');
echo '<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>';
    session_start();//  вся процедура работает на сессиях. Именно в ней хранятся данные  пользователя, пока он находится на сайте. Очень важно запустить их в  самом начале странички!!!
if (isset($_POST['login'])) { $login = $_POST['login']; if ($login == '') { unset($login);} } //заносим введенный пользователем логин в переменную $login, если он пустой, то уничтожаем переменную
    if (isset($_POST['password'])) { $password=$_POST['password']; if ($password =='') { unset($password);} }
    //заносим введенный пользователем пароль в переменную $password, если он пустой, то уничтожаем переменную
if (empty($login) or empty($password)) //если пользователь не ввел логин или пароль, то выдаем ошибку и останавливаем скрипт
    {
    exit ("Вы ввели не всю информацию, вернитесь назад и заполните все поля!");
    }
    //если логин и пароль введены,то обрабатываем их, чтобы теги и скрипты не работали, мало ли что люди могут ввести
    $login = stripslashes($login);
    $login = htmlspecialchars($login);
$password = stripslashes($password);
    $password = htmlspecialchars($password);
//удаляем лишние пробелы
    $login = trim($login);
    $password = trim($password);	

			$password    = md5($password);//шифруем пароль
            $password    = strrev($password);// для надежности добавим реверс
            $password    = $password."b3p6f";	
          	
// подключаемся к базе
    include_once("../bd/bd.php");// файл bd.php должен быть в той же папке, что и все остальные, если это не так, то просто измените путь 
 
$result = mysql_query("SELECT * FROM users WHERE login='$login'",$db); //извлекаем из базы все данные о пользователе с введенным логином
    $myrow = mysql_fetch_array($result);
    if (empty($myrow['password']))
    {
    //если пользователя с введенным логином не существует
    exit ("Извините, введённый вами login или пароль неверный.");
    }
    else {
    //если существует, то сверяем пароли
    if ($myrow['password']==$password) {
    //если пароли совпадают, то запускаем пользователю сессию! Можете его поздравить, он вошел!
    $_SESSION['login']=$myrow['login']; 
    $_SESSION['id']=$myrow['id'];//эти данные очень часто используются, вот их и будет "носить с собой" вошедший пользователь
	$_SESSION['rights']=$myrow['rights'];	
	
	//автовход
	//Если    пользователь хочет, чтобы его данные сохранились для последующего входа, то    сохраняем в куках его браузера
		 setcookie("auto", "yes",    time()+9999999);    
          setcookie("login",    $login, time()+9999999);
          setcookie("password",    $password, time()+9999999);
          setcookie("id", $myrow['id'],    time()+9999999);
            //Если    пользователь хочет входить на сайт автоматически
                   
	
    echo "Вы успешно вошли на сайт!" ;
	
    }
 else {
    //если пароли не сошлись

    exit ("Извините, введённый вами login или пароль неверный.");
    }
    }
    ?>