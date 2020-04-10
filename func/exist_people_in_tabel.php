<?php
session_start();
mb_internal_encoding("UTF-8");
require_once "../db_workers.php";

$pole1 = $_POST['pole1'];
$pole2 = $_POST['pole2'];
$pole3 = $_POST['pole3'];
$pole4 = $_POST['pole4'];
$pole5 = $_POST['pole5'];

$res = $con->query("SELECT COUNT(*) AS  countest FROM tabel WHERE id_object = '$pole5' AND year = '$pole2' AND month = '$pole3' AND id_worker = '$pole4'")->fetch_assoc();

    if ($res['countest']>0) {
        echo 'Сотрудник был добавлен ранее!';
    }
    else {
        $ress = $con->query("SELECT COUNT(*) AS  count FROM workers WHERE id = '$pole4'")->fetch_assoc();
        if ($ress['count']>0) {
            $number = cal_days_in_month(CAL_GREGORIAN, $pole3, $pole2);
            $i = 0;
            for ($i = 1; $i <= $number; $i++) {
                $date = date('l', strtotime("$pole2-$pole3-$i"));
                $con->query("INSERT INTO tabel SET id_worker='$pole4' ,id_object='$pole5', year='$pole2',month='$pole3', day=$i, hour='', fine='', day_in_week='$date'");
            }
            echo 'Сотрудник успешно добавлен';
        }
        else {
            echo 'Сотрудник работает на другом объекте';
        }
        }



