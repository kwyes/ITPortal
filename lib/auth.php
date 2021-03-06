<?php

error_reporting(0);

require_once __DIR__.'/staff.php';
require_once __DIR__.'/http-errors.php';
require_once __DIR__.'/base-api.php';

class Auth extends BaseAPI {

    function __construct($settings) {
        parent::__construct($settings);
    }

    protected function onRun()
    {
        if($this->command == 'logout') {
            $this->logout();
        } else {
            $this->authenticate();
        }
    }

    private function authenticate() {
        $needAuth = false;
        $staffId = $this->getSess('staffId', null);
        if(!$staffId) {
            $staffId = $this->getStaffId();
            $needAuth = true;
        }
        $staffModel = new Staff($this->db, $staffId);
        $staff = $staffModel->getStaffById($staffId);
        if(!$staff) {
            throw new Unauthorized("Staff({$staffId}) not found.");
        }
        if($needAuth) {
            if($this->isProduction) {
                $roleBogs = $staff['roleBogs'];
                $authBogs = $staff['authBogs'];
                $roleSys = $staff['roleSys'];
                $FirstName = $staff['firstName'];
                $LastName = $staff['lastName'];
                if($roleSys !== '99' && $roleSys !== '10') {
                    throw new Unauthorized("Staff({$staffId}) not authorized.");
                }
                //need to ask someone wat authbogs is .
                $staffModel->updateAuth($staffId);
                $this->saveStaffInfo($staffId, $roleBogs,$FirstName,$LastName,$roleSys);
            } else {
                $roleBogs = $staff['roleBogs'];
                $this->saveStaffInfo($staffId, $roleBogs,$FirstName,$LastName,$roleSys);
            }
        }
        $this->redirect($this->adminPath);
    }

    private function logout() {
        $staffInfo = $this->loadStaffInfo();
        $cfid = $staffInfo['CFID'];
        $cftoken = $staffInfo['CFTOKEN'];
        $url = "{$this->returnUrl}"; // TODO: make url to return here ex)https://staff.bodwell.edu/main.cfm?cfid=zzz&cftoken=zzz
        session_destroy();
        $this->redirect($url);
    }

    private function getStaffId() {
        if($this->isProduction) {
            $auth = $this->getQs('teacher', null);
            if($auth) {
                return base64_decode(substr(substr($auth, 0, -7), 7));
            } else {
                return null;
            }
        } else {
            return $this->testStaffId;
        }
    }

    private function saveStaffInfo($staffId, $staffRole,$FirstName,$LastName,$roleSys) {
        $fullName = $FirstName.' '.$LastName;
        $time = time();
        $this->setSess('staffId', $staffId);
        $this->setSess('staffRole', $staffRole);
        $this->setSess('staffName', $fullName);
        $this->setSess('roleSys', $roleSys);
        $this->setSess('start_time', $time);
        $this->setSess('CFID', $this->getQs('CFID'));
        $this->setSess('CFTOKEN', $this->getQs('CFTOKEN'));
    }

    private function loadStaffInfo() {
        return array(
            'staffId' => $this->getSess('staffId'),
            'staffRole' => $this->getSess('staffRole'),
            'CFID' => $this->getSess('CFID'),
            'CFTOKEN' => $this->getSess('CFTOKEN'),
        );
    }

}
