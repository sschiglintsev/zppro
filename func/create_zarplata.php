<?php
session_start();
mb_internal_encoding("UTF-8");
require_once "../db_workers.php";

$pole1 = $_POST['pole1'];
$pole2 = $_POST['pole2'];
$pole3 = $_POST['pole3'];

$res = $con->query("SELECT COUNT(*) AS  countest FROM zarplata WHERE id_object = '$pole1' AND year = '$pole2' AND month = '$pole3'")->fetch_assoc();

if ($res['countest']>0) {
    echo 'По заданным параметрам зарплата была расчитана ранее';
}
else {
    //Для 1-го объекта
    $fine_all=0;
    $hour_all=0;
    $sum=0;
    $payment=0;
    $ostatok=0;
    $avans_all=0;
    $ostatok_early=0;

    $workers = $con->query("SELECT * FROM workers WHERE object = '$pole1' ORDER BY id DESC ");
    while($row = $workers->fetch_assoc()) {

        $tabels = $con->query("SELECT * FROM tabel WHERE id_worker=".$row['id']." AND id_object = '$pole1' AND year = '$pole2' AND month = '$pole3'");
        while($roww = $tabels->fetch_assoc()) {
            $hour_all=$roww['hour']+$hour_all;
            $fine_all=$roww['fine']+$fine_all;
        }

        $avans = $con->query("SELECT sum,date FROM avans WHERE id_worker=".$row['id']." AND id_object = '$pole1'");
        while($rowww = $avans->fetch_assoc()) {
            if (strpos($rowww['date'], "$pole2-$pole3")!== false){
                $avans_all=$rowww['sum']+$avans_all;
            }
            else {
                $avans_all=0;
            }
        }

        $sum=$row['salary_in_hour']*$hour_all;

        $pole22=$pole2;
        $pole4=$pole3-1;
        if ($pole4==0){
            $pole4=12;
            $pole22=$pole2-1;
        }

        $zp_ostatok = $con->query("SELECT ostatok FROM zarplata WHERE id_worker=".$row['id']." AND id_object = '$pole1' AND year = '$pole22' AND month = '$pole4' ");
        while($rowwww = $zp_ostatok->fetch_assoc()) {
            $ostatok_early=$rowwww['ostatok'];
        }


        $payment=$sum+$ostatok_early-$fine_all-$avans_all;
        $ostatok=$payment;
        $con->query("INSERT INTO zarplata SET id_worker=".$row['id']." ,id_object='$pole1', year='$pole2',month='$pole3', salary_in_day=".$row['salary_in_day'].",
                    salary_in_hour=".$row['salary_in_hour'].", fine='$fine_all', avans='$avans_all' ,hour_all='$hour_all', sum='$sum', ostatok_early='$ostatok_early',
                    payment='$payment', money='', ostatok='$ostatok' ");
        $fine_all=0;
        $hour_all=0;
        $sum=0;
        $payment=0;
        $ostatok=0;
        $avans_all=0;
        $ostatok_early=0;

    }

    //Для 2-го объекта
    $fine_all=0;
    $hour_all=0;
    $sum=0;
    $payment=0;
    $ostatok=0;
    $avans_all=0;
    $ostatok_early=0;

    $workers = $con->query("SELECT * FROM workers WHERE object_2 = '$pole1' ORDER BY id DESC ");
    while($row = $workers->fetch_assoc()) {

        $tabels = $con->query("SELECT * FROM tabel WHERE id_worker=" . $row['id'] . " AND id_object = '$pole1' AND year = '$pole2' AND month = '$pole3'");
        while ($roww = $tabels->fetch_assoc()) {
            $hour_all = $roww['hour'] + $hour_all;
            $fine_all = $roww['fine'] + $fine_all;
        }


        $avans = $con->query("SELECT sum,date FROM avans WHERE id_worker=" . $row['id'] . " AND id_object = '$pole1'");
        while ($rowww = $avans->fetch_assoc()) {
            if (strpos($rowww['date'], "$pole2-$pole3") !== false) {
                $avans_all = $rowww['sum'] + $avans_all;
            } else {
                $avans_all = 0;
            }
        }

        $sum = $row['salary_in_hour'] * $hour_all;

        $pole22=$pole2;
        $pole4=$pole3-1;
        if ($pole4==0){
            $pole4=12;
            $pole22=$pole2-1;
        }

        $zp_ostatok = $con->query("SELECT ostatok FROM zarplata WHERE id_worker=" . $row['id'] . " AND id_object = '$pole1' AND year = '$pole22' AND month = '$pole4' ");
        while ($rowwww = $zp_ostatok->fetch_assoc()) {
            $ostatok_early = $rowwww['ostatok'];
        }


        $payment = $sum + $ostatok_early - $fine_all - $avans_all;
        $ostatok = $payment;
        $con->query("INSERT INTO zarplata SET id_worker=" . $row['id'] . " ,id_object='$pole1', year='$pole2',month='$pole3', salary_in_day=" . $row['salary_in_day'] . ",
                    salary_in_hour=" . $row['salary_in_hour'] . ", fine='$fine_all', avans='$avans_all' ,hour_all='$hour_all', sum='$sum', ostatok_early='$ostatok_early',
                    payment='$payment', money='', ostatok='$ostatok' ");
        $fine_all = 0;
        $hour_all = 0;
        $sum = 0;
        $payment = 0;
        $ostatok = 0;
        $avans_all = 0;
        $ostatok_early = 0;
    }


        //Для 3-го объекта
            $fine_all=0;
            $hour_all=0;
            $sum=0;
            $payment=0;
            $ostatok=0;
            $avans_all=0;
            $ostatok_early=0;

            $workers = $con->query("SELECT * FROM workers WHERE object_3 = '$pole1' ORDER BY id DESC ");
            while($row = $workers->fetch_assoc()) {

                $tabels = $con->query("SELECT * FROM tabel WHERE id_worker=".$row['id']." AND id_object = '$pole1' AND year = '$pole2' AND month = '$pole3'");
                while($roww = $tabels->fetch_assoc()) {
                    $hour_all=$roww['hour']+$hour_all;
                    $fine_all=$roww['fine']+$fine_all;
                }


                $avans = $con->query("SELECT sum,date FROM avans WHERE id_worker=".$row['id']." AND id_object = '$pole1'");
                while($rowww = $avans->fetch_assoc()) {
                    if (strpos($rowww['date'], "$pole2-$pole3")!== false){
                        $avans_all=$rowww['sum']+$avans_all;
                    }
                    else {
                        $avans_all=0;
                    }
                }

                $sum=$row['salary_in_hour']*$hour_all;

                $pole22=$pole2;
                $pole4=$pole3-1;
                if ($pole4==0){
                    $pole4=12;
                    $pole22=$pole2-1;
                }

                $zp_ostatok = $con->query("SELECT ostatok FROM zarplata WHERE id_worker=".$row['id']." AND id_object = '$pole1' AND year = '$pole22' AND month = '$pole4' ");
                while($rowwww = $zp_ostatok->fetch_assoc()) {
                    $ostatok_early=$rowwww['ostatok'];
                }


                $payment=$sum+$ostatok_early-$fine_all-$avans_all;
                $ostatok=$payment;
                $con->query("INSERT INTO zarplata SET id_worker=".$row['id']." ,id_object='$pole1', year='$pole2',month='$pole3', salary_in_day=".$row['salary_in_day'].",
                    salary_in_hour=".$row['salary_in_hour'].", fine='$fine_all', avans='$avans_all' ,hour_all='$hour_all', sum='$sum', ostatok_early='$ostatok_early',
                    payment='$payment', money='', ostatok='$ostatok' ");
                $fine_all=0;
                $hour_all=0;
                $sum=0;
                $payment=0;
                $ostatok=0;
                $avans_all=0;
                $ostatok_early=0;



    }



    //Для 4-го объекта
    $fine_all=0;
    $hour_all=0;
    $sum=0;
    $payment=0;
    $ostatok=0;
    $avans_all=0;
    $ostatok_early=0;

    $workers = $con->query("SELECT * FROM workers WHERE object_4 = '$pole1' ORDER BY id DESC ");
    while($row = $workers->fetch_assoc()) {

        $tabels = $con->query("SELECT * FROM tabel WHERE id_worker=".$row['id']." AND id_object = '$pole1' AND year = '$pole2' AND month = '$pole3'");
        while($roww = $tabels->fetch_assoc()) {
            $hour_all=$roww['hour']+$hour_all;
            $fine_all=$roww['fine']+$fine_all;
        }


        $avans = $con->query("SELECT sum,date FROM avans WHERE id_worker=".$row['id']." AND id_object = '$pole1'");
        while($rowww = $avans->fetch_assoc()) {
            if (strpos($rowww['date'], "$pole2-$pole3")!== false){
                $avans_all=$rowww['sum']+$avans_all;
            }
            else {
                $avans_all=0;
            }
        }

        $sum=$row['salary_in_hour']*$hour_all;

        $pole22=$pole2;
        $pole4=$pole3-1;
        if ($pole4==0){
            $pole4=12;
            $pole22=$pole2-1;
        }

        $zp_ostatok = $con->query("SELECT ostatok FROM zarplata WHERE id_worker=".$row['id']." AND id_object = '$pole1' AND year = '$pole22' AND month = '$pole4' ");
        while($rowwww = $zp_ostatok->fetch_assoc()) {
            $ostatok_early=$rowwww['ostatok'];
        }


        $payment=$sum+$ostatok_early-$fine_all-$avans_all;
        $ostatok=$payment;
        $con->query("INSERT INTO zarplata SET id_worker=".$row['id']." ,id_object='$pole1', year='$pole2',month='$pole3', salary_in_day=".$row['salary_in_day'].",
                    salary_in_hour=".$row['salary_in_hour'].", fine='$fine_all', avans='$avans_all' ,hour_all='$hour_all', sum='$sum', ostatok_early='$ostatok_early',
                    payment='$payment', money='', ostatok='$ostatok' ");
        $fine_all=0;
        $hour_all=0;
        $sum=0;
        $payment=0;
        $ostatok=0;
        $avans_all=0;
        $ostatok_early=0;



    }


    echo 'Расчет ЗП создан';
}