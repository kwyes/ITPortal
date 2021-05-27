<?php
if(isset($_POST) && $_SERVER['REQUEST_METHOD'] == "POST"){
  @extract($_POST);
  if(isset($category) && isset($studentId) && isset($type)) {
    include_once '../config/dbconnect.php';
    require_once '../config/ITAdminClass.php';
		$c = new ITAdminClass();
    $mob = $c->addDeviceInfo($studentId, $category, $bhsdNum, $type, $manufacturer, $model, $macAddress, $registerTo, $network, $usage, $remark);
  		if ($mob != false) {
  			echo json_encode($mob);
  		} else {
  			echo json_encode(array('result' => '0'));
  		}
  } else {
    echo json_encode(array('result' => '0'));
  }
} else {
	echo 0;
	exit;
}
