<?php
session_start();mb_internal_encoding("UTF-8");
require_once "../db_workers.php";
$pole1=$_POST['id_object'];
$tmp_1111='';
$select_object111=$con->query("SELECT id,name FROM objects");
if ($pole1==false)
{
    $tmp_1111='<option disabled selected value="54">Объект №4</option>';
    while ($row = mysqli_fetch_array($select_object111))
    {
        $tmp_1111.='<option value='.$row['id'].'>'.$row['name']. '</option>';
    }
    echo $tmp_1111;
}
else
{
    while ($row = mysqli_fetch_array($select_object111))
    {
        if ($row['id']==$pole1) {
            $tmp_1111.='<option value='.$row['id'].' selected>'.$row['name']. '</option>';
        }
        else {
            $tmp_1111.='<option value='.$row['id'].'>'.$row['name']. '</option>';
        }
    }
    echo $tmp_1111;
}
