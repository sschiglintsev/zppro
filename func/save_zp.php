<?php
session_start();
mb_internal_encoding("UTF-8");
require_once "../db_workers.php";
$valuedesc =json_decode($_POST['descval_zp'], true, 512);
$num_string='';
foreach ($valuedesc as $item) {
    $id=$item['type'];
    $value=$item['value_zp'];
    $num=$item['num_zp'];

    if (strpos($num, 's_in_d')!== false) {
        $con->query("UPDATE zarplata SET salary_in_day=$value WHERE id=$id");
    }
    if (strpos($num, 's_in_h')!== false) {
        $con->query("UPDATE zarplata SET salary_in_hour=$value WHERE id=$id");
    }
    if (strpos($num, 'sum')!== false) {
        $con->query("UPDATE zarplata SET sum=$value WHERE id=$id");
    }
    if (strpos($num, 'ostatok_early')!== false) {
        $con->query("UPDATE zarplata SET ostatok_early=$value WHERE id=$id");
    }
    if (strpos($num, 'payment')!== false) {
        $con->query("UPDATE zarplata SET payment=$value WHERE id=$id");
    }
    if (strpos($num, 'money')!== false) {
        $con->query("UPDATE zarplata SET money=$value WHERE id=$id");
    }
    if (strpos($num, 'ostatok')!== false) {
        $con->query("UPDATE zarplata SET ostatok=$value WHERE id=$id");
    }
}
