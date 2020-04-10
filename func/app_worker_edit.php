<?php
session_start();mb_internal_encoding("UTF-8");

require_once "../db_workers.php";
$id_edit = $_POST['delobj'];


$worker = $con->query("SELECT * FROM workers WHERE id='$id_edit' ");
while ($roww = $worker->fetch_assoc()){
    echo '
            <input  name="pole1" id="pole1_worker_edit" type="text" style="width: 200px; height: 27px" placeholder="Фамилия" value='.$roww["surname"].' ">
            <p></p>
            <input  name="pole2" id="pole2_worker_edit" type="text" style="width: 200px; height: 27px" placeholder="Имя" value='.$roww["name"].' ">
            <p></p>
            <input  name="pole3" id="pole3_worker_edit" type="text" style="width: 200px; height: 27px" placeholder="Отчество" value='.$roww["m_name"].' ">
            <p></p>
            <input  name="pole4" id="pole4_worker_edit" type="text" style="width: 200px; height: 27px" placeholder="Должность" value='.$roww["post"].' ">
            <p></p>
            <input  name="pole5" id="pole5_worker_edit" type="text" style="width: 200px; height: 27px" placeholder="Телефон" value='.$roww["tel"].' ">
            <p></p>';
    $select_object=$con->query("SELECT id,name FROM objects");
    echo '<select id="sel6" style="width: 200px; height: 27px" >';
    while ($row = mysqli_fetch_array($select_object))
    {

        if ($row['id']==$roww['object']) {
            echo '<option value='.$row['id'].' selected>'.$row['name']. '</option>';
        }
        else {
            echo '<option value='.$row['id'].'>'.$row['name']. '</option>';
        }
    }
    echo '</select>
            <p></p>';

    echo '<select id="sel6_2" style="width: 200px; height: 27px" >';
    $select_object=$con->query("SELECT id,name FROM objects");
    while ($row = mysqli_fetch_array($select_object))
    {

        if ($row['id']==$roww['object_2']) {
            echo '<option value='.$row['id'].' selected>'.$row['name']. '</option>';
        }
        else {
            echo '<option value='.$row['id'].'>'.$row['name']. '</option>';
        }
    }
    echo '</select>
            <p></p>';

    echo '<select id="sel6_3" style="width: 200px; height: 27px" >';
    $select_object=$con->query("SELECT id,name FROM objects");
    while ($row = mysqli_fetch_array($select_object))
    {

        if ($row['id']==$roww['object_3']) {
            echo '<option value='.$row['id'].' selected>'.$row['name']. '</option>';
        }
        else {
            echo '<option value='.$row['id'].'>'.$row['name']. '</option>';
        }
    }
    echo '</select>
            <p></p>';

    echo '<select id="sel6_4" style="width: 200px; height: 27px" >';
    $select_object=$con->query("SELECT id,name FROM objects");
    while ($row = mysqli_fetch_array($select_object))
    {

        if ($row['id']==$roww['object_4']) {
            echo '<option value='.$row['id'].' selected>'.$row['name']. '</option>';
        }
        else {
            echo '<option value='.$row['id'].'>'.$row['name']. '</option>';
        }
    }
    echo '</select>';
echo        '<p></p>
            <input onkeyup=$("#pole8_worker_edit").val(this.value/8) name="pole7" id="pole7_worker_edit" style="width: 200px; height: 27px" type="text" placeholder="Оклад в день" value='.$roww["salary_in_day"].'>
            <p></p>
            <input  name="pole8" id="pole8_worker_edit" type="text" style="width: 200px; height: 27px" placeholder="Оклад в час" value='.$roww["salary_in_hour"].' ">
            <p></p>
            <input  name="pole9" id="pole9_worker_edit" type="text" style="width: 200px; height: 27px" placeholder="Долг" value='.$roww["debt"].' ">
            <p></p>
            <a class="btn" href=\'javascript:;\' onclick="poverka_worker_edit('.$id_edit.');" id="dalee_worker_edit" name="hello_worker">Сохранить</a>
            <a class="btn" href=\'javascript:;\' onclick="hidepoverka_worker_edit();" >Закрыть</a>';
}