<?php
session_start();
mb_internal_encoding("UTF-8");

require_once "db_workers.php";

$workers = $con->query("SELECT *,(SELECT `name` FROM  objects WHERE id=workers.object) AS object1, (SELECT `name` FROM  objects WHERE id=workers.object_2) AS object2, 
(SELECT `name` FROM  objects WHERE id=workers.object_3) AS object3, (SELECT `name` FROM  objects WHERE id=workers.object_4) AS object4   FROM workers ORDER BY id ASC");
while ($row = $workers->fetch_assoc())
{   $year=0;
    $month=0;
    $ostatok=0;
    $zarplata = $con->query("SELECT ostatok, year, month FROM  zarplata WHERE id_worker={$row['id']}");
    while ($roww = $zarplata->fetch_assoc())
    {
        if ($roww['year']==$year AND $roww['month']==$month) {

            $ostatok=$ostatok+$roww['ostatok'];
        }
        if ($roww['year']>$year) {
            $year=$roww['year'];
            $month=$roww['month'];
            $ostatok=$roww['ostatok'];
        }
        if ($roww['year']==$year AND $roww['month']>$month) {
            $month=$roww['month'];
            $ostatok=$roww['ostatok'];
        }


    }
    $table .= "<tr> 
                <td>{$row['surname']}</td>
                <td>{$row['name']}</td>
                <td>{$row['m_name']}</td>
                <td>{$row['post']}</td>
                <td>{$row['tel']}</td>
                <td>{$row['object1']}</td>
                <td>{$row['object2']}</td>
                <td>{$row['object3']}</td>
                <td>{$row['object4']}</td>
                <td>{$row['salary_in_day']}</td>
                <td>{$row['salary_in_hour']}</td>
                <td>$ostatok</td>
                <td><a onclick='showpoverka_worker_edit();show_edit_worker({$row['id']});show_select_object_edit({$row['object']},{$row['object_2']},{$row['object_3']},{$row['object_4']})'>Редактировать</a></td>
                <td><a onclick='dellete_workers({$row['id']});show();'>Удалить</a></td>
             </tr>";}

$select_object=$con->query("SELECT id,name FROM objects");
while ($row = mysqli_fetch_array($select_object))
{$select .= '<option value='.$row['id'].'>'.$row['name']. '</option>';}

$objects = $con->query("SELECT * FROM objects  WHERE id<>54 ");
while ($row = $objects->fetch_assoc())
{$table_objects .= "<tr> 
                <td>{$row['name']}</td>
                <td>{$row['short_name']}</td>
                <td>{$row['address']}</td>
                <td><a onclick='show_edit_object({$row['id']});showpoverka_object_edit();'>Редактировать</a></td>
                <td><a onclick='dellete_objects({$row['id']});show_objects();'>Удалить</a></td>
             </tr>";}

$avans = $con->query("SELECT *,(SELECT surname FROM  workers WHERE id=avans.id_worker) AS surname,
(SELECT name FROM  workers WHERE id=avans.id_worker) AS name,(SELECT m_name FROM  workers WHERE id=avans.id_worker) AS m_name,(SELECT name FROM  objects WHERE id=avans.id_object) AS object FROM avans ORDER BY id ASC");
while ($row = $avans->fetch_assoc())
{$table_avans .= "<tr> 
                <td>{$row['surname']}</td>
                <td>{$row['name']}</td>
                <td>{$row['m_name']}</td>
                <td>{$row['object']}</td>
                <td>{$row['date']}</td>
                <td>{$row['sum']}</td>
                <td><a onclick='show_edit_card({$row['id']});showpoverka_avans_edit()'>Редактировать</a></td>
                <td><a onclick='dellete_avans({$row['id']});show_avans();'>Удалить</a></td>
             </tr>";}

$select_workers=$con->query("SELECT id,surname,name,m_name FROM workers");
while ($row = mysqli_fetch_array($select_workers))
{$select_w .= '<option value='.$row['id'].'>'.$row['surname']. '," ",'.$row['name']. '," ",'.$row['m_name']. '</option>';}

$tabel = $con->query("SELECT *,(SELECT surname FROM  workers WHERE id=tabel.id_worker) AS surname,
(SELECT name FROM  workers WHERE id=tabel.id_worker) AS name,(SELECT m_name FROM  workers WHERE id=tabel.id_worker) AS m_name,
(SELECT name FROM  objects WHERE id=tabel.id_object) AS name_object FROM tabel ORDER BY id ASC");
while ($row = $tabel->fetch_assoc())
{$table_tabel .= "<tr> 
                <td>{$row['surname']}</td>
                <td>{$row['name']}</td>
                <td>{$row['m_name']}</td>
                <td>{$row['name_object']}</td>
                <td>{$row['day']}</td>
                <td>{$row['hour']}</td>
                <td>{$row['fine']}</td>
                <td><a onclick='dellete_tabel({$row['id']});show_tabel();'>Удалить</a></td>
             </tr>";}

$main_object = $con->query("SELECT id,name FROM objects WHERE id<>54");
while ($row = $main_object->fetch_assoc())
{
    $main_workers = $con->query("SELECT COUNT(*) AS num FROM workers WHERE object={$row['id']} ");
    if ($main_workers) {
        $roww = $main_workers->fetch_assoc();
        $main_block .="<div id=\"main_blocks\" class=\"main_blocks\">
                        <span>Объект : ".$row['name']."</span><br>
                        <span>Сотрудников: ".$roww['num']."</span><br>
                        <span>Общий остаток: </span><br>
                        <span>Выплачено всего: </span><br>
                        <span>Выплачено всего: </span>
                   </div>";
    }
}

