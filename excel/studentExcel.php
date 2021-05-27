<?php



error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

/** Include PHPExcel */
require_once '../PHPExcel/Classes/PHPExcel.php';


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('A1','StudentID');
$objPHPExcel->getActiveSheet()->setCellValue('B1','First Name');
$objPHPExcel->getActiveSheet()->setCellValue('C1','Last Name');
$objPHPExcel->getActiveSheet()->setCellValue('D1','English Name');
$objPHPExcel->getActiveSheet()->setCellValue('E1','Email');
$objPHPExcel->getActiveSheet()->setCellValue('F1','Start Date');
$objPHPExcel->getActiveSheet()->setCellValue('G1','Expected Grad Term');


$conn = new PDO("odbc:Driver={SQL Server};Server=10.0.0.108;Database=Bodwell;Uid=sa;Pwd=Yv9FrUpx0a;");
$result = array();
$sql = "SELECT s.StudentID,
										FirstName,
										LastName,
										EnglishName,
										SchoolEmail,
										CONVERT(char(10), ReportToSchoolDate, 126) as ReportToSchoolDate,
										i.expectedterm
										FROM [Bodwell].[dbo].[tblBHSStudent] as s
										LEFT Join tblBHSStudentInfo as i on s.StudentID = i.StudentID
										WHERE SchoolID = 'BHS' AND CurrentStudent = 'Y'";
$stmt = $conn->prepare($sql);

$stmt->execute();

while ($row = $stmt->fetch()) {
	$result[] = $row;
}
// print_r($result);
// exit;
$rowCount = 2;

// foreach($result as $key => $values)
// {
// 	 $column = 'A';
// 	 foreach($values as $value)
// 	 {
// 		 $objPHPExcel->getActiveSheet()->setCellValue($column.$rowCount, $value);
// 		 $column++;
// 	 }
//
// 	 $rowCount++;
// }

$j = 2;
for ($i=0; $i < sizeof($result); $i++)
{
    // Add some data
		$StudentID = $result[$i]['StudentID'];
		$FirstName = $result[$i]['FirstName'];
		$LastName = $result[$i]['LastName'];
		$EnglishName = $result[$i]['EnglishName'];
		$SchoolEmail = $result[$i]['SchoolEmail'];
		$ReportToSchoolDate = $result[$i]['ReportToSchoolDate'];
		$expectedterm = $result[$i]['expectedterm'];

    $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue("A$j", $StudentID)
                ->setCellValue("B$j", $FirstName)
								->setCellValue("C$j", $LastName)
								->setCellValue("D$j", $EnglishName)
								->setCellValue("E$j", $SchoolEmail)
								->setCellValue("F$j", $ReportToSchoolDate)
								->setCellValue("G$j", $expectedterm);
		$j++;

}


$objPHPExcel->getActiveSheet()->setTitle('Student');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
















$date= date("Y-m-d");
$filename=$date."- Student List";


header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
