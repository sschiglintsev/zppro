<?php
session_start();
mb_internal_encoding("UTF-8");
require_once "../db_workers.php";

$pole1 = $_POST['pole1'];
$pole2 = $_POST['pole2'];
$pole3 = $_POST['pole3'];

$res = $con->query("SELECT COUNT(*) AS  countest FROM tabel WHERE id_object = '$pole1' AND year = '$pole2' AND month = '$pole3'")->fetch_assoc();

if ($res['countest']>0) {
    echo 'По заданным параметрам табель уже создан!';
}
else {
    $number = cal_days_in_month(CAL_GREGORIAN, $pole3, $pole2);

    $workers = $con->query("SELECT * FROM workers WHERE object = '$pole1' ORDER BY id DESC ");
    $i=0;
    while($row = $workers->fetch_assoc()) {

        for ($i=1; $i<=$number; $i++)
        {
            $date = date('l', strtotime("$pole2-$pole3-$i"));
            $con->query("INSERT INTO tabel SET id_worker=".$row['id']." ,id_object='$pole1', year='$pole2',month='$pole3', day=$i, hour='', fine='', day_in_week='$date'");
        }
    }

    $workers = $con->query("SELECT * FROM workers WHERE object_2 = '$pole1' ORDER BY id DESC ");
    $i=0;
    while($row = $workers->fetch_assoc()) {

        for ($i=1; $i<=$number; $i++)
        {
            $date = date('l', strtotime("$pole2-$pole3-$i"));
            $con->query("INSERT INTO tabel SET id_worker=".$row['id']." ,id_object='$pole1', year='$pole2',month='$pole3', day=$i, hour='', fine='', day_in_week='$date'");
        }
    }

    $workers = $con->query("SELECT * FROM workers WHERE object_3 = '$pole1' ORDER BY id DESC ");
    $i=0;
    while($row = $workers->fetch_assoc()) {

        for ($i=1; $i<=$number; $i++)
        {
            $date = date('l', strtotime("$pole2-$pole3-$i"));
            $con->query("INSERT INTO tabel SET id_worker=".$row['id']." ,id_object='$pole1', year='$pole2',month='$pole3', day=$i, hour='', fine='', day_in_week='$date'");
        }
    }

    $workers = $con->query("SELECT * FROM workers WHERE object_4 = '$pole1' ORDER BY id DESC ");
    $i=0;
    while($row = $workers->fetch_assoc()) {

        for ($i=1; $i<=$number; $i++)
        {
            $date = date('l', strtotime("$pole2-$pole3-$i"));
            $con->query("INSERT INTO tabel SET id_worker=".$row['id']." ,id_object='$pole1', year='$pole2',month='$pole3', day=$i, hour='', fine='', day_in_week='$date'");
        }
    }
    echo 'Табель создан!';
}


