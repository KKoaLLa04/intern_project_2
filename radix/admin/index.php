<?php
session_start();
ob_start();
require_once '../config.php';
// Library import
require_once '../includes/phpmailer/PHPMailer.php';
require_once '../includes/phpmailer/SMTP.php';
require_once '../includes/phpmailer/Exception.php';

require_once '../includes/connect.php';
require_once '../includes/database.php';
require_once '../includes/permalink.php';
require_once '../includes/functions.php';
require_once '../includes/session.php';


$module = _MODULE_DEFAULT_ADMIN;
$action = _ACTION_DEFAULT;

if (!empty($_GET['module'])) {
    if (is_string($_GET['module'])) {
        $module = $_GET['module'];
    }
}

if (!empty($_GET['action'])) {
    if (is_string($_GET['action'])) {
        $action = $_GET['action'];
    }
}

if (!empty($_POST['module'])) {
    if (is_string($_POST['module'])) {
        $module = $_POST['module'];
    }
}

if (!empty($_POST['action'])) {
    if (is_string($_POST['action'])) {
        $action = $_POST['action'];
    }
}

$path = _WEB_PATH_ROOT . '/admin/' . $module . '/' . $action . '.php';
if (file_exists($path)) {
    require_once $path;
} else {
    require_once _WEB_PATH_ROOT . '/admin/errors/404.php';
}
