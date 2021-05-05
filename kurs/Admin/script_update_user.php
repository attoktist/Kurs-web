<?php
session_start();
include_once('../bd/bd.php');		
$id_user = $_POST['id_user'];	

			
$result = mysql_query("SELECT * FROM users WHERE id='$id_user'",$db); //извлекаем из базы все данные о пользователе с введенным логином
$myrow = mysql_fetch_array($result);
$login = $myrow['login'];	
	if    (!empty($_FILES['img'])) //проверяем, отправил    ли пользователь изображение
            {
            $picture=$_FILES['img'];   // $picture = trim($picture); 
              if ($picture =='' or empty($picture)) 
			  {
                                 unset($picture);// если переменная $picture пуста, то удаляем ее
			  }
			}
			
			if    (!isset($picture) or empty($picture) or $picture =='')
            {
            //если переменной не существует (пользователь не отправил    изображение),то присваиваем ему заранее приготовленную картинку с надписью    "нет аватара"
            $avatar    = "../users/no_image.jpg";
            }          
else 
            {

				//иначе - загружаем изображение пользователя
				$path   = '../users/'.$myrow['login'].'/';//папка,    куда будет загружаться начальная картинка и ее сжатая копия          
         
				if(preg_match('/[.](JPG)|(jpg)|(gif)|(GIF)|(png)|(PNG)$/',$_FILES['img']['name']))//проверка формата исходного изображения
                      {                 
                               $filename =    $_FILES['img']['name'];
                               $source =    $_FILES['img']['tmp_name']; 
                               $target =    $path. $filename;
                               move_uploaded_file($source,    $target);//загрузка оригинала в папку $path          
				if(preg_match('/[.](GIF)|(gif)$/',    $filename)) {
                     $im    = imagecreatefromgif($path.$filename) ; //если оригинал был в формате gif, то создаем    изображение в этом же формате. Необходимо для последующего сжатия
                     }
                     if(preg_match('/[.](PNG)|(png)$/',    $filename)) {
                     $im =    imagecreatefrompng($path.$filename) ;//если    оригинал был в формате png, то создаем изображение в этом же формате.    Необходимо для последующего сжатия
                     }
                     
                     if(preg_match('/[.](JPG)|(jpg)|(jpeg)|(JPEG)$/',    $filename)) {
                               $im =    imagecreatefromjpeg($path.$filename); //если оригинал был в формате jpg, то создаем изображение в этом же    формате. Необходимо для последующего сжатия
                     }           
				//СОЗДАНИЕ КВАДРАТНОГО ИЗОБРАЖЕНИЯ И ЕГО ПОСЛЕДУЮЩЕЕ СЖАТИЕ          
				// Создание квадрата 90x90
				// dest - результирующее изображение 
				// w - ширина изображения 
				// ratio - коэффициент пропорциональности           
				$w    = 200;  //    квадратная 200x200. Можно поставить и другой размер.          
				// создаём исходное изображение на основе 
				// исходного файла и определяем его размеры 
				$w_src    = imagesx($im); //вычисляем ширину
				$h_src    = imagesy($im); //вычисляем высоту изображения
                // создаём    пустую квадратную картинку 
               // важно именно    truecolor!, иначе будем иметь 8-битный результат 
               $dest = imagecreatetruecolor($w,$w);           
         //    вырезаем квадратную серединку по x, если фото горизонтальное 
                if    ($w_src>$h_src) 
                imagecopyresampled($dest, $im, 0, 0,
                round((max($w_src,$h_src)-min($w_src,$h_src))/2),
                0, $w, $w,    min($w_src,$h_src), min($w_src,$h_src));           
         // 		вырезаем    квадратную верхушку по y, 
                     // если фото    вертикальное (хотя можно тоже серединку) 
                if    ($w_src<$h_src) 
                imagecopyresampled($dest, $im, 0, 0,    0, 0, $w, $w,
                min($w_src,$h_src),    min($w_src,$h_src));           
         // 	квадратная картинка    масштабируется без вырезок 
                if ($w_src==$h_src) 
                imagecopyresampled($dest,    $im, 0, 0, 0, 0, $w, $w, $w_src, $w_src);           
				//$myrow['login']=time();    //вычисляем время в настоящий момент.
				imagejpeg($dest,    $path.$myrow['login'].".jpg");//сохраняем    изображение формата jpg в нужную папку, именем будет текущее время. Сделано,    чтобы у аватаров не было одинаковых имен.          
				//почему именно jpg? Он занимает очень мало места + уничтожается    анимирование gif изображения, которое отвлекает пользователя. Не очень    приятно читать его комментарий, когда краем глаза замечаешь какое-то    движение.          
				$avatar    = $path.$myrow['login'].'.jpg';//заносим в переменную путь до аватара. 

				$delfull    = $path.$filename; 
				unlink    ($delfull);//удаляем оригинал загруженного    изображения, он нам больше не нужен. Задачей было - получить миниатюру.
            }
            else 
            {
                //в случае    несоответствия формата, выдаем соответствующее сообщение
                exit ("Аватар должен быть в    формате <strong>JPG,GIF или PNG</strong>");
                             }
            //конец процесса загрузки и присвоения переменной $avatar адреса    загруженной авы
            }
	
$password = $_POST['password'];
$password    = md5($password);//шифруем пароль
$password    = strrev($password);// для надежности добавим реверс
$password   = $password."b3p6f";
$rights = $_POST['rights'];
$LastName = $_POST['LastName'];
$FirstName = $_POST['FirstName'];
$MiddleName = $_POST['MiddleName'];
$DateOfBirth = $_POST['DateOfBirth'];
$e_mail = $_POST['e-mail'];
//$picture = $_POST['picture'];

//if(isset($LastName, $FirstName, $MiddleName, $DateOfBirth))
//{	
mysql_query("UPDATE  `users` SET  `password` = '$password', `rights` = '$rights', `FirstName` =  '$FirstName',`MiddleName` =  '$MiddleName',`LastName` =  '$LastName',`DateOfBirth` =  '$DateOfBirth', `e-mail` ='$e_mail', `avatar` =  '$avatar' WHERE  `id` ='$id_user'",$db) or die(mysql_error());
//}

	
?>