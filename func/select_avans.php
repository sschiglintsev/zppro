<?php
session_start();mb_internal_encoding("UTF-8");
require_once "../db_workers.php";
    $select_avans=$con->query("SELECT id,surname,name,m_name,(SELECT `name` FROM  objects WHERE id=workers.object) AS object1, (SELECT `name` FROM  objects WHERE id=workers.object_2) AS object2, 
(SELECT `name` FROM  objects WHERE id=workers.object_3) AS object3, (SELECT `name` FROM  objects WHERE id=workers.object_4) AS object4 FROM workers ORDER BY surname");
    $tmp_avanss.='<option>Сотрудник</option>';
    while ($row = mysqli_fetch_array($select_avans))
    {
        $z1=',';
        $z2=',';
        $z3=',';
        if ($row['object2']=='Не присвоен') {$row['object2']='';$z1='';}
        if ($row['object3']=='Не присвоен') {$row['object3']='';$z2='';}
        if ($row['object4']=='Не присвоен') {$row['object4']='';$z3='';}

            $tmp_avanss .= '<option value=' . $row['id'] . '>' . $row['surname'] . ' ' . $row['name'] . ' ' . $row['m_name'] . ' 
                                         (' . $row['object1'] . ''.$z1.' ' . $row['object2'] . ''.$z2.'' . $row['object3'] . ''.$z3.'' . $row['object4'] . ')</option>';

    }
    echo $tmp_avanss;


