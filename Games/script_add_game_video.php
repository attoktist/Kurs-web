<?php
session_start();
include_once('../bd/bd.php');
$id_game = $_POST["id_game"];
$nv = $_POST["Name_video"];

$resultGame = mysql_query("SELECT * FROM Games WHERE id_game='$id_game'",$db); 
$myrowGame = mysql_fetch_array($resultGame);

if    ((!empty($_FILES['Name_video'])) || (!empty($_FILES['video']))) //проверяем, отправил ли пользователь видео
            {
            $video=$_FILES['video'];
			$Name_video=$_FILES['Name_video'];
              if ($video =='' or empty($video)) 
			  {
                  unset($video);// если переменная $picture пуста, то удаляем ее
			  }
			}	
			//загружаем видео пользователя
			$path = ''.$myrowGame['Name'].'/video/';//папка, куда будет загружаться видео        
         
			if(preg_match('/[.](MP4)|(mp4)|(avi)|(AVI)|(wmv)|(Wmv)$/',$_FILES['video']['name']))//проверка формата исходного видео
            {                 
                $filename =    $_FILES['video']['name'];
                $source =    $_FILES['video']['tmp_name']; 							   
                $target =    $path . $filename;							   
                move_uploaded_file($source,$target);//загрузка оригинала в папку $path   
				$vd    = $path.$filename;				
            }
            else 
            {
                //в случае    несоответствия формата, выдаем соответствующее сообщение
                exit ("Видео должно быть в    формате <strong>MP$,AVI или WMV</strong>");
            }
            //конец процесса загрузки и присвоения переменной $avatar адреса    загруженной авы
			
		$insert_comment = mysql_query("INSERT INTO `game_video` (`id_game`, `path`, `Name_video`) VALUES ('$id_game', '$vd', '$nv')",$db);
		echo 	'<html>
				<head>
				<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
				<title>Видео загружено</title>
				<link rel="stylesheet" type="text/css" href="../css/game_video.css">	
				<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
				<script src="../Scripts/game_video.js"></script>	
				</head>
				<body>';
		echo 	'<a href="game.php?id_game='.$id_game.'">Вернуться на страницу с игрой</a></br>';
		echo 	'</body>
				</html>';
?>