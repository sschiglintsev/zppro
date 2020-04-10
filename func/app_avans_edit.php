<?php
session_start();mb_internal_encoding("UTF-8");

require_once "../db_workers.php";
$id_edit = $_POST['delobj'];

$avanss = $con->query("SELECT * FROM avans WHERE id='$id_edit' ");
while ($roww = $avanss->fetch_assoc()){
    echo '<div class=\"control-group\">
         <select id="sel5" name="select5" style="width: 600px; height: 27px" value='.$roww["id_worker"].'>';
    $select_avans=$con->query("SELECT id,surname,name,m_name,(SELECT `name` FROM  objects WHERE id=workers.object) AS object1, (SELECT `name` FROM  objects WHERE id=workers.object_2) AS object2, 
(SELECT `name` FROM  objects WHERE id=workers.object_3) AS object3, (SELECT `name` FROM  objects WHERE id=workers.object_4) AS object4 FROM workers ORDER BY surname");
    echo '<option>Сотрудник</option>';
    while ($row = mysqli_fetch_array($select_avans))
    {
        $z1=',';
        $z2=',';
        $z3=',';

            if ($row['id']==$roww['id_worker'])
            {   if ($row['object2']=='Не присвоен') {$row['object2']='';$z1='';}
                if ($row['object3']=='Не присвоен') {$row['object3']='';$z2='';}
                if ($row['object4']=='Не присвоен') {$row['object4']='';$z3='';}

                echo '<option value=' . $row['id'] . ' selected>' . $row['surname'] . ' ' . $row['name'] . ' ' . $row['m_name'] . '
                                             (' . $row['object1'] . ''.$z1.' ' . $row['object2'] . ''.$z2.'' . $row['object3'] . ''.$z3.'' . $row['object4'] . ')</option>';
            }
            else
            { if ($row['object2']=='Не присвоен') {$row['object2']='';$z1='';}
              if ($row['object3']=='Не присвоен') {$row['object3']='';$z2='';}
              if ($row['object4']=='Не присвоен') {$row['object4']='';$z3='';}

                echo '<option value=' . $row['id'] . '>' . $row['surname'] . ' ' . $row['name'] . ' ' . $row['m_name'] . ' 
                                              (' . $row['object1'] . ''.$z1.' ' . $row['object2'] . ''.$z2.'' . $row['object3'] . ''.$z3.'' . $row['object4'] . ')</option>';
            }

    };

 echo'      </select>
            </div>
            <p></p>
            <input  name="pole2" id="pole2_avans_edit" type="date" style="width: 600px; height: 27px" placeholder="Дата" value='.$roww["date"].' ">
            <p></p>
            <input  name="pole3" id="pole3_avans_edit" type="text" style="width: 600px; height: 27px" placeholder="Сумма" value='.$roww["sum"].'>
            <p></p>
            <a class="btn" href=\'javascript:;\' onclick="poverka_avans_edit('.$roww["id"].');" id="dalee_avans_edit" name="hello_avans">Сохранить</a>
            <a class="btn" href=\'javascript:;\' onclick="hidepoverka_avans_edit();" >Закрыть</a>
         </select>
      </div>';
    }

