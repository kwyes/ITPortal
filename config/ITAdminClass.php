<?php

session_start();

require_once 'sql.php';
require_once 'sendEmailClass.php';

class ITAdminClass extends DBController {
    function getSql($name) {
        global $_SQL;
        return $_SQL[$name];
    }

    public function staffall(){
      $query = $this->getSql('staff-list');
      $stmt = $this->db->prepare($query);
      if ($stmt->execute()) {
          $response = array();
          while ($row = $stmt->fetch()) {
            // $tmp = array();
            // $tmp[] = $row["FirstName"];
            // $tmp[] = $row["LastName"];
            // $tmp[] = $row["ExtNo"];
            // $tmp[] = $row["Phone1"];
            // $tmp[] = $row["PositionTitle"];
            // $tmp[] = $row["Department"];
            // $tmp[] = $row["FullPart"];
            // $tmp[] = $row["StaffID"];
            // $tmp[] = $row["JoinDate"];
            // $tmp[] = $row["Email3"];
            // $response[] =  $tmp;
            $response[] = $row;
         }
        //  $output = array(
        //    "data" => $response
        //  );
        //  return $output;
        return $response;
      } else {
          return NULL;
      }
      $stmt->close();

    }

    public function studentall(){
      $query = $this->getSql('student-list');
      $stmt = $this->db->prepare($query);
      if ($stmt->execute()) {
          $response = array();
          while ($row = $stmt->fetch()) {
            // $tmp = array();
            // $tmp[] = $row["StudentID"];
            // $tmp[] = $row["FirstName"];
            // $tmp[] = $row["LastName"];
            // $tmp[] = $row["EnglishName"];
            // $tmp[] = $row["SchoolEmail"];
            // $tmp[] = $row["ReportToSchoolDate"];
            // $tmp[] = $row["expectedterm"];
            // $response[] =  $tmp;
            $response[] = $row;
         }
        //  $output = array(
        //    "data" => $response
        //  );
        //  return $output;
        return $response;
      } else {
          return NULL;
      }
      $stmt->close();

    }

    public function deviceall(){
      $query = $this->getSql('device-list');
      $stmt = $this->db->prepare($query);
      if ($stmt->execute()) {
          while ($row = $stmt->fetch()) {
            $response[] =  $row;
         }
         return $response;
      } else {
          return NULL;
      }
      $stmt->close();
    }

    public function studentInfo($studentId){
      $query = $this->getSql('student-info');
      $stmt = $this->db->prepare($query);
      $stmt->bindParam(1, $studentId);

      if ($stmt->execute()) {
        while ($row = $stmt->fetch()) {
          $response[] = $row;
        }
        return $response;
      }else {
        return NULL;
      }
      $stmt->close();
    }

    public function deviceInfo($studentId){
      $query = $this->getSql('device-info');
      $stmt = $this->db->prepare($query);
      $stmt->bindParam(1, $studentId);

      if ($stmt->execute()) {
        while ($row = $stmt->fetch()) {
          $response[] = $row;
        }
        return $response;
      }else {
        return NULL;
      }
      $stmt->close();
    }

    public function getOneDevice($deviceId){
      $query = $this->getSql('get-one-device');
      $stmt = $this->db->prepare($query);
      $stmt->bindParam(1, $deviceId);

      if ($stmt->execute()) {
        while ($row = $stmt->fetch()) {
          $response[] = $row;
        }
        return $response;
      }else {
        return NULL;
      }
      $stmt->close();
    }

    public function updateBHSDDeviceInfo($deviceId, $bhsdNum, $manufacturer, $model, $macAddress, $network, $usage, $remark){
      $today = date("Y-m-d H:i:s");
      $ModifyUserID = $_SESSION['staffId'];
      // $ModifyUserID = 'F2178';
      $query = $this->getSql('update-BHSD');

      $stmt = $this->db->prepare($query);
      $stmt->bindValue(":DeviceId", $deviceId);
      $stmt->bindValue(":BHSDNum", $bhsdNum);
      $stmt->bindValue(":Manufacturer", $manufacturer);
      $stmt->bindValue(":Model", $model);
      $stmt->bindValue(":MacAddress", $macAddress);
      $stmt->bindValue(":Network", $network);
      $stmt->bindValue(":Usage", $usage);
      $stmt->bindValue(":Remark", $remark);
      $stmt->bindValue(":ModifyDate", $today);
      $stmt->bindValue(":ModifyUserID", $ModifyUserID);
      if ($stmt->execute()) {
       $response = array();
       $tmp = array();
       $tmp['result'] = 1;
       array_push($response, $tmp);
       return $response;
      } else {
          return NULL;
      }
      $stmt->close();
    }

    public function updateBYODDeviceInfo($deviceId, $type, $manufacturer, $model, $macAddress, $network, $usage, $remark){
      $today = date("Y-m-d H:i:s");
      $ModifyUserID = $_SESSION['staffId'];
      // $ModifyUserID = 'F2178';
      $query = $this->getSql('update-BYOD');

      $stmt = $this->db->prepare($query);
      $stmt->bindValue(":DeviceId", $deviceId);
      $stmt->bindValue(":DeviceType", $type);
      $stmt->bindValue(":Manufacturer", $manufacturer);
      $stmt->bindValue(":Model", $model);
      $stmt->bindValue(":MacAddress", $macAddress);
      $stmt->bindValue(":Network", $network);
      $stmt->bindValue(":Usage", $usage);
      $stmt->bindValue(":Remark", $remark);
      $stmt->bindValue(":ModifyDate", $today);
      $stmt->bindValue(":ModifyUserID", $ModifyUserID);
      if ($stmt->execute()) {
       $response = array();
       $tmp = array();
       $tmp['result'] = 1;
       array_push($response, $tmp);
       return $response;
      } else {
          return NULL;
      }
      $stmt->close();
    }

    public function updateLOANERDeviceInfo($deviceId, $bhsdNum, $type, $manufacturer, $model, $network, $usage, $remark){
      $today = date("Y-m-d H:i:s");
      $ModifyUserID = $_SESSION['staffId'];
      // $ModifyUserID = 'F2178';
      $query = $this->getSql('update-LOANER');

      $stmt = $this->db->prepare($query);
      $stmt->bindValue(":DeviceId", $deviceId);
      $stmt->bindValue(":BHSDNum", $bhsdNum);
      $stmt->bindValue(":DeviceType", $type);
      $stmt->bindValue(":Manufacturer", $manufacturer);
      $stmt->bindValue(":Model", $model);
      $stmt->bindValue(":Network", $network);
      $stmt->bindValue(":Usage", $usage);
      $stmt->bindValue(":Remark", $remark);
      $stmt->bindValue(":ModifyDate", $today);
      $stmt->bindValue(":ModifyUserID", $ModifyUserID);
      if ($stmt->execute()) {
       $response = array();
       $tmp = array();
       $tmp['result'] = 1;
       array_push($response, $tmp);
       return $response;
      } else {
          return NULL;
      }
      $stmt->close();
    }

    public function addDeviceInfo($studentId, $category, $bhsdNum, $type, $manufacturer, $model, $macAddress, $registerTo, $network, $usage, $remark){
      $today = date("Y-m-d H:i:s");
      $ModifyUserID = $_SESSION['staffId'];
      $CreateUserID = $_SESSION['staffId'];
      $query = $this->getSql('insert-device-info');
      $stmt = $this->db->prepare($query);

      $stmt->bindValue(":StudentID", $studentId);
      $stmt->bindValue(":DeviceCategory", $category);
      $stmt->bindValue(":DeviceType", $type);
      $stmt->bindValue(":Make", $manufacturer);
      $stmt->bindValue(":Model", $model);
      $stmt->bindValue(":MACAddress", $macAddress);
      $stmt->bindValue(":Network", $registerTo);
      $stmt->bindValue(":NetworkRegStatus", $network);
      $stmt->bindValue(":DeviceStatus", $usage);
      $stmt->bindValue(":BHSDNo", $bhsdNum);
      $stmt->bindValue(":Remarks", $remark);
      $stmt->bindValue(":ModifyUserID", $ModifyUserID);
      $stmt->bindValue(":CreateUserID", $CreateUserID);

      // $stmt->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      // $stmt->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);


      if ($stmt->execute()) {
       $response = array();
       $tmp = array();
       $tmp['result'] = 1;
       $tmp['today'] = date('Y-m-d');

       array_push($response, $tmp);
       return $response;
      } else {
          return NULL;
      }
      $stmt->close();
    }


    public function searchStudentByName($param){
      $query = $this->getSql('search-student');
      $stmt = $this->db->prepare($query);
      $param = addslashes($param);
      $param = '%'.$param.'%';
      $stmt->bindParam(1, $param, PDO::PARAM_STR);
      $stmt->bindParam(2, $param, PDO::PARAM_STR);
      $stmt->bindParam(3, $param, PDO::PARAM_STR);
      $stmt->bindParam(4, $param, PDO::PARAM_STR);

      if ($stmt->execute()) {
          while ($row = $stmt->fetch()) {
            $response[] = $row;
         }
         return $response;
      } else {
          return NULL;
      }
      $stmt->close();
    }

    public function searchStaff($param){
      $query = $this->getSql('search-staff');
      $stmt = $this->db->prepare($query);
      $param = addslashes($param);
      $param = '%'.$param.'%';
      $stmt->bindParam(1, $param, PDO::PARAM_STR);
      $stmt->bindParam(2, $param, PDO::PARAM_STR);

      if ($stmt->execute()) {
          while ($row = $stmt->fetch()) {
            $response[] = $row;
         }
         return $response;
      } else {
          return NULL;
      }
      $stmt->close();
    }

    public function numOfDevice(){
      $query = $this->getSql('num-of-students-by-status-and-reg');
      $stmt = $this->db->prepare($query);
      $response2 = $this->totalNumberOfDevice();
      $response3 = $this->totalNumberOfLoanerDevice();
      if ($stmt->execute()) {
          while ($row = $stmt->fetch()) {
            $response['sub'][] =  $row;
         }
         if(is_array($response3)){
          $final = array_merge($response,$response2,$response3);
         } else {
           $final = array_merge($response,$response2);
         }

         return $final;
      } else {
          return NULL;
      }
      $stmt->close();
    }

    function totalNumberOfDevice(){
      $query = $this->getSql('num-of-students-by-status');
      $stmt = $this->db->prepare($query);
      if ($stmt->execute()) {
          while ($row = $stmt->fetch()) {
            $response['total'][] =  $row;
         }
         return $response;
      } else {
          return NULL;
      }
      $stmt->close();
    }

    function totalNumberOfLoanerDevice(){
      $query = $this->getSql('num-of-loaner-device-by-status');
      $stmt = $this->db->prepare($query);

      if ($stmt->execute()) {
          while ($row = $stmt->fetch()) {
            $response['loaner'][] =  $row;
         }
         return $response;

      } else {
          return NULL;
      }
      $stmt->close();
    }

    public function staffUserCounts() {
      $query = $this->getSql('staff-user-counts');
      $stmt = $this->db->prepare($query);
      if ($stmt->execute()) {
          while ($row = $stmt->fetch()) {
            $response[] =  $row;
         }
         return $response;
      } else {
          return NULL;
      }
      $stmt->close();
    }

    public function currentterm(){
      $query = $this->getSql('term-list');
      $stmt = $this->db->prepare($query);
      if ($stmt->execute()) {
          $response = array();
          while ($row = $stmt->fetch()) {
            $tmp = array();
            $tmp["SemesterID"] = $row["SemesterID"];
            $_SESSION["SemesterID"] = $row["SemesterID"];
            $tmp["SemesterName"] = $row["SemesterName"];
            $_SESSION["SemesterName"] = $row["SemesterName"];
            $tmp["StartDate"] = $row["StartDate"];
            $_SESSION["StartDate"] = $row["StartDate"];
            $tmp["EndDate"] = $row["EndDate"];
            $tmp["MidCutOffDate"] = $row["MidCutOffDate"];
            $tmp["FExam1"] = $row["FExam1"];
            $tmp["FExam2"] = $row["FExam2"];
            $tmp["NextStartDate"] = $row["NextStartDate"];
            array_push($response, $tmp);
         }
         return $response;
      } else {
          return NULL;
      }
      $stmt->close();
    }

    public function currentPerson(){
      $query = $this->getSql('current-person');
      $stmt = $this->db->prepare($query);
      if ($stmt->execute()) {
          $response = array();
          while ($row = $stmt->fetch()) {
            $response[] = $row;
          }
         return $response;
      } else {
          return NULL;
      }
      $stmt->close();
    }

    public function counrOfDevice($studentId){
      $query = $this->getSql('count-device');
      $stmt = $this->db->prepare($query);
      $stmt->bindParam(1, $studentId);

      if ($stmt->execute()) {
          $response = array();
          $row = $stmt->fetch();
          $response[] = $row;
         return $response;
      } else {
          return NULL;
      }
      $stmt->close();
    }

    public function registerFilteredData($filteredData, $status){
      $today = date("Y-m-d H:i:s");
      $ModifyUserID = $_SESSION['staffId'];
      $query = $this->getSql('register-filtered-data');

      $query = str_replace('{Status}', $status, $query);
      $query = str_replace('{ModifyDate}', $today, $query);
      $query = str_replace('{ModifyUserID}', $ModifyUserID, $query);
      $query = str_replace('{DeviceID}', implode(',', $filteredData), $query);

      $stmt = $this->db->prepare($query);

      if ($stmt->execute()) {
        $response = array();
        $tmp = array();
        $tmp['result'] = 1;
        array_push($response, $tmp);
        return $response;
      } else {
          return NULL;
      }
      $stmt->close();
    }

    public function updateFilteredDeviceStatusData($filteredData, $status){
      $today = date("Y-m-d H:i:s");
      $ModifyUserID = $_SESSION['staffId'];
      $query = $this->getSql('update-filtered-device-status-data');

      $query = str_replace('{Status}', $status, $query);
      $query = str_replace('{ModifyDate}', $today, $query);
      $query = str_replace('{ModifyUserID}', $ModifyUserID, $query);
      $query = str_replace('{DeviceID}', implode(',', $filteredData), $query);

      $stmt = $this->db->prepare($query);

      if ($stmt->execute()) {
        $response = array();
        $tmp = array();
        $tmp['result'] = 1;
        array_push($response, $tmp);
        return $response;
      } else {
          return NULL;
      }
      $stmt->close();
    }


    public function CurrentStudentInfo(){
      // $query = "SELECT * FROM tblBHSStudent WHERE CurrentStudent = 'Y'";
      // $stmt = $this->db->prepare($query);
      // if ($stmt->execute()) {
      //   while ($row = $stmt->fetch()) {
      //     $response[] = $row;
      //   }
      //  return $response;
      // } else {
      //     return NULL;
      // }
      // $stmt->close();
    }

    public function getRequestResetEmailList() {
      $query = $this->getSql('request-reset-email');
      $stmt = $this->db->prepare($query);

      if ($stmt->execute()) {
          while ($row = $stmt->fetch()) {
            $response[] =  $row;
         }
         return $response;
      } else {
          return NULL;
      }
      $stmt->close();
    }

    public function getReturnBHSDevice() {
      $query = $this->getSql('return-device-list');
      $stmt = $this->db->prepare($query);

      if ($stmt->execute()) {
        $tmp = array();
          while ($row = $stmt->fetch()) {
            $response['FirstName'] = $row['FirstName'];
            $response['LastName'] = $row['LastName'];
            $response['EnglishName'] = $row['EnglishName'];
            $response['SchoolEmail'] = $row['SchoolEmail'];
            $response['Counselor'] = $row['Counselor'];
            $response['returnId'] = $row['returnId'];
            $response['StudentID'] = $row['StudentID'];
            $response['ReturnDevices'] = $row['ReturnDevices'];
            $response['ReturnOptions'] = $row['ReturnOptions'];
            $response['AuthDate'] = $row['AuthDate'];
            $response['AuthUser'] = $row['AuthUser'];
            $response['ReturnStatus'] = $row['ReturnStatus'];
            $response['BHSDID'] = $row['BHSDID'];
            $response['ServiceTag'] = $row['ServiceTag'];
            $response['rAssetLabels'] = $row['rAssetLabels'];
            $response['rTablet'] = $row['rTablet'];
            $response['rKeyboard'] = $row['rKeyboard'];
            $response['rPen'] = $row['rPen'];
            $response['rPower'] = $row['rPower'];

            $response['DeductCheck'] = $row['DeductCheck'];
            $response['DeductionAmount'] = $row['DeductionAmount'];
            $response['InspectionDate'] = $row['InspectionDate'];
            $response['ModifyDate'] = $row['ModifyDate'];
            $response['ModfiyUserID'] = $row['ModfiyUserID'];
            $response['CreateDate'] = $row['CreateDate'];
            $response['CreateUserID'] = $row['CreateUserID'];

            $response['InspectionResult'] = stripslashes($row['InspectionResult']);
            array_push($tmp, $response);
         }
         return $tmp;
      } else {
          return NULL;
      }
      $stmt->close();
    }

    public function getStaffEmailByName($counsellor) {
      $query = $this->getSql('find-staff-email-by-name');
      $stmt = $this->db->prepare($query);
      $stmt->bindParam(1, $counsellor);

      if ($stmt->execute()) {
          $row = $stmt->fetch();
          $response =  $row['Email3'];
         return $response;
      } else {
          return NULL;
      }
      $stmt->close();
    }


    public function updateReturnDevice($returnId, $ReturnStatus, $BHSDID, $ServiceTag, $rAssetLabels, $rTablet, $rKeyboard, $rPen, $rPower, $InspectionResult, $DeductCheck, $DeductionAmount, $InspectionDate, $OrgReturnStatus) {
      $today = date("Y-m-d H:i:s");
      $ModifyUserID = $_SESSION['staffId'];
      $query = $this->getSql('update-return-device-list');
      $InspectionResult = addslashes($InspectionResult);

      $InspectionResult = str_replace("'","''",$InspectionResult);

      $query = str_replace('{returnId}', $returnId, $query);
      $query = str_replace('{ReturnStatus}', $ReturnStatus, $query);
      $query = str_replace('{BHSDID}', $BHSDID, $query);
      $query = str_replace('{ServiceTag}', $ServiceTag, $query);
      $query = str_replace('{rAssetLabels}', $rAssetLabels, $query);
      $query = str_replace('{rTablet}', $rTablet, $query);
      $query = str_replace('{rKeyboard}', $rKeyboard, $query);
      $query = str_replace('{rPen}', $rPen, $query);
      $query = str_replace('{rPower}', $rPower, $query);
      $query = str_replace('{InspectionResult}', $InspectionResult, $query);
      $query = str_replace('{DeductCheck}', $DeductCheck, $query);
      $query = str_replace('{DeductionAmount}', $DeductionAmount, $query);
      $query = str_replace('{InspectionDate}', $InspectionDate, $query);
      $query = str_replace('{ModifyDate}', $today, $query);
      $query = str_replace('{ModifyUserID}', $ModifyUserID, $query);

      $stmt = $this->db->prepare($query);

      if ($stmt->execute()) {
        $response = array();
        $tmp = array();
        $tmp['result'] = 1;

        if($OrgReturnStatus !== $ReturnStatus && $ReturnStatus == 2) {
          $c = new ITAdminClass();
          $tmp['assetResult'] = $c->updateAssetMasterFromReturnDevice($BHSDID);
        }

        array_push($response, $tmp);
        return $response;
      } else {
          return NULL;
      }
      $stmt->close();

    }


    public function updateStaffInfo($StaffID, $Department, $Email, $MealTagID, $PositionTitle) {
      $query = $this->getSql('update-staff');
      $query = str_replace('{StaffID}', $StaffID, $query);
      $query = str_replace('{Department2}', $Department, $query);
      $query = str_replace('{Email3}', $Email, $query);
      $query = str_replace('{MealTagID}', $MealTagID, $query);
      $query = str_replace('{PositionTitle2}', $PositionTitle, $query);
      $stmt = $this->db->prepare($query);

      if ($stmt->execute()) {
        $response = array();
        $tmp = array();
        $tmp['result'] = 1;
        array_push($response, $tmp);
        return $response;
      } else {
          return NULL;
      }
      $stmt->close();

    }




    public function updateRequestStatus($resetId,$status, $pEmail, $sEmail, $requestDate, $fullName, $stuId, $hStatus, $comment, $counsellor, $city, $country) {
      $today = date("Y-m-d H:i:s");
      $ModifyUserID = $_SESSION['staffId'];
      $ModifyUserName = $_SESSION['staffName'];
      $query = $this->getSql('update-reset-email-request-status');
      $query = str_replace('{ResetID}', $resetId, $query);
      $query = str_replace('{StudentID}', $stuId, $query);
      $query = str_replace('{Status}', $status, $query);
      $query = str_replace('{Comment}', $comment, $query);
      $query = str_replace('{ModifyDate}', $today, $query);
      $query = str_replace('{ModifyUserID}', $ModifyUserID, $query);
      // return $query;
      $stmt = $this->db->prepare($query);
      $statusTxt = '';
      if($status == 0){
        $statusTxt = 'Pending';
      } elseif ($status == 1) {
        $statusTxt = 'Complete';
      } else {
        $statusTxt = 'Cancelled';
      }

      if ($stmt->execute()) {
       $response['result'] = 1;
       $response['today'] = date('Y-m-d');
       if($status !== $hStatus){
         $c = new ITAdminClass();
         $cEmail = $c->getStaffEmailByName($counsellor);
         $from = array('email' => 'helpdesk@bodwell.edu', 'name' => 'IT Helpdesk');
         $to = array(
             array('email' => "{$cEmail}", 'name' => "{$counsellor}")
         );
         $cc = array(
           array('email' => 'helpdesk@bodwell.edu', 'name' => 'IT Helpdesk')
         );
         $subject = 'Your school email password reset request has been completed.​';
         $body = <<<EOD
         <style media="screen">
           .table-mail{
             border-collapse: collapse;
             border:none;
             width:900px;
           }
           th, td {
             border-bottom: 1px solid #d2d2d2;
           }
           .table-mail tr td {
             padding:10px;
             font-size:14px;
           }
           .title{
             color:#30297E;
           }
           .tableTitle{
             font-weight: bold;
             color: #66615b;
             width: 300px;
           }
           .linkContainer{
             margin-top:10px;
           }
         </style>

         <div>
             <br />
             <br />
             <table class="table-mail" >
               <tr >
                 <td class="tableTitle">Full Name</td>
                 <td colspan="3" >{$fullName}</td>
               </tr>
               <tr>
                 <td class="tableTitle">Counsellor</td>
                 <td colspan="3" >{$counsellor}</td>
               </tr>
               <tr>
                 <td class="tableTitle">Current Country</td>
                 <td colspan="3" >{$country}</td>
               </tr>
               <tr>
                 <td class="tableTitle">Current City</td>
                 <td colspan="3" >{$city}</td>
               </tr>
               <tr>
                 <td class="tableTitle">Call request time</td>
                 <td colspan="3" >{$requestDate}</td>
               </tr>
               <tr>
                 <td class="tableTitle">Status</td>
                 <td colspan="3" >{$statusTxt}</td>
               </tr>
               <tr>
                 <td class="tableTitle">IT Comment</td>
                 <td colspan="3" >$comment</td>
               </tr>
             </table>
         </div>
         <div>
           <p>
           Last modified : {$today}
           </p>
           <p>
           Last modified by : {$ModifyUserName}
           </p>
         </div>
EOD;

         $res = sendEmail($from, $to, $cc, $subject, $body);
       }


       return $response;
      } else {
          return NULL;
      }
      $stmt->close();

    }

    public function InsertBHSLaptopReturnPlan($StudentID,$authDate,$authName,$deviceLists,$returnto) {

        $c = new ITAdminClass();
        $sID = $c->GetBHSLaptopReturnPlanByStudentID($StudentID);
        if($sID){
          return 'duplicate';
        } else {
          $query = $this->getSql('insert-bhs-return-plan');
          $query = str_replace('{StudentID}', $StudentID, $query);
          $query = str_replace('{ReturnDevices}', $deviceLists, $query);
          $query = str_replace('{ReturnOptions}', $returnto, $query);
          $query = str_replace('{AuthDate}', $authDate, $query);
          $query = str_replace('{AuthUser}', $authName, $query);
          $query = str_replace('{ModifyUserID}', $StudentID, $query);
          $query = str_replace('{CreateUserID}', $StudentID, $query);


          $stmt = $this->db->prepare($query);
          if ($stmt->execute()) {
             return 'success';
          } else {
              return NULL;
          }
          $stmt->close();
        }


    }

    public function GetBHSLaptopReturnPlanByStudentID($StudentID){
      $query = $this->getSql('search-bhs-return-plan');
      $stmt = $this->db->prepare($query);
      $stmt->bindParam(1, $StudentID);
      if ($stmt->execute()) {
          while ($row = $stmt->fetch()) {
            $response[] = $row;
         }
         return $response;
      } else {
          return NULL;
      }
      $stmt->close();
    }

    public function getassetmaster(){
      $query = $this->getSql('get-asset-master');
      $stmt = $this->db->prepare($query);
      if ($stmt->execute()) {
          while ($row = $stmt->fetch()) {
            $response[] = $row;
         }
         return $response;
      } else {
          return NULL;
      }
      $stmt->close();
    }

    public function serachPerson() {

    }

    public function updateAssetMaster($AssetID,$AssetRemark,$BHSDID,$BHSDYear,$DeviceStatus,$FullName,$Manufacturer,$Model,$Ownership,$PrevAssetRemark,$PrevDeviceStatus, $PrevStockStatus, $PrevUserID, $PrevUserRemark, $SerialNo, $StockStatus, $UserID, $UserRemark, $Username) {
      $query = $this->getSql('update-asset-master');
      $stmt = $this->db->prepare($query);
      $stmt->bindValue(":Manufacturer", $Manufacturer);
      $stmt->bindValue(":Model", $Model);
      $stmt->bindValue(":BHSDYear", $BHSDYear);
      $stmt->bindValue(":Ownership", $Ownership);
      $stmt->bindValue(":SerialNo", $SerialNo);
      $stmt->bindValue(":BHSDID", $BHSDID);
      $stmt->bindValue(":StockStatus", $StockStatus);
      $stmt->bindValue(":DeviceStatus", $DeviceStatus);
      $stmt->bindValue(":AssetRemark", $AssetRemark);
      $stmt->bindValue(":UserID", $UserID);
      $stmt->bindValue(":Username", $Username);
      $stmt->bindValue(":UserRemark", $UserRemark);
      $stmt->bindValue(":AssetID", $AssetID);

      $current = array("ss" => $StockStatus, 'ds' => $DeviceStatus
      , 'ar' => $AssetRemark, 'ur' => $UserRemark, 'ui' => $UserID
    );
      $prev = array("ss" => $PrevStockStatus, 'ds' => $PrevDeviceStatus
      , 'ar' => $PrevAssetRemark, 'ur' => $PrevUserRemark, 'ui' => $PrevUserID
    );
      $compare = array_diff($current, $prev);


      if ($stmt->execute()) {
        $response['result'] = 1;
        $response['diff'] = sizeof($compare);

        if(sizeof($compare) !== 0) {
          $c = new ITAdminClass();
          $cEmail = $c->insertAssetMasterHistory($AssetID,$AssetRemark,$DeviceStatus,$PrevAssetRemark,$PrevDeviceStatus, $PrevStockStatus, $PrevUserID, $PrevUserRemark, $StockStatus, $UserID, $UserRemark);
        }

         return $response;
      } else {
          return NULL;
      }
      $stmt->close();
    }

    public function insertAssetMasterHistory($AssetID,$AssetRemark,$DeviceStatus,$PrevAssetRemark,$PrevDeviceStatus, $PrevStockStatus, $PrevUserID, $PrevUserRemark, $StockStatus, $UserID, $UserRemark) {
      $CreateUserID = $_SESSION['staffId'];
      $query = $this->getSql('insert-asset-master-history');
      $stmt = $this->db->prepare($query);
      $stmt->bindValue(":AssetID", $AssetID);
      $stmt->bindValue(":StockStatus", $StockStatus);
      $stmt->bindValue(":PrevStockStatus", $PrevStockStatus);
      $stmt->bindValue(":DeviceStatus", $DeviceStatus);
      $stmt->bindValue(":PrevDeviceStatus", $PrevDeviceStatus);
      $stmt->bindValue(":AssetRemark", $AssetRemark);
      $stmt->bindValue(":PrevAssetRemark", $PrevAssetRemark);
      $stmt->bindValue(":UserRemark", $UserRemark);
      $stmt->bindValue(":PrevUserRemark", $PrevUserRemark);
      $stmt->bindValue(":UserID", $UserID);
      $stmt->bindValue(":PrevUserID", $PrevUserID);
      $stmt->bindValue(":CreateUserID", $CreateUserID);

      if ($stmt->execute()) {
        $response['result'] = 1;
         return $response;
      } else {
          return NULL;
      }
      $stmt->close();
    }

    public function getAssetMasterHistory($AssetID) {
      $query = $this->getSql('get-asset-master-history');
      $stmt = $this->db->prepare($query);
      $stmt->bindValue(":AssetID", $AssetID);

      if ($stmt->execute()) {
        while ($row = $stmt->fetch()) {
          $response[] = $row;
        }
        return $response;
      } else {
          return NULL;
      }
      $stmt->close();
    }

    public function updateAssetMasterFromReturnDevice($BHSDID) {
      $CreateUserID = $_SESSION['staffId'];
      $query = $this->getSql('update-asset-master-from-return-device');
      $StockStatus = '1_IN_IT242_OTS';
      $DeviceStatus = 'RFI';
      $stmt = $this->db->prepare($query);
      $stmt->bindValue(":BHSDID", $BHSDID);
      $stmt->bindValue(":StockStatus", $StockStatus);
      $stmt->bindValue(":DeviceStatus", $DeviceStatus);
      if ($stmt->execute()) {
        $response['result'] = 1;
         return $response;
      } else {
          return NULL;
      }
      $stmt->close();
    }


}
?>
