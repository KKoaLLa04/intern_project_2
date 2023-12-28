<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function loadLayout($path, $data = [])
{
    if (!empty($path)) {
        require_once _WEB_PATH_TEMPLATE . '/layouts/' . $path;
    }
}


function layout($layoutName = 'header', $dir = '', $data = [])
{

    if (!empty($dir)) {
        $dir = '/' . $dir;
    }

    if (file_exists(_WEB_PATH_TEMPLATE . $dir . '/layouts/' . $layoutName . '.php')) {
        require_once _WEB_PATH_TEMPLATE . $dir . '/layouts/' . $layoutName . '.php';
    }
}

function sendMail($to, $subject, $content)
{
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'ndkdzvl@gmail.com';                     //SMTP username
        $mail->Password   = 'dchuzrbjuruftzrj';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('ndkdzvl@gmail.com', 'Duy Kien Dev');
        $mail->addAddress($to);     //Add a recipient
        //Content
        $mail->isHTML(true);                             //Set email format to HTML
        $mail->CharSet = 'UTF-8';
        $mail->Subject = $subject;
        $mail->Body    = $content;

        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        return $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}


// kiem tra phuong thuc
function isPost()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        return true;
    }
    return false;
}

function isGet()
{
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        return true;
    }

    return false;
}

function getBody($method = '')
{
    $bodyArr = [];

    if (empty($method)) {
        if (isGet()) {
            if (!empty($_GET)) {
                foreach ($_GET as $key => $value) {
                    $key = strip_tags($key);
                    if (is_array($value)) {
                        $bodyArr[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                    } else {
                        $bodyArr[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                    }
                }
            }
        }

        if (isPost()) {
            if (!empty($_POST)) {
                foreach ($_POST as $key => $value) {
                    $key = strip_tags($key);
                    if (is_array($value)) {
                        $bodyArr[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                    } else {
                        $bodyArr[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                    }
                }
            }
        }
    } else {
        if ($method == 'get') {
            if (!empty($_GET)) {
                foreach ($_GET as $key => $value) {
                    $key = strip_tags($key);
                    if (is_array($value)) {
                        $bodyArr[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                    } else {
                        $bodyArr[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                    }
                }
            }
        } elseif ($method == 'post') {
            if (!empty($_POST)) {
                foreach ($_POST as $key => $value) {
                    $key = strip_tags($key);
                    if (is_array($value)) {
                        $bodyArr[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                    } else {
                        $bodyArr[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                    }
                }
            }
        }
    }
    return $bodyArr;
}

// viet ham xu ly email
function isEmail($email)
{
    $checkEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
    return $checkEmail;
}

function isNumberInt($number, $range = [])
{
    /*
     * $range = ['min_range'=>1, 'max_range'=>20];
     *
     * */
    if (!empty($range)) {
        $options = ['options' => $range];
        $checkNumber = filter_var($number, FILTER_VALIDATE_INT, $options);
    } else {
        $checkNumber = filter_var($number, FILTER_VALIDATE_INT);
    }

    return $checkNumber;
}

//Kiểm tra số thực
function isNumberFloat($number, $range = [])
{
    /*
     * $range = ['min_range'=>1, 'max_range'=>20];
     *
     * */
    if (!empty($range)) {
        $options = ['options' => $range];
        $checkNumber = filter_var($number, FILTER_VALIDATE_FLOAT, $options);
    } else {
        $checkNumber = filter_var($number, FILTER_VALIDATE_FLOAT);
    }

    return $checkNumber;
}

function isPhone($phone)
{
    $pattern = '/^0[0-9]{9}$/';
    if (preg_match($pattern, $phone)) {
        return true;
    }

    return false;
}

function getMsg($msg, $msgType = 'danger')
{
    if (!empty($msg)) {
        echo '<div class="alert alert-' . $msgType . '">';
        echo $msg;
        echo '</div>';
    }
}

function redirect($path = 'index.php')
{
    header("Location: $path");
    exit;
}

function oldData($fieldName, $oldData, $default = null)
{
    return !empty($oldData[$fieldName]) ? $oldData[$fieldName] : $default;
}

function errorData($fieldName, $errorArr)
{
    return !empty($errorArr[$fieldName]) ? $errorArr[$fieldName] : false;
}

function isLogin()
{
    $checkLogin = false;
    if (!empty(getSession('loginToken'))) {
        $loginToken = getSession('loginToken');
        $tokenQuery = firstRaw("SELECT user_id FROM login_token WHERE token='$loginToken'");
        if (!empty($tokenQuery)) {
            $checkLogin = $tokenQuery;
        } else {
            removeSession('loginToken');
        }
    } else {
        removeSession('loginToken');
    }

    return $checkLogin;
}


function autoRemoveTokenLogin()
{
    $allUserNum = getRaw("SELECT * FROM users WHERE status = 1");

    if (!empty($allUserNum)) {
        foreach ($allUserNum as $user) {
            $now = date('Y-m-d H:i:s');
            $beforeTime = $user['last_activity'];
            $diff = strtotime($now) - strtotime($beforeTime) . '<br/>';
            $diff = intval($diff);
            $diff = ($diff / 60);
            if ($diff > 1) {
                delete('login_token', 'user_id=' . $user['id']);
            }
        }
    }
}

function saveActivity()
{
    $user_id = isLogin()['user_id'];
    update('users', ['last_activity' => date('Y-m-d H:i:s')], 'id=' . $user_id);
}

function getUserInfor($user_id)
{
    $userInfor = firstRaw("SELECT * FROM users WHERE id=$user_id");
    return $userInfor;
}

function activeMenuSidebar($module)
{
    if (!empty(getBody()['module'])) {
        if (getBody()['module'] == $module) {
            return true;
        }
    }

    return false;
}

// getLinkAdmin
function getLinkAdmin($module, $action = '', $params = [])
{
    $url = _WEB_HOST_ROOT_ADMIN;
    $url .= '?module=' . $module;
    if (!empty($action)) {
        $url .= '&action=' . $action;
    }

    if (!empty($params)) {
        $params = http_build_query($params);
        $url .= '&' . $params;
    }

    return $url;
}

function getDateFormat($date, $format)
{
    $dateObject = date_create($date);
    if (!empty($dateObject)) {
        return $dateObject->format($format);
    }

    return false;
}


// check icon
function isFontIcon($input)
{

    if (strpos($input, '<i class="') !== false) {
        return true;
    }

    return false;
}


function getLinkQueryString($queryString, $key, $value)
{
    $queryArr = explode('&', $queryString);
    $queryArr = array_filter($queryArr);

    $queryFinal = '';

    if (!empty($queryArr)) {
        foreach ($queryArr as $item) {
            $itemArr = explode('=', $item);
            if (!empty($itemArr)) {
                if ($itemArr[0] == $key) {
                    $itemArr[1] = $value;
                }

                $item = implode('=', $itemArr);

                $queryFinal .= $item . '&';
            }
        }
    }

    if (!empty($queryFinal)) {
        $queryFinal = rtrim($queryFinal, '&');
    } else {
        $queryFinal = $queryString;
    }

    return $queryFinal;
}


function getPathAdmin()
{
    // $path = 'admin';
    if (!empty($_SERVER['QUERY_STRING'])) {
        $path = '?' . trim($_SERVER['QUERY_STRING']);
    }

    return $path;
}

function getOption($key, $type = '')
{
    $sql = "SELECT * FROM options WHERE otp_key='$key'";
    $dataOption = firstRaw($sql);
    if (!empty($dataOption)) {
        if ($type == 'label') {
            return $dataOption['name'];
        }

        return $dataOption['value'];
    }

    return false;
}


function updateOption($data = [])
{
    if (isPost()) {
        $allFields = getBody();
        $countFields = 0;

        if (!empty($data)) {
            $keyDataArr = array_keys($data);
            $valueDataArr = array_values($data);
            foreach ($keyDataArr as $key => $value) {
                $allFields[$value] = $valueDataArr[$key];
            }
        }

        if (!empty($allFields)) {
            foreach ($allFields as $fields => $value) {

                $condition = "otp_key='$fields'";

                $dataUpdate = [
                    'value' => trim($value)
                ];

                $updateStatus = update('options', $dataUpdate, $condition);
                if (!empty($updateStatus)) {
                    $countFields++;
                }
            }
        }

        if ($countFields > 0) {
            setFlashData('msg', 'Bạn đã cập nhật ' . $countFields . ' bản ghi thành công');
            setFlashData('msg_type', 'success');
        } else {
            setFlashData('msg', 'Cập nhật không thành công!');
            setFlashData('msg_type', 'danger');
        }

        redirect(getPathAdmin());
    }
}


function getCountContact()
{
    $sql = "SELECT id FROM contacts WHERE status=0";
    $count = getRows($sql);

    return $count;
}

function loadError($name = '404')
{
    $path = _WEB_PATH_ROOT . '/modules/error/' . $name . '.php';
    require_once $path;
    die();
}

function getVideoId($url)
{
    $result = [];
    $urlStr = parse_url($url, PHP_URL_QUERY);
    parse_str($urlStr, $result);

    if (!empty($result['v'])) {
        return $result['v'];
    }

    return false;
}
