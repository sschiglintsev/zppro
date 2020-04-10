<?php
//define('DB_DSN', 'mysql:localhost;dbname=zpproru_tts;charset=UTF8');
//define('DB_USERNAME','zpproru_tts');

define('DB_USER', "zpproru_tts"); //логин админа БД
define('DB_PASSWORD', "Sockromant7"); // пароль админа БД
define('DB_DATABASE', "zpproru_tts"); // база данных
define('DB_SERVER', "localhost"); // сервер 'localhost'
$con = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
$con->set_charset('utf8');
?>

