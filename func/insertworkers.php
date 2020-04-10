<?php
session_start();

mb_internal_encoding("UTF-8");
require_once "../db_workers.php";
$pole1 = $_POST['pole1'];
$pole2 = $_POST['pole2'];
$pole3 = $_POST['pole3'];
$pole4 = $_POST['pole4'];
$pole5 = $_POST['pole5'];
$pole6 = $_POST['pole6'];
$pole6_2 = $_POST['pole6_2'];
$pole6_3 = $_POST['pole6_3'];
$pole6_4 = $_POST['pole6_4'];
$pole7 = $_POST['pole7'];
$pole8 = $_POST['pole8'];
$pole9 = $_POST['pole9'];

$res = $con->query("SELECT COUNT(*) AS  countest FROM workers WHERE surname = '$pole1' AND name = '$pole2' AND m_name = '$pole3'  AND object = '$pole6' AND object_2 = '$pole6_2' AND object_3 = '$pole6_3' AND object_4 = '$pole6_4'")->fetch_assoc();

if ($res['countest']>0) {
    echo 'Сотрудник уже существует !';
}
else {
    echo 'Сотрудник успешно добавлен !';
    $con->query("INSERT INTO workers SET surname='$pole1',name='$pole2',m_name='$pole3',post='$pole4',tel='$pole5',
                  object='$pole6',object_2='$pole6_2',object_3='$pole6_3',object_4='$pole6_4',salary_in_day='$pole7',salary_in_hour='$pole8',debt='$pole9'");
}


