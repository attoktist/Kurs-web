<?php
session_start();

$email = $_SESSION['fmail'];;

echo '<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Восстановление пароля</title>	
	<link rel="stylesheet" type="text/css" href="../css/review.css">
    </head>
    <body>		
	<p>
	<form action="script.php" method="post">
    <label>Введите новый пароль:  </label>
    <input name="pass" type="text" size="15" maxlength="15">
	</p>	
	<input  type="submit" name="submit" value="Далее">
	</form>   	
    </body>
    </html>'
	
	?>