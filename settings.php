<?php

const VERSION = '1.0.5';


function getEnvironmentSettings() {

    $version = VERSION;
    $hostName = $_SERVER['SERVER_NAME'];
    $scriptFileName = "";
    $adminScriptName = "";
    $returnUrl = "/";
    $backdoor = array(
        '45c0x:2|ch//',
    );

    switch($hostName) {
        case 'admin.bodwell.edu':
            return array(
                'env' => 'production',
                'debug' => false,
                'basePath' => '/SAS-IT/',
                'adminPath' => '/SAS-IT',
                'returnUrl' => $returnUrl,
                'script' => '',
                'adminScript' => '/SAS-IT/'.$adminScriptName,
                'apiPath' => "https://{$hostName}/SAS-IT/api/index.php",
                'adminApiPath' => "https://{$hostName}/SAS-IT/api/index.php",
                'pdo' => array(
                    'database' => '',
                    'dsn' => '',
                ),
                'smtp' => array(
                    'debug' => false,
                    'host' => 'smtp.sendgrid.net',
                    'port' => '587',
                    'secure' => 'TLS',
                    'auth' => true,
                    'username' => 'apikey',
                    'password' => '',
                ),
            );
        case 'itadmin.bodwell.edu':
            return array(
                'env' => 'production',
                'debug' => true,
                'basePath' => '/',
                'adminPath' => '/',
                'returnUrl' => $returnUrl,
                'script' => '',
                'type' => 'itadmin',
                'pdo' => array(
                    'database' => 'mssql',
                    'dsn' => '',
                ),
                'smtp' => array(
                    'debug' => true,
                    'host' => 'smtp.sendgrid.net',
                    'port' => '587',
                    'secure' => 'TLS',
                    'auth' => true,
                    'username' => 'apikey',
                    'password' => '',
                ),
            );
        case 'dev.bodwell.edu':
            return array(
                'env' => 'production',
                'debug' => true,
                'basePath' => './',
                'adminPath' => './',
                'returnUrl' => $returnUrl,
                'script' => '',
                'adminScript' => './'.$adminScriptName,
                'apiPath' => "https://{$hostName}/api/index.php",
                'adminApiPath' => "https://{$hostName}/api/index.php",
                'pdo' => array(
                    'database' => 'mssql',
                    'dsn' => '',
                ),
                'bypassAuth' => false,
                'smtp' => array(
                  'debug' => true,
                  'host' => 'smtp.office365.com',
                  'port' => '587',
                  'secure' => 'TLS',
                  'auth' => true,
                  'username' => 'helpdesk50@bodwell.edu',
                  'password' => '',
                ),
                'backdoor' => $backdoor,
            );
        case 'localhost':
        return array(
            'env' => 'production',
            'debug' => true,
            'basePath' => '/SAS-IT/',
            'adminPath' => '/SAS-IT',
            'returnUrl' => $returnUrl,
            'script' => '',
            'adminScript' => '/SAS-IT/'.$adminScriptName,
            'apiPath' => "https://{$hostName}/SAS-IT/api/index.php",
            'adminApiPath' => "https://{$hostName}/SAS-IT/api/index.php",
            'pdo' => array(
                'database' => 'mssql',
                'dsn' => '',
            ),
            'bypassAuth' => false,
            'smtp' => array(
              'debug' => false,
              'host' => 'bodwell-edu.mail.protection.outlook.com',
              'port' => '25',
              'secure' => 'TLS',
              'auth' => false,
              'username' => '',
              'password' => '',
            ),
            'backdoor' => $backdoor,
        );
        default:
            return array(
                'env' => 'development',
                'debug' => true,
                'basePath' => '/',
                'adminPath' => '/admin/',
                'returnUrl' => $returnUrl,
                'script' => '/assets/'.$scriptFileName,
                'adminScript' => '/assets/'.$adminScriptName,
                'apiPath' => "http://{$hostName}/api/index.php",
                'pdo' => array(
                    'database' => 'mysql',
                    'dsn' => 'mysql:host=localhost;dbname=bodwell',
                    'user' => 'root',
                    'pass' => 'root',
                ),
                'testing' => array(
                    'staffId' => 'F0123',
                    'staffRole' => '99',
                    'studentId' => '201500126',
                    'email' => 'dev.user201500126@student.bodwell.edu'.PHP_EOL,
                    'password' => '',
                ),
                'bypassAuth' => true,
                'smtp' => array(
                    'debug' => 0,
                    'host' => '',
                    'port' => '25',
                    'secure' => '',
                    'auth' => false,
                    'username' => '',
                    'password' => '',
                ),
            );
    }

}

$settings = getEnvironmentSettings();
