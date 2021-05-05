<?php
          session_start();
          
unset($_SESSION['password']);
            unset($_SESSION['login']); 
            unset($_SESSION['id']);//    уничтожаем переменные в сессиях
			setcookie("auto", "",    time()+9999999);//очищаем автоматический вход
        exit("<html><head><meta    http-equiv='Refresh' content='0;    URL=index.php'></head></html>");
            // отправляем пользователя на главную страницу.
            ?>