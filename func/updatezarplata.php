<?php
session_start();
mb_internal_encoding("UTF-8");
require_once "../db_workers.php";

$pole1 = $_POST['pole1'];
$pole2 = $_POST['pole2'];
$pole3 = $_POST['pole3'];

$zarplata_update = $con->query("SELECT * FROM zarplata WHERE id_object = '$pole1' AND year = '$pole2' AND month = '$pole3'");
while($row = $zarplata_update->fetch_assoc()) {
    $fine_all = 0;
    $hour_all = 0;
    $sum = 0;
    $payment = 0;
    $ostatok = 0;
    $avans_all = 0;
    $ostatok_early = $row['ostatok_early'];


    $tabels = $con->query("SELECT * FROM tabel WHERE id_worker=" . $row['id_worker'] . " AND id_object = '$pole1' AND year = '$pole2' AND month = '$pole3'");
        while ($roww = $tabels->fetch_assoc()) {
            $hour_all = $roww['hour'] + $hour_all;
            $fine_all = $roww['fine'] + $fine_all;
        }


        $avans = $con->query("SELECT sum,date FROM avans WHERE id_worker=" . $row['id_worker'] . " AND id_object = '$pole1'");
        while ($rowww = $avans->fetch_assoc()) {
            if (strpos($rowww['date'], "$pole2-$pole3") !== false) {
                $avans_all = $rowww['sum'] + $avans_all;
            } else {
                //$avans_all = 0;
            }
        }
        $sum = $row['salary_in_hour'] * $hour_all;
        $pole4 = $pole3 - 1;

        $zp_ostatok = $con->query("SELECT ostatok FROM zarplata WHERE id_worker=" . $row['id_worker'] . " AND id_object = '$pole1' AND year = '$pole2' AND month = '$pole4' ");
        while ($rowwww = $zp_ostatok->fetch_assoc()) {
            $ostatok_early = $rowwww['ostatok'];
        }

        $payment = $sum + $ostatok_early - $fine_all - $avans_all;
        $ostatok = $payment-$row['money'];
        $con->query("UPDATE zarplata SET fine='$fine_all', avans='$avans_all' ,hour_all='$hour_all', sum='$sum', ostatok_early='$ostatok_early', payment='$payment',
        ostatok='$ostatok' WHERE id_worker=" . $row['id_worker'] . " AND id_object='$pole1' AND year='$pole2' AND month='$pole3' ");
        $fine_all = 0;
        $hour_all = 0;
        $sum = 0;
        $payment = 0;
        $ostatok = 0;
        $avans_all = 0;
        $ostatok_early = 0;

    }
    echo 'Готово!';