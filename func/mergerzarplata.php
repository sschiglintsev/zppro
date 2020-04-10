<?php
session_start();
mb_internal_encoding("UTF-8");
require_once "../db_workers.php";

$pole2 = $_POST['pole2'];
$pole3 = $_POST['pole3'];
x1:
$obj = $con->query("SELECT * FROM workers");
while ($rowww = $obj->fetch_assoc()) {

    $zp = $con->query("SELECT * FROM zarplata WHERE year='$pole2' AND month='$pole3' AND id_worker={$rowww['id']} AND id_object={$rowww['object']}");
    while ($row = $zp->fetch_assoc()) {

        $zpp = $con->query("SELECT * FROM zarplata WHERE year = '$pole2' AND month = '$pole3' AND id_object<>{$rowww['object']} AND id_worker={$rowww['id']}");
        while ($roww = $zpp->fetch_assoc()) {

            if ($row['id_worker'] == $roww['id_worker']) {
                //$salary_in_day = $row['salary_in_day'] + $roww['salary_in_day'];
                //$salary_in_hour = $row['salary_in_hour'] + $roww['salary_in_hour'];
                $fine = $row['fine'] + $roww['fine'];
                $avans = $row['avans'] + $roww['avans'];
                $hour_all = $row['hour_all'] + $roww['hour_all'];
                $sum = $row['sum'] + $roww['sum'];
                $ostatok_early = $row['ostatok_early'] + $roww['ostatok_early'];
                $payment = $row['payment'] + $roww['payment'];
                $money=  $row['money'] + $roww['money'];
                $ostatok = $row['ostatok'] + $roww['ostatok'];
                echo $row['id'],$rowww['object'];
                echo $roww['id'],$roww['id_object'];
                $con->query("UPDATE zarplata SET fine='$fine',
            avans='$avans', hour_all='$hour_all', sum='$sum', ostatok_early='$ostatok_early', payment='$payment',money='$money', ostatok='$ostatok' 
            WHERE id_worker={$row['id_worker']} AND id_object={$rowww['object']} AND year = '$pole2' AND month = '$pole3'");
                $con->query("DELETE FROM zarplata WHERE id={$roww['id']}");
                goto x1;

            }

        }

    }
}
