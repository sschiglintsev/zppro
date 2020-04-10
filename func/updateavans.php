<?php
session_start();mb_internal_encoding("UTF-8");
require_once "../db_workers.php";
$pole1 = $_POST['pole1'];
$pole2 = $_POST['pole2'];
$pole3 = $_POST['pole3'];
$pole4 = $_POST['pole4'];
$object_name=$con->query("SELECT object FROM workers WHERE id='$pole1' ");

while ($row = $object_name->fetch_assoc()) {

    $con->query("UPDATE avans SET id_worker='$pole1', id_object =" . $row['object'] . ", date='$pole2',sum='$pole3' WHERE id=$pole4");
}
