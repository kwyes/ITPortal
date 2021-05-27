<?php
error_reporting(E_ALL);
require_once __DIR__.'/settings.php';
global $settings;
include_once __DIR__."/config/setup.php";

require_once __DIR__.'/lib/is-authenticated.php';
  if(!IsAuthenticated()) {
      header("HTTP/1.0 401 Unauthorized");
      echo 'Unauthorized';
      exit();
  }


$layoutDir = "layout/";
$page = ($_GET['page']) ? $_GET['page'] : $_POST['page'];
$url = $_SERVER['REQUEST_URI'];

  include_once $layoutDir."header.html";
  include_once $layoutDir."sidebar.php";

	switch($page) {
		default : {
			include_once $layoutDir."main.html";
			break;
		}
    case "profile" : {
			include_once $layoutDir."profile.html";
			break;
		}
		case "dashboard" : {
			include_once $layoutDir."main.html";
			break;
		}
    case "student" : {
			include_once $layoutDir."student.html";
			break;
		}
		case "staff" : {
			include_once $layoutDir."staff.html";
			break;
		}
		case "device" : {
			include_once $layoutDir."device.php";
			break;
		}
    case "asset" : {
			include_once $layoutDir."asset.php";
			break;
		}
    case "currentStudent" : {
			include_once $layoutDir."currentStudentList.html";
			break;
		}
  	case "resetEmail" : {
  			include_once $layoutDir."resetEmailPassword.php";
  			break;
		}

    case "updateStaff" : {
  			include_once $layoutDir."updateStaff.php";
  			break;
		}

    case "returnDevice" : {
  			include_once $layoutDir."returnDevice.php";
  			break;
		}

    case "logout" : {
			include_once $layoutDir."logout.php";
			break;
		}
	}
	include_once $layoutDir."footer.html";
?>
