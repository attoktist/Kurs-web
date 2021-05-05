<?php
session_start();
include_once('../bd/bd.php');
$id_game = $_POST["id_game"];
$sv = $_POST["Name_screenshot"];

$resultGame = mysql_query("SELECT * FROM Games WHERE id_game='$id_game'",$db); 
$myrowGame = mysql_fetch_array($resultGame);

if    ((!empty($_FILES['Name_screenshot'])) || (!empty($_FILES['screenshot']))) //проверяем, отправил ли пользователь изображения
            {
            $screenshot=$_FILES['screenshot'];
			$Name_screenshot=$_FILES['Name_screenshot'];
              if ($screenshot =='' or empty($screenshot)) 
			  {
                  unset($screenshot);// если переменная пуста, то удаляем ее
			  }
			}	
			//загружаем скриншот пользователя
			$path = ''.$myrowGame['Name'].'/screenshots/';//папка, куда будет загружаться изображения        
         
			if(preg_match('/[.](JPG)|(jpg)|(png)|(PNG)$/',$_FILES['screenshot']['name']))//проверка формата исходного изображения
            {                 
                $filename =    $_FILES['screenshot']['name'];
                $source =    $_FILES['screenshot']['tmp_name']; 							   
                $target =    $path . $filename;							   
                move_uploaded_file($source,$target);//загрузка оригинала в папку $path   
				$sd    = $path.$filename;				
            }
            else 
            {
                //в случае    несоответствия формата, выдаем соответствующее сообщение
                exit ("изображения должно быть в    формате <strong>JPG или PNG</strong>");
            }
            //конец процесса загрузки и присвоения переменной $avatar адреса    загруженной авы
			
		$insert_comment = mysql_query("INSERT INTO `game_screenshots` (`id_game`, `path`, `Name_screenshot`) VALUES ('$id_game', '$sd', '$sv')",$db);
		echo 	'<html>
				<head>
				<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
				<title>Изображение загружено</title>
				<link rel="stylesheet" type="text/css" href="../css/game_screenshot.css">	
				<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
				<script src="../Scripts/game_screenshot.js"></script>	
				</head>
				<body>';
		echo 	'<a href="game.php?id_game='.$id_game.'">Вернуться на страницу с игрой</a></br>';
		echo 	'</body>
				</html>';
?>