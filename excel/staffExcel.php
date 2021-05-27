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
$objPHPExcel->getActiveSheet()->setCellValue('A1','FirstName');
$objPHPExcel->getActiveSheet()->setCellValue('B1','LastName');
$objPHPExcel->getActiveSheet()->setCellValue('C1','Office Number');
$objPHPExcel->getActiveSheet()->setCellValue('D1','Phone Number');
$objPHPExcel->getActiveSheet()->setCellValue('E1','Position');
$objPHPExcel->getActiveSheet()->setCellValue('F1','Department');
$objPHPExcel->getActiveSheet()->setCellValue('G1','Category');
$objPHPExcel->getActiveSheet()->setCellValue('H1','StaffID');
$objPHPExcel->getActiveSheet()->setCellValue('I1','Join Date');
$objPHPExcel->getActiveSheet()->setCellValue('J1','Email');


$conn = new PDO("odbc:Driver={SQL Server};Server=10.0.0.108;Database=Bodwell;Uid=sa;Pwd=Yv9FrUpx0a;");
$result = array();
$sql = "SELECT		FirstName
									, LastName
									, ExtNo
									, Phone1
									, PositionTitle
									, CASE Department
										WHEN 1 THEN 'Administration'
										WHEN 2 THEN 'Teachers'
										WHEN 3 THEN 'Sat-E Instructor'
										WHEN 4 THEN 'Student Services'
										WHEN 5 THEN 'Boarding-FT'
										WHEN 6 THEN 'Boarding-PT'
										WHEN 7 THEN 'Support' END as Department
									, FullPart
									,	StaffID
									, CONVERT(char(10), JoinDate, 126) as JoinDate
									, Email3
								FROM
									tblStaff
								WHERE
									CurrentStaff = 'Y' and SchoolID = 'BHS'-- and Department in ('1','2','4','5','6')
								ORDER BY
									SchoolID asc
									, Department asc
									, PositionTitle asc
									, Email3 asc";
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
		$FirstName = $result[$i]['FirstName'];
		$LastName = $result[$i]['LastName'];
		$ExtNo = $result[$i]['ExtNo'];
		$Phone1 = $result[$i]['Phone1'];
		$PositionTitle = $result[$i]['PositionTitle'];
		$Department = $result[$i]['Department'];
		$FullPart = $result[$i]['FullPart'];
		$StaffID = $result[$i]['StaffID'];
		$JoinDate = $result[$i]['JoinDate'];
		$Email3 = $result[$i]['Email3'];

    $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue("A$j", $FirstName)
                ->setCellValue("B$j", $LastName)
								->setCellValue("C$j", $ExtNo)
								->setCellValue("D$j", $Phone1)
								->setCellValue("E$j", $PositionTitle)
								->setCellValue("F$j", $Department)
								->setCellValue("G$j", $FullPart)
								->setCellValue("H$j", $StaffID)
								->setCellValue("I$j", $JoinDate)
								->setCellValue("J$j", $Email3);
		$j++;

}


$objPHPExcel->getActiveSheet()->setTitle('Staff');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
















$date= date("Y-m-d");
$filename=$date."- Staff List";


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
