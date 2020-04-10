<?PHP
session_start();
//mb_internal_encoding("UTF-8");
// "../db_workers.php";
define('DB_USER', "zpproru_tts"); //логин админа БД
define('DB_PASSWORD', "Sockromant7"); // пароль админа БД
define('DB_DATABASE', "zpproru_tts"); // база данных
define('DB_SERVER', "localhost"); // сервер 'localhost'
$con = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
$con->set_charset('utf8');
// Подключаем класс для работы с excel
require_once('../classes/PHPExcel.php');

$pole1 = $_POST['select12'];
$pole2 = $_POST['select_year_zp_worker'];
$pole3 = $_POST['select_month_zp_worker'];
// Создаем объект класса PHPExcel
$xls = new PHPExcel();

// Устанавливаем индекс активного листа
$xls->setActiveSheetIndex(0);
// Получаем активный лист
$sheet = $xls->getActiveSheet();
// Подписываем лист
$sheet->setTitle('Зарплата');

// устанавливаем бордер ячейкам
$styleArray = array(
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN
        )
    )
);
$BStyle = array(
    'borders' => array(
        'outline' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN
        )
    )
);
$m='';
switch ($pole3) {
    case '01': $m='январь'; break;
    case '02': $m='февраль'; break;
    case '03': $m='март'; break;
    case '04': $m='апрель'; break;
    case '05': $m='май'; break;
    case '06': $m='июнь'; break;
    case '07': $m='июль'; break;
    case '08': $m='август'; break;
    case '09': $m='сентябрь'; break;
    case 10: $m='октябрь'; break;
    case 11: $m='ноябрь'; break;
    case 12: $m='декабрь'; break;
}
$sheet->getColumnDimension('A')->setAutoSize(true);
$sheet->getColumnDimension('B')->setAutoSize(true);
$sheet->getColumnDimension('C')->setAutoSize(true);
$sheet->getColumnDimension('D')->setAutoSize(true);
$sheet->getColumnDimension('E')->setAutoSize(true);
$sheet->getColumnDimension('F')->setAutoSize(true);
$sheet->getColumnDimension('G')->setAutoSize(true);
$sheet->getColumnDimension('H')->setAutoSize(true);
$sheet->getColumnDimension('I')->setAutoSize(true);
$sheet->getColumnDimension('J')->setAutoSize(true);
$sheet->getColumnDimension('K')->setAutoSize(true);
$sheet->getColumnDimension('L')->setAutoSize(true);
$sheet->getColumnDimension('M')->setAutoSize(true);
$sheet->getColumnDimension('N')->setAutoSize(true);

$cols = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","AA","AB","AC","AD");
$maxC = count($cols);
$i=2;
$j=1;
$ii=0;
$sheet->setCellValue("A1", '      ');
$sheet->setCellValue("G1", '      ');
$zarplata = $con->query("SELECT *,(SELECT surname FROM  workers WHERE id=zarplata.id_worker) AS surname,
(SELECT `name` FROM  workers WHERE id=zarplata.id_worker) AS name,(SELECT m_name FROM  workers WHERE id=zarplata.id_worker) AS m_name,
(SELECT `name` FROM  objects WHERE id=zarplata.id_object) AS name_object FROM zarplata WHERE id_object = '$pole1' AND year = '$pole2' AND month = '$pole3' ORDER BY id ASC");
while ($row = $zarplata->fetch_assoc()) {
    $a=$row['surname'].' '.$row['name'].' '.$row['m_name'];
    $sheet->setCellValue("$cols[$j]$i", $a);
    $sheet->getStyle("$cols[$j]$i")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
    $sheet->getStyle("$cols[$j]$i")->getFill()->getStartColor()->setRGB('EEEEEE');
    $j++;
    $j++;
    $sheet->setCellValue("$cols[$j]$i", 'Отработанно часов');
    $j++;
    $sheet->setCellValue("$cols[$j]$i", 'Оклад');
    $j++;
    $sheet->setCellValue("$cols[$j]$i", 'Оклад в час');
    $j=1;
    $i++;
    $sheet->setCellValue("$cols[$j]$i", "Расчет за $m");
    $j++;
    $j++;
    $sheet->setCellValue("$cols[$j]$i", $row['hour_all']);
    $j++;
    $sheet->setCellValue("$cols[$j]$i",$row['salary_in_day']);
    $j++;
    $sheet->setCellValue("$cols[$j]$i", $row['salary_in_hour']);
    $j=1;
    $i++;
    $i++;
    $sheet->setCellValue("$cols[$j]$i", 'Сумма за декабрь');
    $j++;
    $sheet->setCellValue("$cols[$j]$i", $row['sum']);
    $j=1;
    $i++;
    $sheet->setCellValue("$cols[$j]$i", 'Остаток за прошлый месяц');
    $j++;
    $sheet->setCellValue("$cols[$j]$i", $row['ostatok_early']);
    $j=1;
    $i++;
    $sheet->setCellValue("$cols[$j]$i", 'Сумма штрафов');
    $j++;
    $sheet->setCellValue("$cols[$j]$i",  $row['fine']);
    $j=1;
    $i++;
    $sheet->setCellValue("$cols[$j]$i", 'Аванс');
    $j++;
    $sheet->setCellValue("$cols[$j]$i",  $row['avans']);
    $j=1;
    $i++;
    $sheet->setCellValue("$cols[$j]$i", 'Итого сумма');
    $j++;
    $sheet->setCellValue("$cols[$j]$i",  $row['payment']);
    $j=1;
    $i++;
    $i++;
    $sheet->setCellValue("$cols[$j]$i", 'Выданная сумма');
    $j++;
    $sheet->setCellValue("$cols[$j]$i",  'Дата');
    $j++;
    $sheet->setCellValue("$cols[$j]$i",  'Подпись');
    $j=1;
    $i++;
    $ii=$i-10;
    $iii=$i-9;
    $iiii=$i-7;
    $iiiii=$i-3;
    $iiiiii=$i-1;
    $sheet->getStyle("B$ii")->applyFromArray($styleArray);
    $sheet->getStyle("D$ii:F$iii")->applyFromArray($styleArray);
    $sheet->getStyle("B$iiii:C$iiiii")->applyFromArray($styleArray);
    $sheet->getStyle("B$iiiiii:D$i")->applyFromArray($styleArray);
    $sheet->getStyle("B$ii:G$i")->applyFromArray($BStyle);
    $i++;
    $i++;
    $a=$row['surname'].' '.$row['name'].' '.$row['m_name'];
    $sheet->setCellValue("$cols[$j]$i", $a);
    $sheet->getStyle("$cols[$j]$i")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
    $sheet->getStyle("$cols[$j]$i")->getFill()->getStartColor()->setRGB('EEEEEE');
    $j++;
    $j++;
    $sheet->setCellValue("$cols[$j]$i", 'Отработанно часов');
    $j++;
    $sheet->setCellValue("$cols[$j]$i", 'Оклад');
    $j++;
    $sheet->setCellValue("$cols[$j]$i", 'Оклад в час');
    $j=1;
    $i++;
    $sheet->setCellValue("$cols[$j]$i", "Расчет за $m");
    $j++;
    $j++;
    $sheet->setCellValue("$cols[$j]$i", $row['hour_all']);
    $j++;
    $sheet->setCellValue("$cols[$j]$i",$row['salary_in_day']);
    $j++;
    $sheet->setCellValue("$cols[$j]$i", $row['salary_in_hour']);
    $j=1;
    $i++;
    $i++;
    $sheet->setCellValue("$cols[$j]$i", 'Сумма за декабрь');
    $j++;
    $sheet->setCellValue("$cols[$j]$i", $row['sum']);
    $j=1;
    $i++;
    $sheet->setCellValue("$cols[$j]$i", 'Остаток за прошлый месяц');
    $j++;
    $sheet->setCellValue("$cols[$j]$i", $row['ostatok_early']);
    $j=1;
    $i++;
    $sheet->setCellValue("$cols[$j]$i", 'Сумма штрафов');
    $j++;
    $sheet->setCellValue("$cols[$j]$i",  $row['fine']);
    $j=1;
    $i++;
    $sheet->setCellValue("$cols[$j]$i", 'Аванс');
    $j++;
    $sheet->setCellValue("$cols[$j]$i",  $row['avans']);
    $j=1;
    $i++;
    $sheet->setCellValue("$cols[$j]$i", 'Итого сумма');
    $j++;
    $sheet->setCellValue("$cols[$j]$i",  $row['payment']);
    $j=1;
    $i++;
    $i++;
    $sheet->setCellValue("$cols[$j]$i", 'Выданная сумма');
    $j++;
    $sheet->setCellValue("$cols[$j]$i",  'Дата');
    $j++;
    $sheet->setCellValue("$cols[$j]$i",  'Подпись');
    $j=1;
    $i++;
    $ii=$i-10;
    $iii=$i-9;
    $iiii=$i-7;
    $iiiii=$i-3;
    $iiiiii=$i-1;
    $sheet->getStyle("B$ii")->applyFromArray($styleArray);
    $sheet->getStyle("D$ii:F$iii")->applyFromArray($styleArray);
    $sheet->getStyle("B$iiii:C$iiiii")->applyFromArray($styleArray);
    $sheet->getStyle("B$iiiiii:D$i")->applyFromArray($styleArray);
    $sheet->getStyle("B$ii:G$i")->applyFromArray($BStyle);
    $i++;
    $i++;



}
$i=$i-1;

header('Content-Disposition: attachment;filename="zarplata.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($xls, 'Excel2007');
$objWriter->save('php://output');

