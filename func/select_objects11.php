<?php
session_start();mb_internal_encoding("UTF-8");
require_once "../db_workers.php";
$pole1=$_POST['id_object'];
$tmp_11='';
$select_object1=$con->query("SELECT id,name FROM objects");
if ($pole1==false)
{
    $tmp_11='<option disabled selected value="54">Объект №2</option>';
    while ($row = mysqli_fetch_array($select_object1))
    {
        $tmp_11.='<option value='.$row['id'].'>'.$row['name']. '</option>';
    }
    echo $tmp_11;
}
else
{
    while ($row = mysqli_fetch_array($select_object1))
    {
        if ($row['id']==$pole1) {
            $tmp_11.='<option value='.$row['id'].' selected>'.$row['name']. '</option>';
        }
        else {
            $tmp_11.='<option value='.$row['id'].'>'.$row['name']. '</option>';
        }
    }
    echo $tmp_11;
}
