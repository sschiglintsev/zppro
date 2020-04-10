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


// Создаем объект класса PHPExcel
$xls = new PHPExcel();

// Устанавливаем индекс активного листа
$xls->setActiveSheetIndex(0);
// Получаем активный лист
$sheet = $xls->getActiveSheet();
// Подписываем лист
$sheet->setTitle('avans');

/* устанавливаем бордер ячейкам */
$styleArray = array(
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN
        )
    )
);
// Вставляем текст в ячейку A1
$sheet->setCellValue("A1", 'Аванс');
$sheet->getStyle('A1')->getFill()->setFillType(
    PHPExcel_Style_Fill::FILL_SOLID);
$sheet->getStyle('A1')->getFill()->getStartColor()->setRGB('FFFFFF');
// Выравнивание текста
$sheet->getStyle('A1')->getAlignment()->setHorizontal(
    PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

// Объединяем ячейки
$sheet->mergeCells('A1:E1');
// Вставляем текст в ячейку
$sheet->setCellValue("A3", 'Фамилия');
$sheet->getStyle('A3')->getFill()->setFillType(
    PHPExcel_Style_Fill::FILL_SOLID);
$sheet->getStyle('A3')->getFill()->getStartColor()->setRGB('EEEEEE');
$sheet->setCellValue("B3", 'Имя');
$sheet->getStyle('B3')->getFill()->setFillType(
    PHPExcel_Style_Fill::FILL_SOLID);
$sheet->getStyle('B3')->getFill()->getStartColor()->setRGB('EEEEEE');
$sheet->setCellValue("C3", 'Отчество');
$sheet->getStyle('C3')->getFill()->setFillType(
    PHPExcel_Style_Fill::FILL_SOLID);
$sheet->getStyle('C3')->getFill()->getStartColor()->setRGB('EEEEEE');
$sheet->setCellValue("D3", 'Дата');
$sheet->getStyle('D3')->getFill()->setFillType(
    PHPExcel_Style_Fill::FILL_SOLID);
$sheet->getStyle('D3')->getFill()->getStartColor()->setRGB('EEEEEE');
$sheet->setCellValue("E3", 'Сумма');
$sheet->getStyle('E3')->getFill()->setFillType(
    PHPExcel_Style_Fill::FILL_SOLID);
$sheet->getStyle('E3')->getFill()->getStartColor()->setRGB('EEEEEE');

$sheet->getColumnDimension('A')->setAutoSize(true);
$sheet->getColumnDimension('B')->setAutoSize(true);
$sheet->getColumnDimension('C')->setAutoSize(true);
$sheet->getColumnDimension('D')->setAutoSize(true);
$sheet->getColumnDimension('E')->setAutoSize(true);
// Объединяем ячейки
//$sheet->mergeCells('A1:H1');

// Выравнивание текста
$sheet->getStyle('A1')->getAlignment()->setHorizontal(
    PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$cols = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","AA","AB","AC","AD");
$maxC = count($cols);
$i=4;
$j=0;

$avans = $con->query("SELECT *,(SELECT surname FROM  workers WHERE id=avans.id_worker) AS surname,
(SELECT name FROM  workers WHERE id=avans.id_worker) AS name,(SELECT m_name FROM  workers WHERE id=avans.id_worker) AS m_name,
(SELECT name FROM  objects WHERE id=avans.id_object) AS object FROM avans ORDER BY id ASC");
while ($row = $avans->fetch_assoc()) {
    $sheet->setCellValue("$cols[$j]$i", $row['surname']);
    $j++;
    $sheet->setCellValue("$cols[$j]$i", $row['name']);
    $j++;
    $sheet->setCellValue("$cols[$j]$i", $row['m_name']);
    $j++;
    $sheet->setCellValue("$cols[$j]$i", $row['date']);
    $j++;
    $sheet->setCellValue("$cols[$j]$i", $row['sum']);
    $i++;
    $j++;
}
$i=$i-1;
$sheet->getStyle("A3:E$i")->applyFromArray($styleArray);


//$xls = new PHPExcel();
//$xls->getProperties()->setCreator("TS");
//    ->setLastModifiedBy("Maarten Balliauw")
//    ->setTitle("Office 2007 XLSX Test Document")
//    ->setSubject("Office 2007 XLSX Test Document")
//    ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
//    ->setKeywords("office 2007 openxml php")
//    ->setCategory("Test result file");

header('Content-Disposition: attachment;filename="avans.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($xls, 'Excel2007');
$objWriter->save('php://output');