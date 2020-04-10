<?php
session_start();mb_internal_encoding("UTF-8");

require_once "../db_workers.php";
$id_edit = $_POST['delobj'];

$objects = $con->query("SELECT * FROM objects WHERE id='$id_edit' ");
while ($row = $objects->fetch_assoc()){
    echo ' <div class=\"control-group\">
            <input  name="pole1" id="pole1_object_edit" type="text" style="width: 200px; height: 27px" placeholder="Название" value="'.$row["name"].'">
            <p></p>
            <input  name="pole2" id="pole2_object_edit" type="text" style="width: 200px; height: 27px" placeholder="Короткое название" value="'.$row["short_name"].'" ">
            <p></p>
            <input  name="pole3" id="pole3_object_edit" type="text" style="width: 200px; height: 27px" placeholder="Адрес" value="'.$row["address"].'">
            <p></p>
            <a class="btn" href=\'javascript:;\' onclick="poverka_object_edit('.$row["id"].');" id="dalee_object_edit" name="hello_object">Сохранить</a>
            <a class="btn" href=\'javascript:;\' onclick="hidepoverka_object_edit();" >Закрыть</a>
         
           </div>';
}