<?php
    $db = mysql_connect ("localhost","root","");
    $db_selected = mysql_select_db("Kurs",$db);
	if (!$db_selected) {
    die ('Не удалось выбрать базу Kurs: ' . mysql_error());
}
    ?>