<?php
if(isset($_POST) && $_SERVER['REQUEST_METHOD'] == "POST"){
  @extract($_POST);
  if(isset($deviceId) && isset($category) && isset($type)) {
    include_once '../config/dbconnect.php';
		require_once '../config/ITAdminClass.php';
		$c = new ITAdminClass();
    if($category == 'BYOD'){
      $mob = $c->updateBYODDeviceInfo($deviceId, $type, $manufacturer, $model, $macAddress, $network, $usage, $remark);
    } else if($category == 'BHSD'){
      $mob = $c->updateBHSDDeviceInfo($deviceId, $bhsdNum, $manufacturer, $model, $macAddress, $network, $usage, $remark);
    } else if($category == 'LOANER'){
      $mob = $c->updateLOANERDeviceInfo($deviceId, $bhsdNum, $type, $manufacturer, $model, $network, $usage, $remark);
    }
    
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