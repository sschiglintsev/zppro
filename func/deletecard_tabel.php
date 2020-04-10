<?php
session_start();mb_internal_encoding("UTF-8");
require_once "../db_workers.php";

$t_pole1= $_POST['pole1'];
$t_pole2= $_POST['pole2'];
$t_pole3= $_POST['pole3'];
$t_pole4= $_POST['pole4'];
$con->query("DELETE FROM tabel WHERE id_worker='$t_pole1' AND id_object='$t_pole2' AND year='$t_pole3' AND month='$t_pole4' ");