<?php
session_start();

if (isset($_SESSION['userid'])){
    header( 'Location: work_place.php', true, 303 );}
?>

<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
    <title>Расчет зарплаты</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
    <link href="https://fonts.googleapis.com/css?family=Russo+One&amp;subset=cyrillic,latin-ext" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,700&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
    <script type="text/javascript" src="js/jquery-3.2.1.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
    
</head>
<body>
  <div class="login">
	<h1>TTC</h1>
      <span id="message" style="color: red"></span>
        <input type="text" name="auth" hidden />
    	<input id="name" type="text" name="user_name" placeholder="Пользователь" required />
      <p></p>
        <input id="pass" type="password" name="password_name" placeholder="Пароль" required />
      <p></p>
        <a class="btn btn-default" onclick="login()">Войти</a>
    </div>
</body>
</html>
