<?php
session_start();

mb_internal_encoding("UTF-8");
require_once "../db_workers.php";
$pole1 = $_POST['pole1'];
$pole2 = $_POST['pole2'];
$pole3 = $_POST['pole3'];


$res = $con->query("SELECT COUNT(*) AS  countest FROM objects WHERE name = '$pole1'  AND short_name = '$pole2' AND address = '$pole3'")->fetch_assoc();

if ($res['countest']>0) {
    echo 'Объект уже существует !';
}
else {
    echo 'Объект успешно добавлен !';
    $con->query("INSERT INTO objects SET name='$pole1',short_name='$pole2',address='$pole3'");
}