<?php
session_start();mb_internal_encoding("UTF-8");
require_once "../db_workers.php";


$workers_group = $con->query("SELECT *,(SELECT `name` FROM  objects WHERE id=workers.object) AS objects,(SELECT `name` FROM  objects WHERE id=workers.object_2) AS objects_2,
(SELECT `name` FROM  objects WHERE id=workers.object_3) AS objects_3,(SELECT `name` FROM  objects WHERE id=workers.object_4) AS objects_4 FROM workers ORDER BY object ASC");
$users=array();
$id=array();

while ($row = $workers_group->fetch_assoc()) {
    if ($row['object'] !== '54') {
        echo "<tr> 
                <td>{$row['surname']} {$row['name']} {$row['m_name']}</td>
                <td>{$row['objects']}</td>
                <td><input style='border: aliceblue;text-align: center;background: rgba(183,184,191,0)' id='one{$row['id']}' data-type=" . $row['id'] . " class=\"p inputdesc_ava\"></td>
             </tr>";
    }
    if ($row['object_2'] != '54') {
        echo "<tr> 
                <td>{$row['surname']} {$row['name']} {$row['m_name']}</td>
                <td>{$row['objects_2']}</td>
                <td><input style='border: aliceblue;text-align: center;background: rgba(183,184,191,0)' id='two{$row['id']}' data-type=" . $row['id'] . " class=\"p inputdesc_ava\"></td>
             </tr> ";
    }
    if ($row['object_3'] != '54') {
        echo "<tr> 
                <td>{$row['surname']} {$row['name']} {$row['m_name']}</td>
                <td>{$row['objects_3']}</td>
                <td><input style='border: aliceblue;text-align: center;background: rgba(183,184,191,0)' id='three{$row['id']}'' data-type=" . $row['id'] . " class=\"p inputdesc_ava\"></td>
             </tr> ";
    }
    if ($row['object_4'] != '54') {
        echo "<tr> 
                <td>{$row['surname']} {$row['name']} {$row['m_name']}</td>
                <td>{$row['objects_4']}</td>
                <td><input style='border: aliceblue;text-align: center;background: rgba(183,184,191,0)' id='four{$row['id']}' data-type=" . $row['id'] . " class=\"p inputdesc_ava\"></td>
             </tr> ";
    }
}
 echo "   <script>
        function save_group_avans(id) {
            var numid=$(id).val();
        }
    </script> ";

echo " <script>
                    function save_group_avans(pole2_avans_group) {
                        var desc_ava = $('.inputdesc_ava');
                        var desc_array_avans=[];
                        var pole_date = pole2_avans_group;
                        $.each(desc_ava,function (i,item) {
                            desc_array_avans.push({
                                num: $(item).attr('id'),
                                num_ava: $(item).attr('data-type'),
                                value_ava: $(item).val(),
                                
                            })
                        })
                        
                                        console.log(desc_array_avans)
                        $.ajax({
                                    method: 'POST',
                                    url: '../func/save_group_avans.php',
                                    data: {
                                        'descval_ava': JSON.stringify(desc_array_avans),
                                        'date_ava': pole_date
                                    },
                                    success: function(responce) {
                                        $('#pole2_avans_group').val('');
                                        show_avans();
                                        
                                        console.log(responce)
                                    }
                                });}
                </script>";



