<?php
session_start();mb_internal_encoding("UTF-8");
require_once "../db_workers.php";
$pole1=$_POST['id_object'];

$tmp_1='';
$select_object=$con->query("SELECT id,name FROM objects");


$tmp_1.='<option disabled selected >Объект</option>';
while ($row = mysqli_fetch_array($select_object))
{if ($row['id']!='54'){
    $tmp_1.='<option value='.$row['id'].'>'.$row['name']. '</option>';
}
}

echo $tmp_1;
