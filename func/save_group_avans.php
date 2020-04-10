<?php
session_start();
mb_internal_encoding("UTF-8");
require_once "../db_workers.php";
$valuedesc =json_decode($_POST['descval_ava'], true, 512);
$date=$_POST['date_ava'];
$num_string='';
foreach ($valuedesc as $item) {



        $value = $item['value_ava'];
        $num_ava = $item['num_ava'];
        $num = $item['num'];

    if (strpos($num, 'one')!== false) {
        $num_object=$con->query("SELECT object FROM workers WHERE id='$num_ava' ");
        while ($row = $num_object->fetch_assoc()) {
            $con->query("INSERT INTO avans SET id_worker=$num_ava, id_object =" . $row['object'] . ", date='$date', sum=$value ");
        }
    }
    if (strpos($num, 'two')!== false) {
        $num_object=$con->query("SELECT object_2 FROM workers WHERE id='$num_ava' ");
        while ($row = $num_object->fetch_assoc()) {
            $con->query("INSERT INTO avans SET id_worker=$num_ava, id_object =" . $row['object_2'] . ", date='$date', sum=$value ");
        }
    }
    if (strpos($num, 'three')!== false) {
        $num_object=$con->query("SELECT object_3 FROM workers WHERE id='$num_ava' ");
        while ($row = $num_object->fetch_assoc()) {
            $con->query("INSERT INTO avans SET id_worker=$num_ava, id_object =" . $row['object_3'] . ", date='$date', sum=$value ");
        }
    }
    if (strpos($num, 'four')!== false) {
        $num_object=$con->query("SELECT object_4 FROM workers WHERE id='$num_ava' ");
        while ($row = $num_object->fetch_assoc()) {
            $con->query("INSERT INTO avans SET id_worker=$num_ava, id_object =" . $row['object_4'] . ", date='$date', sum=$value ");
        }
    }






}
