<?php
session_start();
include_once('../bd/bd.php');
$id_game = $_POST['id_game'];
$Name = $_POST['Name'];
$Genre = $_POST['Genre'];
$Year = $_POST['Year'];
$Developer = $_POST['Developer'];
$Description = $_POST['Description'];
$points = $_POST['points'];
$votes = $_POST['votes'];
$old_path = $_POST['path'];

echo '<html>
    <head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Панель админа</title>
	<link rel="stylesheet" type="text/css" href="../css/game.css">	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="../Scripts/game.js"></script>	
    </head>
    <body>';	


$delfull    = '../Games/'.$old_path; 
unlink    ($delfull);//удаляем изображение

if    ((!empty($_FILES['Image'])) || (!empty($_FILES['Image']))) //проверяем, отправил ли пользователь изображения
            {
            $image = $_FILES['Image'];			
              if ($image =='' or empty($image)) 
			  {
                  unset($image);// если переменная пуста, то удаляем ее
			  }
			}	
			//загружаем изображение
			$path = '../Games/'.$Name.'/';//папка, куда будет загружаться изображения        
			
			if(preg_match('/[.](JPG)|(jpg)|(png)|(PNG)$/',$_FILES['Image']['name']))//проверка формата исходного изображения
            {                 
                $filename =  $_FILES['Image']['name'];				
                $source =    $_FILES['Image']['tmp_name']; 							   
                $target =    $path . $filename;							   
                move_uploaded_file($source,$target);//загрузка оригинала в папку $path   
				$imd   = $Name.'/'.$filename;					
            }
            else 
            {
                //в случае    несоответствия формата, выдаем соответствующее сообщение
                exit ('изображения должно быть в    формате <strong>JPG или PNG</strong>');
            }

mysql_query("UPDATE games SET Name = '$Name',  Genre = '$Genre',Year = '$Year', 
Developer = '$Developer', Description = '$Description',Image = '$imd',  
points = '$points',votes = '$votes' WHERE id_game ='$id_game'",$db) or die(mysql_error()); 



?>