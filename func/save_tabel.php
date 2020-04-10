<?php
session_start();
mb_internal_encoding("UTF-8");
require_once "../db_workers.php";
$valuedesc = json_decode($_POST['descval_t'], true, 512);
$num_string = '';
foreach ($valuedesc as $item) {
    $id = $item['t'];
    $value = $item['v'];
    $num = $item['n'];
    if (strpos($num, 'f') !== false) {
        $con->query("UPDATE tabel SET `hour`='{$value}' WHERE id='{$id}'");
        echo $value;
    } else {
        $con->query("UPDATE tabel SET fine='{$value}' WHERE id='{$id}'");
        echo $value;
    }
}


