<?php
session_start();
if (isset($_SESSION['userid'])){
error_reporting( E_ERROR );
header('Content-Type: text/html; charset=utf-8');
require_once "func/app.php";
require_once "db_workers.php";}
else{header( 'Location: index.php', true, 303 );}
?>

<!DOCTYPE html>

<html>
  <head>
    
    <title>Расчет зарплаты</title>

      <link href="css/bootstrap.min.css" rel="stylesheet">
      <link href="css/style.css" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
      <link href="https://fonts.googleapis.com/css?family=Russo+One&amp;subset=cyrillic,latin-ext" rel="stylesheet">
      <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,700&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
      <script type="text/javascript" src="js/jquery-3.2.1.js"></script>
      <script type="text/javascript" src="js/main.js"></script>
      <link rel='stylesheet' href='css/sweetalert2.min.css' type='text/css' media='all' />
      <script src='js/sweetalert2.min.js'></script>
      <script type="text/javascript" src="https://use.fontawesome.com/adab0aa7d6.js"></script>
      <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.js"></script>

      <script>
          $(document).ready(function () {
              $('#content1').fadeIn(400).show();
              show();
              show_objects()
          });

          function savetab(tabid) {
              $('section').hide();
              $('#content'+tabid).fadeIn(400).show()
          }
      </script>
  </head>
  <body>
    <div class="logo">
        <h1>ТеплоТехСервис</h1>
    </div>
    <div class="tabs" >
      <nav class="nav">
      <ul id="menu" class="menu">
          <li  class="active" onclick="savetab('1');">Главная</li>
          <li class="" onclick="savetab('2');">Сотрудники</li>
          <li class="" onclick="savetab('3');">Объекты</li>
          <li class="" onclick="savetab('4');">Табель</li>
          <li class="" onclick="savetab('5');">Аванс</li>
          <li class="" onclick="savetab('6');">Зарплата</li>
          <li class="" onclick="savetab('7');">Отчёты</li>
          <li class="" ><a href="login.php?logout=1">Выход</a></li>
      </ul>
      </nav>
        <script type="text/javascript">
            $(document).ready(function () {
                $('#menu li').click(function () {
                    $('#menu li').removeClass('active');
                    $(this).addClass('active');
                    return true;
                });
            });
        </script>
        <div class="tab-content">
            <section id="content1">
                <div id="main_block" class="main_block">
                    <?=$main_block?>
                </div>

            </section>
            <section id="content2">
                <p></p>
                <div class="btn-group-sm">
                    <a class="btn btn-default" href='javascript:;' onclick="showpoverka();show_select_objects();show_select_objects11();show_select_objects111();show_select_objects1111()" >Добавить</a>
                    </div>
                <p></p>
                    <table id='workers' class='display' width='100%' cellspacing='0'>
                    <thead>
                        <tr>
                            <th>Фамилия</th>
                            <th>Имя</th>
                            <th>Отчество</th>
                            <th>Должность</th>
                            <th>Телефон</th>
                            <th>Объект №1</th>
                            <th>Объект №2</th>
                            <th>Объект №3</th>
                            <th>Объект №4</th>
                            <th>Оклад в день</th>
                            <th>Оклад в час</th>
                            <th>Остаток</th>
                            <th>Действие</th>
                            <th>Действие</th>
                        </tr>
                    </thead>
                    <tbody id="block_workers">
                    <?=$table?>
                    </tbody>
                    </table>
                <script>
                    $(function(){
                    $("#workers").dataTable( {
                        scrollCollapse: true,
                        paging: false,
                        "language": {
                            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Russian.json"
                        }
                    });
                    })
                </script>
            </section>
            <section id="content3">
                <p></p>
                <div class="btn-group-sm">
                    <a class="btn btn-default" href='javascript:;' onclick="showpoverka_objects();" >Добавить</a>
                </div>
                <p></p>
                <table id='objects' class='display' width='100%' cellspacing='0'>
                    <thead>
                    <tr>
                        <th>Название</th>
                        <th>Короткое название</th>
                        <th>Адрес</th>
                        <th>Действие</th>
                        <th>Действие</th>
                    </tr>
                    </thead>
                    <tbody id="block_objects">
                        <?=$table_objects?>
                    </tbody>
                </table>

                <script>
                    $(function(){
                        $("#objects").dataTable( {
                            "order":[[0,"asc"]],
                            "language": {
                                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Russian.json"
                            }
                        });
                    })
                </script>
            </section>
            <section id="content4">
                <script>
                    $(document).ready(function(){
                        show_select_objects2();
                    });
                </script>
                <p></p>
                <span id="errmsg0"></span>
                <form action="func/exist_tabel.php" method="post">
                    <select class="form-control-box" id="sel2" name="select2" ></select>
                    <select class="form-control-box" id="sel_year" name="select_year" >
                        <option value="0">Год</option>
                        <option value="2017">2017</option>
                        <option value="2018">2018</option>
                        <option value="2019">2019</option>
                        <option value="2020">2020</option>
                        <option value="2021">2021</option>
                    </select>
                    <select class="form-control-box" id="sel_month" name="select_month" >
                        <option>Месяц</option>
                        <option value="01">Январь</option>
                        <option value="02">Февраль</option>
                        <option value="03">Март</option>
                        <option value="04">Апрель</option>
                        <option value="05">Май</option>
                        <option value="06">Июнь</option>
                        <option value="07">Июль</option>
                        <option value="08">Август</option>
                        <option value="09">Сентябрь</option>
                        <option value="10">Октябрь</option>
                        <option value="11">Ноябрь</option>
                        <option value="12">Декабрь</option>
                    </select>
                    <a class="btn btn-default" href='javascript:;' onclick="open_tabel();" id="dalee_tabel" name="hello_tabel" >Открыть табель</a>
                    <a class="btn btn-default" href='javascript:;' onclick="create_tabel();" id="dalee_tabel_2" name="hello_tabel_2" >Создать табель</a>
                    <a class="btn btn-default" style="display: none" href='javascript:;' id="adduser" onclick="showpoverka_tabel_form();show_select_people_tabel()">Добавить сотрудника</a>
                </form>
                <p></p>
                <form id="tabel_form">
                <div id='block_tabel' class='display' width='100%' cellspacing='0'>
                </div>

                </form>

                <a class="btn btn-default" style="display: none" href='javascript:;' id="saveuserss" onclick="saveusers(),showAlert()">Сохранить</a>
                <script>
                    function showAlert(){
                        swal('Успешно сохранено!');
                    }
                </script>
                <script>
                    function open_tabel() {
                        var pole1 = $('#sel2').val();
                        var pole2 = $('#sel_year').val();
                        var pole3 = $('#sel_month').val();
                        if (pole1>0 & pole2>0 & pole3>0) {
                            $.ajax({
                                method: "POST",
                                url: "../func/exist_tabel.php",
                                data: {
                                    "pole1": pole1,
                                    "pole2": pole2,
                                    "pole3": pole3
                                },
                                success:
                                    function (response) {
                                        console.log(response)
                                        $('#content4').fadeIn(400);
                                        show_tabel(pole1, pole2, pole3);
                                    }
                            });
                        }
                        else {
                            $('#window_alert_true').text('Для открытия табеля выберите объект, год, месяц !');
                            show_window_alert()
                        }

                    }

                    function hidepoverka_tabel(){
                        $("#spisok_tabel").hide();
                    }
                    function showpoverka_tabel(){
                        $("#spisok_tabel").show();
                    }
                </script>
                <script>

                    function create_tabel() {
                        var pole1 = $('#sel2').val();
                        var pole2 = $('#sel_year').val();
                        var pole3 = $('#sel_month').val();
                        if (pole1>0 & pole2>0 & pole3>0) {
                            $.ajax({
                                method: "POST",
                                url: "../func/create_tabel.php",
                                data: {
                                    "pole1": pole1,
                                    "pole2": pole2,
                                    "pole3": pole3
                                },
                                success:
                                    function (response) {
                                        console.log(response)
                                        $('#content4').fadeIn(400);

                                        show_tabel(pole1, pole2, pole3);

                                    }
                            });
                        }
                        else {
                            $('#window_alert_true').text('Для создания табеля выберите объект, год, месяц !');
                            show_window_alert()
                        }
                    }
                </script>
                </section>
            <section id="content5">
                <p></p>
                <div class="btn-group-sm">
                    <a class="btn btn-default" href='javascript:;' onclick="showpoverka_avans();show_select_people()" >Добавить cотрудника</a>
                    <a class="btn btn-default" href='javascript:;' onclick="showpoverka_avans_group();add_avans_group()" >Добавить несколько сотрудников</a>
                </div>
                <p></p>
                <table id='avans' class='display' width='100%' cellspacing='0'>
                    <thead>
                    <tr>
                        <th>Фамилия</th>
                        <th>Имя</th>
                        <th>Отчество</th>
                        <th>Объект</th>
                        <th>Дата</th>
                        <th>Сумма</th>
                        <th>Действие</th>
                        <th>Действие</th>
                    </tr>
                    </thead>
                    <tbody id="block_avans">
                    <?=$table_avans?>
                    </tbody>
                </table>
                <script>
                    $(function(){
                        $("#avans").dataTable( {
                            "order":[[0,"asc"]],
                            "language": {
                                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Russian.json"
                            }
                        });
                    })
                </script>
                </section>
            <section id="content6">
                <script>
                    $(document).ready(function(){
                        show_select_objects3();
                    });
                </script>
                <p></p>
                <span id="errmsg0"></span>
                <form action="func/exist_zarplata.php" method="post">
                    <select class="form-control-box" id="sel4" name="select4" ></select>
                    <select class="form-control-box" id="sel_year_zp" name="select_year" >
                        <option value="0">Год</option>
                        <option value="2017">2017</option>
                        <option value="2018">2018</option>
                        <option value="2019">2019</option>
                        <option value="2020">2020</option>
                        <option value="2021">2021</option>
                    </select>
                    <select class="form-control-box" id="sel_month_zp" name="select_month" >
                        <option>Месяц</option>
                        <option value="01">Январь</option>
                        <option value="02">Февраль</option>
                        <option value="03">Март</option>
                        <option value="04">Апрель</option>
                        <option value="05">Май</option>
                        <option value="06">Июнь</option>
                        <option value="07">Июль</option>
                        <option value="08">Август</option>
                        <option value="09">Сентябрь</option>
                        <option value="10">Октябрь</option>
                        <option value="11">Ноябрь</option>
                        <option value="12">Декабрь</option>
                    </select>
                    <a class="btn btn-default" href='javascript:;' onclick="show_zarplata0();" id="zp" name="zp" >Открыть ЗП</a>
                    <a class="btn btn-default" href='javascript:;' onclick="create_zarplata();" id="zp_c" name="zp_c" >Расчитать ЗП</a>
                    <a class="btn btn-default" style="display: none" href='javascript:;' id="update_zp" onclick="update_zp()" title="Обновляются данные при изменении табеля и аванса">Обновить данные</a>
                    <a class="btn btn-default" href='javascript:;' id="merger_zp_worker" onclick="merger_zp_worker()" title="Объединие сотрудников работающие на разных объектах">Объединие</a>

                </form>
                <p></p>
                <form id="zarplata_form">
                    <div id='block_zarplata' class='display' width='100%' cellspacing='0'>
                    </div>
                </form>
                <a class="btn btn-default" style="display: none" href='javascript:;' id="save_zp" onclick="save_zp()">Сохранить</a>
                <script>
                    function show_zarplata0() {
                        var pole1 = $('#sel4').val();
                        var pole2 = $('#sel_year_zp').val();
                        var pole3 = $('#sel_month_zp').val();
                        if (pole1>0 || pole2>0 || pole3>0) {
                            $.ajax({
                                method: "POST",
                                url: "../func/exist_zarplata.php",
                                data: {
                                    "pole1": pole1,
                                    "pole2": pole2,
                                    "pole3": pole3
                                },
                                success:
                                    function (response) {
                                        console.log(response)
                                        $('#content6').fadeIn(400);
                                        //$('#window_alert_true').text(response);
                                        //show_window_alert();
                                        show_zarplata(pole1, pole2, pole3);
                                    }
                            });
                        }
                        else {
                            $('#window_alert_true').text('По заданным параметрам расчет ЗП не существует!');
                            show_window_alert()
                        }
                    }
                </script>
                <script>
                    function create_zarplata() {
                        var pole1 = $('#sel4').val();
                        var pole2 = $('#sel_year_zp').val();
                        var pole3 = $('#sel_month_zp').val();
                        if (pole1>0 || pole2>0 || pole3>0) {
                            $.ajax({
                                method: "POST",
                                url: "../func/create_zarplata.php",
                                data: {
                                    "pole1": pole1,
                                    "pole2": pole2,
                                    "pole3": pole3
                                },
                                success:
                                    function (response) {
                                        console.log(response)
                                        $('#content6').fadeIn(400);
                                        $('#window_alert_true').text(response);
                                        show_window_alert();
                                        show_zarplata(pole1, pole2, pole3);
                                    }
                            });
                        }
                        else {
                            $('#window_alert_true').text('По заданным параметрам расчет ЗП не возможен!');
                            show_window_alert()
                        }
                    }
                </script>
                <script>
                    function update_zp() {
                        var pole1 = $('#sel4').val();
                        var pole2 = $('#sel_year_zp').val();
                        var pole3 = $('#sel_month_zp').val();
                        if (pole1>0 || pole2>0 || pole3>0) {
                            $.ajax({
                                method: "POST",
                                url: "../func/updatezarplata.php",
                                data: {
                                    "pole1": pole1,
                                    "pole2": pole2,
                                    "pole3": pole3
                                },
                                success:
                                    function (response) {
                                        console.log(response)
                                        $('#content6').fadeIn(400);
                                        $('#window_alert_true').text(response);
                                        show_window_alert();
                                        show_zarplata(pole1, pole2, pole3);
                                    }
                            });
                        }
                        else {
                            $('#window_alert_true').text('По заданным параметрам расчет ЗП не существует!');
                            show_window_alert()
                        }
                    }
                </script>
                <script>
                    function merger_zp_worker() {
                        var pole2 = $('#sel_year_zp').val();
                        var pole3 = $('#sel_month_zp').val();
                        if (pole2>0 || pole3>0) {
                            $.ajax({
                                method: "POST",
                                url: "../func/mergerzarplata.php",
                                data: {
                                    "pole2": pole2,
                                    "pole3": pole3
                                },
                                success:
                                    function (response) {
                                        console.log(response)
                                        $('#content6').fadeIn(400);

                                        //show_zarplata(pole1, pole2, pole3);
                                    }
                            });
                        }
                        else {
                        }
                    }
                </script>
            </section>
            <section id="content7">
                <script>
                    $(document).ready(function(){
                        show_select_objects_export();
                    });
                </script>

                <form method="post" action="func/excel_zp_all.php">
                    <select class="form-control-box" id="sel10" name="select10" ></select>
                    <select class="form-control-box" id="sel_year_zp_all" name="select_year_zp_all" >
                        <option value="0">Год</option>
                        <option value="2017">2017</option>
                        <option value="2018">2018</option>
                        <option value="2019">2019</option>
                        <option value="2020">2020</option>
                        <option value="2021">2021</option>
                    </select>
                    <select class="form-control-box" id="sel_month_zp_all" name="select_month_zp_all" >
                        <option>Месяц</option>
                        <option value="01">Январь</option>
                        <option value="02">Февраль</option>
                        <option value="03">Март</option>
                        <option value="04">Апрель</option>
                        <option value="05">Май</option>
                        <option value="06">Июнь</option>
                        <option value="07">Июль</option>
                        <option value="08">Август</option>
                        <option value="09">Сентябрь</option>
                        <option value="10">Октябрь</option>
                        <option value="11">Ноябрь</option>
                        <option value="12">Декабрь</option>
                    </select>
                    <button class="btn btn-default" type="submit" >Экспорт Зарплаты</button>
                </form>
                <br><br>

                <form method="post" action="func/excel_zp_worker.php">
                    <select class="form-control-box" id="sel12" name="select12" ></select>
                    <select class="form-control-box" id="sel_year_zp_worker" name="select_year_zp_worker" >
                        <option value="0">Год</option>
                        <option value="2017">2017</option>
                        <option value="2018">2018</option>
                        <option value="2019">2019</option>
                        <option value="2020">2020</option>
                        <option value="2021">2021</option>
                    </select>
                    <select class="form-control-box" id="sel_month_zp_worker" name="select_month_zp_worker" >
                        <option>Месяц</option>
                        <option value="01">Январь</option>
                        <option value="02">Февраль</option>
                        <option value="03">Март</option>
                        <option value="04">Апрель</option>
                        <option value="05">Май</option>
                        <option value="06">Июнь</option>
                        <option value="07">Июль</option>
                        <option value="08">Август</option>
                        <option value="09">Сентябрь</option>
                        <option value="10">Октябрь</option>
                        <option value="11">Ноябрь</option>
                        <option value="12">Декабрь</option>
                    </select>
                    <button  class="btn btn-default" type="submit" >Экспорт Зарплаты сотрудника</button>
                </form>


                    <script>
                    function excel_zp(){
                        var pole1 = $('#sel10').val();
                        var pole2 = $('#sel_year_zp_all').val();
                        var pole3 = $('#sel_month_zp_all').val();
                        if(pole1>0 || pole2>0 || pole3>0) {
                            $.ajax({
                                method: "POST",
                                url: "func/excel_zp_all.php",
                                data: {
                                    "pole1": pole1,
                                    "pole2": pole2,
                                    "pole3": pole2
                                },
                                success: function (response) {
                                    console.log(response)
                                    $('#content7').fadeIn(400).show();
                                }
                            });
                        }
                        else {
                            $('#window_alert_true').text('По заданным параметрам экспорт не возможен');
                            show_window_alert()
                        }
                    }
                </script>
            </section>
        </div>
    </div>

    <script>
        function delcard(){
            var pole1 = $('#pole1').val();
            var pole2 = $('#pole2').val();
            if(pole1!='') {
                $.ajax({
                    method: "POST",
                    url: "../func/insertworkers.php",
                    data: {
                        "pole1": pole1,
                        "pole2": pole2
                    },
                    success: function (response) {
                        $('#content2').fadeIn(400).show();
                    }
                });
            }
        }
    </script>
    <script>
        function delcard_objects(){
            var pole1 = $('#pole1').val();
            var pole2 = $('#pole2').val();
            if(pole1!='') {
                $.ajax({
                    method: "POST",
                    url: "../func/insertobjects.php",
                    data: {
                        "pole1": pole1,
                        "pole2": pole2
                    },
                    success: function (response) {
                        $('#content3').fadeIn(400).show_objects();
                    }
                });
            }
        }
    </script>
    <script>
        function delcard_avans(){
            var pole1 = $('#pole1').val();
            var pole2 = $('#pole2').val();
            if(pole1!='') {
                $.ajax({
                    method: "POST",
                    url: "../func/insertavans.php",
                    data: {
                        "pole1": pole1,
                        "pole2": pole2
                    },
                    success: function (response) {
                        $('#content5').fadeIn(400).show_avans();
                    }
            });
        }
        }
    </script>
    <div class="b-popup" id="spisok" style="display: none;">
        <div class="b-popup-content" style="width: 300px; height: 520px;text-align: center;">
            <form style="width: 100%">
                <input  name="pole1" id="pole1" type="text" placeholder="Фамилия">
                <p></p>
                <input  name="pole2" id="pole2" type="text" placeholder="Имя">
                <p></p>
                <input  name="pole3" id="pole3" type="text" placeholder="Отчество">
                <p></p>
                <input  name="pole4" id="pole4" type="text" placeholder="Должность">
                <p></p>
                <input  name="pole5" id="pole5" type="text" placeholder="Телефон">
                <p></p>
                <div class=\"control-group\">
                        <select id="sel1" name="select1" style="width: 159px; height: 27px">
                        </select>
                        <p></p>
                        <select id="sel11" name="select11" style="width: 159px; height: 27px">
                        </select>
                        <p></p>
                        <select id="sel111" name="select111" style="width: 159px; height: 27px">
                        </select>
                        <p></p>
                        <select id="sel1111" name="select1111" style="width: 159px; height: 27px">
                        </select>
                </div>
                <p></p>
                <input onkeyup="$('#pole8').val(this.value/8)" name="pole7" id="pole7" type="text" placeholder="Оклад в день">
                <p></p>
                <input  name="pole8" id="pole8" type="text" placeholder="Оклад в час">
                <p></p>
                <input  name="pole9" id="pole9" type="text" placeholder="Долг">
                <p></p>
                <ul id="spisocheksimochek" class="listok bbb" style="display: none; width: 100%"></ul>
                    <a class="btn" href='javascript:;' onclick="poverka();" id="dalee" name="hello">Добавить</a>
                    <a class="btn" href='javascript:;' onclick="hidepoverka();" >Закрыть</a>
            </form>
            <script>
            function poverka(){
                    var pole1 = $('#pole1').val();
                    var pole2 = $('#pole2').val();
                    var pole3 = $('#pole3').val();
                    var pole4 = $('#pole4').val();
                    var pole5 = $('#pole5').val();
                    var pole66 = document.getElementById('sel1');
                    var pole6 = pole66.value;
                    var pole66_2 = document.getElementById('sel11');
                    var pole6_2 = pole66_2.value;
                    var pole66_3 = document.getElementById('sel111');
                    var pole6_3 = pole66_3.value;
                    var pole66_4 = document.getElementById('sel1111');
                    var pole6_4 = pole66_4.value;
                    var pole7 = $('#pole7').val();
                    var pole8 = $('#pole8').val();
                    var pole9 = $('#pole9').val();
                    if(pole1!='' & pole2!='' & pole3!='' & pole4!='' & pole5!='' & pole6!='' & pole7!='') {
                        $.ajax({
                            method: "POST",
                            url: "../func/insertworkers.php",
                            data: {
                                "pole1": pole1,
                                "pole2": pole2,
                                "pole3": pole3,
                                "pole4": pole4,
                                "pole5": pole5,
                                "pole6": pole6,
                                "pole6_2": pole6_2,
                                "pole6_3": pole6_3,
                                "pole6_4": pole6_4,
                                "pole7": pole7,
                                "pole8": pole8,
                                "pole9": pole9
                            },
                            success: function (response) {
                                $('#pole1').val('');
                                $('#pole2').val('');
                                $('#pole3').val('');
                                $('#pole4').val('');
                                $('#pole5').val('');
                                $('#pole7').val('');
                                $('#pole8').val('');
                                $('#pole9').val('');
                                $("#spisok").hide();
                                $('#content2').fadeIn(400).show();
                                $('#window_alert_true').text(response);
                                show_window_alert();
                                show();
                            }
                        });
                    } else {
                        $('#window_alert_true').text('Не все поля заполнены!');
                        show_window_alert()
                    }
                }
                function hidepoverka(){
                    $("#spisok").hide();
                }
                function showpoverka(){
                    $("#spisok").show();
                }
            </script>
        </div>
    </div>
    <div class="b-popup" id="spisok_objects" style="display: none;">
            <div class="b-popup-content" style="width: 300px; height: 180px;text-align: center;">
                <form style="width: 100%">

                    <input  name="pole1" id="pole1_objects" type="text" placeholder="Название">
                    <p></p>
                    <input  name="pole2" id="pole2_objects" type="text" placeholder="Короткое название">
                    <p></p>
                    <input  name="pole3" id="pole3_objects" type="text" placeholder="Адрес">
                    <p></p>

                    <ul id="spisocheksimochek_objects" class="listok bbb" style="display: none; width: 100%"></ul>
                    <a class="btn" href='javascript:;' onclick="poverka_objects();" id="dalee_objects" name="hello_objects">Добавить</a>
                    <a class="btn" href='javascript:;' onclick="hidepoverka_objects();" >Закрыть</a>
                </form>
                <script>

                    function poverka_objects(){
                        var pole1 = $('#pole1_objects').val();
                        var pole2 = $('#pole2_objects').val();
                        var pole3 = $('#pole3_objects').val();
                        if(pole1!='' & pole2!='' & pole3!='' ) {
                            $.ajax({
                                method: "POST",
                                url: "../func/insertobjects.php",
                                data: {
                                    "pole1": pole1,
                                    "pole2": pole2,
                                    "pole3": pole3,
                                },
                                success: function (response) {
                                    $('#pole1_objects').val('');
                                    $('#pole2_objects').val('');
                                    $('#pole3_objects').val('');
                                    $("#spisok_objects").hide();
                                    $('#content3').fadeIn(400).show();
                                    $('#window_alert_true').text(response);
                                    show_window_alert();
                                    show_objects();
                                }
                            });
                        } else {
                            $('#window_alert_true').text('Не все поля заполнены!');
                            show_window_alert()
                        }
                    }
                    function hidepoverka_objects(){
                        $("#spisok_objects").hide();
                    }
                    function showpoverka_objects(){
                        $("#spisok_objects").show();
                    }
                </script>

                <!--<button style="position: absolute;display: block;left: 592px;top: 10px;" class="close btn_orange" onclick="location.reload();spisokhide()"><i class="fa fa-times" aria-hidden="true"></i> Закрыт</button>-->
            </div>
        </div>
    <div class="b-popup" id="spisok_avans" style="display: none;">
        <div class="b-popup-content" style="width: 650px; height: 180px;text-align: center;">
            <form style="width: 100%">
                <select id="sel3" style="width: 600px; height: 26px"></select>
                <p></p>
                <input  name="pole2" id="pole2_avans" type="date" style="width: 600px; height: 26px" placeholder="Дата">
                <p></p>
                <input  name="pole3" id="pole3_avans" type="text" style="width: 600px; height: 26px" placeholder="Сумма">
                <p></p>
                <ul id="spisocheksimochek_avans" class="listok bbb" style="display: none; width: 100%"></ul>
                <a class="btn" href='javascript:;' onclick="poverka_avans();" id="dalee_avans" name="hello_avans">Добавить</a>
                <a class="btn" href='javascript:;' onclick="hidepoverka_avans();" >Закрыть</a>
            </form>

            <script>

                function poverka_avans(){
                    var pole11 = document.getElementById('sel3');
                    var pole1 = pole11.value;
                    var pole2 = $('#pole2_avans').val();
                    var pole3 = $('#pole3_avans').val();
                    if (pole1>0 & pole3>0) {
                        $.ajax({
                            method: "POST",
                            url: "../func/insertavans.php",
                            data: {
                                "pole1": pole1,
                                "pole2": pole2,
                                "pole3": pole3,
                            },
                            success: function (response) {
                                $('#pole2_avans').val('');
                                $('#pole3_avans').val('');
                                $("#spisok_avans").hide();
                                $('#content5').fadeIn(400).show();
                                show_avans();
                            }
                        });
                    } else {
                        $('#window_alert_true').text('Не все поля заполнены !');
                        show_window_alert()
                    }
                }
                function hidepoverka_avans(){
                    $("#spisok_avans").hide();
                }
                function showpoverka_avans(){
                    $("#spisok_avans").show();
                }
            </script>
        </div>
    </div>
    <div class="b-popup" id="spisok_avans_group" style="display: none;">
        <div class="b-popup-content" style="width: 600px; height: 600px;text-align: center;margin: auto">
            <form style="width: 100%">
                <div class=\"control-group\">
                    <p></p>
                    <table id='workers_object_avans' class='display' width='100%' cellspacing='0' border="1px">
                        <thead>
                        <tr>
                            <th>ФИО</th>
                            <th>Объект</th>
                            <th>Аванс</th>
                        </tr>
                        </thead>
                        <tbody id="block_avans_group" style='font-size: small'>
                        </tbody>
                    </table>

                </div>
                <p></p>
                <input  name="pole2_avans_group" id="pole2_avans_group" type="date" style="width: 500px; height: 27px" placeholder="Дата">
                <p></p>
                <ul id="spisocheksimochek_avans_group" class="listok bbb" style="display: none; width: 100%"></ul>
                <a class="btn" href='javascript:;' id="save_group_avans" onclick='save_group_avans($("#pole2_avans_group").val());hidepoverka_avans_group()'>Добавить</a>
                <a class="btn" href='javascript:;' onclick="hidepoverka_avans_group();" >Закрыть</a>
            </form>

            <script>

                function hidepoverka_avans_group(){
                    $("#spisok_avans_group").hide();
                }
                function showpoverka_avans_group(){
                    $("#spisok_avans_group").show();
                }
            </script>
        </div>
    </div>
    <div class="b-popup" id="edit_worker" style="display: none;">
        <div class="b-popup-content" style="width: 300px; height: auto;text-align: center;">

                <div id="sel_edit_worker" style="width: 100%">

                </div>

            <script>
                function poverka_worker_edit(id_edit){
                    var pole1 = $('#pole1_worker_edit').val();
                    var pole2 = $('#pole2_worker_edit').val();
                    var pole3 = $('#pole3_worker_edit').val();
                    var pole4 = $('#pole4_worker_edit').val();
                    var pole5 = $('#pole5_worker_edit').val();
                    var pole66 = document.getElementById('sel6');
                    var pole6 = pole66.value;
                    var pole66_2 = document.getElementById('sel6_2');
                    var pole6_2 = pole66_2.value;
                    var pole66_3 = document.getElementById('sel6_3');
                    var pole6_3 = pole66_3.value;
                    var pole66_4 = document.getElementById('sel6_4');
                    var pole6_4 = pole66_4.value;
                    var pole7 = $('#pole7_worker_edit').val();
                    var pole8 = $('#pole8_worker_edit').val();
                    var pole9 = $('#pole9_worker_edit').val();
                    var pole10 = id_edit;
                    if(pole1!='' & pole2!='' & pole3!='' & pole4!='' & pole5!='' & pole6!='' & pole7!='') {
                        $.ajax({
                            method: "POST",
                            url: "../func/updateworker.php",
                            data: {
                                "pole1": pole1,
                                "pole2": pole2,
                                "pole3": pole3,
                                "pole4": pole4,
                                "pole5": pole5,
                                "pole6": pole6,
                                "pole6_2": pole6_2,
                                "pole6_3": pole6_3,
                                "pole6_4": pole6_4,
                                "pole7": pole7,
                                "pole8": pole8,
                                "pole9": pole9,
                                "pole10": pole10,
                            },
                            success: function (response) {
                                $("#edit_worker").hide();
                                $('#content2').fadeIn(400).show();
                                show();
                            }
                        });
                    } else {
                        $('#window_alert_true').text('Не все поля заполнены!');
                        show_window_alert()
                    }
                }
                function hidepoverka_worker_edit() {
                    $("#edit_worker").hide();
                }
                function showpoverka_worker_edit(){
                    $("#edit_worker").show();
                }
            </script>
        </div>
    </div>
    <div class="b-popup" id="edit_avans" style="display: none;">
      <div class="b-popup-content" style="width: 650px; height: 180px;text-align: center;">
        <form style="width: 100%">
                <div id="sel_edit_avans" name="sel_edit_avans" style="width: 500px; height: 27px">
                </div>
        </form>
        <script>
            function poverka_avans_edit(id_edit){
                var pole11 = document.getElementById('sel5');
                var pole1 = pole11.value;
                var pole2 = $('#pole2_avans_edit').val();
                var pole3 = $('#pole3_avans_edit').val();
                var pole4 = id_edit;
                if(pole1!='') {
                    $.ajax({
                        method: "POST",
                        url: "../func/updateavans.php",
                        data: {
                            "pole1": pole1,
                            "pole2": pole2,
                            "pole3": pole3,
                            "pole4": pole4,
                        },
                        success: function (response) {
                            $("#edit_avans").hide();
                            $('#content5').fadeIn(400).show();
                            show_avans();
                        }
                    });
                } else {
                    $('#errmsg').text('Поле пустое')
                }
            }
            function hidepoverka_avans_edit() {
                $("#edit_avans").hide();
            }
            function showpoverka_avans_edit(){
                $("#edit_avans").show();
            }
        </script>
      </div>
    </div>
    <div class="b-popup" id="add_people_tabel" style="display: none;">
            <div class="b-popup-content" style="width: 400px; height: 110px;text-align: center;">
                <form style="width: 100%">
                    <div class=\"control-group\">
                        <select id="sel7" name="select7" style="width: 300px; height: 27px">
                        </select>
                    </div>
                    <p></p>
                    <a class="btn" href='javascript:;' onclick="adduser();hidepoverka_tabel_form()" id="dalee_avans" name="hello_avans">Добавить</a>
                    <a class="btn" href='javascript:;' onclick="hidepoverka_tabel_form();" >Закрыть</a>
                </form>
                <script>
                    function adduser() {
                        var pole1 = $('#sel2').val();
                        var pole2 = $('#sel_year').val();
                        var pole3 = $('#sel_month').val();
                        var pole4 = $('#sel7').val();
                        var pole5 = $('option:selected','#sel7').attr('for');
                        if (pole2 != 0) {
                            $.ajax({
                                method: "POST",
                                url: "../func/exist_people_in_tabel.php",
                                data: {
                                    "pole1": pole1,
                                    "pole2": pole2,
                                    "pole3": pole3,
                                    "pole4": pole4,
                                    "pole5": pole5
                                },
                                success:
                                    function (response) {
                                        console.log(response)
                                        $('#content4').fadeIn(400);
                                        $('#window_alert_true').text(response);
                                        show_window_alert();

                                        show_tabel(pole1, pole2, pole3);
                                    }
                            });
                        }
                        else {
                            $('#errmsg').text('Табеля не существует, создайте новый')
                        }

                    }
                    function hidepoverka_tabel_form(){
                        $("#add_people_tabel").hide();
                    }
                    function showpoverka_tabel_form(){
                        $("#add_people_tabel").show();
                    }
                </script>
            </div>
        </div>
    <div class="b-popup" id="window_alert" style="display: none;">
            <div class="b-popup-content" style="width: 430px; height: 100px;text-align: center;">
                <form style="width: 100%">
                    <div class=\"control-group\">
                        <span id="window_alert_true" style="width: 350px; height: 27px"></span>
                    </div>
                    <p></p>
                    <a class="btn" href='javascript:;' onclick="hide_window_alert();" >OK</a>
                </form>
                <script>
                    function hide_window_alert(){
                        $("#window_alert").hide();
                    }
                </script>
            </div>
        </div>
    <div class="b-popup" id="edit_object" style="display: none;">
        <div class="b-popup-content" style="width: 300px; height: 185px;text-align: center;">
            <form style="width: 100%">
                <div id="sel_edit_object" name="sel_edit_object">
                </div>
            </form>

            <script>
                function poverka_object_edit(id_edit){
                    var pole1 = $('#pole1_object_edit').val();
                    var pole2 = $('#pole2_object_edit').val();
                    var pole3 = $('#pole3_object_edit').val();
                    var pole4 = id_edit;
                    if(pole1!='') {
                        $.ajax({
                            method: "POST",
                            url: "../func/updateobject.php",
                            data: {
                                "pole1": pole1,
                                "pole2": pole2,
                                "pole3": pole3,
                                "pole4": pole4,
                            },
                            success: function (response) {
                                $("#edit_object").hide();
                                $('#content3').fadeIn(400).show();
                                show_objects();
                            }
                        });
                    } else {
                        $('#errmsg').text('Поле пустое')
                    }
                }
                function hidepoverka_object_edit() {
                    $("#edit_object").hide();
                }
                function showpoverka_object_edit(){
                    $("#edit_object").show();
                }
            </script>
        </div>
    </div>
    <script src="js/bootstrap.min.js"></script>

  </body>
    
</html>