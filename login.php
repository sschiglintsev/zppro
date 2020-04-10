<?php // login.php
session_start();
require_once "db_workers.php";

if ($_POST['auth']) {
    $auth=$con->query("SELECT * FROM users WHERE `name`='".$_POST['name']."' AND `password`='".($_POST['pass'])."'")->fetch_assoc();
    if ($auth) {
        $_SESSION['userid'] = $auth['id'];
        $_SESSION['userlogin'] = $auth['name'];
        echo 'ok';
    }
    else {
        echo 'err';
    }
}

if ($_GET['logout']=='1') {
    unset($_SESSION['userid']);
    unset($_SESSION['userlogin']);
    session_destroy();
    header( 'Location: index.php', true, 303 );
}
