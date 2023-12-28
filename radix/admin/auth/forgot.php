<?php

$data = [
    'pageTitle' => 'Đặt lại mật khẩu',
];
loadLayout('header_login.php', $data);

// Chặn quay trở lại đăng nhập
if (!empty(getSession('loginToken'))) {
    $loginToken = getSession('loginToken');
    $tokenQuery = firstRaw("SELECT user_id FROM login_token WHERE token='$loginToken'");
    if (!empty($tokenQuery)) {
        redirect('?module=users');
    } else {
        removeSession('loginToken');
    }
} else {
    removeSession('loginToken');
}

if (isPost()) {

    $body = getBody();

    if (!empty($body['username'])) {

        $email = trim($body['username']);
        $queryUser = firstRaw("SELECT id, fullname, email FROM users WHERE email='$email'");

        if (!empty($queryUser)) {
            $user_id = $queryUser['id'];

            // Update dữ liệu
            $forgot_token = sha1(uniqid() . time());
            $dataUpdate = [
                'forgot_token' => $forgot_token,
                'update_at' => date('Y/m/d H:i:s')
            ];

            $updateStatus = update('users', $dataUpdate, "id=$user_id");
            if ($updateStatus) {

                // Tạo link reset
                $resetLink = _WEB_HOST_ROOT_ADMIN . '?module=auth&action=reset&token=' . $forgot_token;

                $subject = 'Yêu cầu khôi phục mật khẩu';
                $content = 'Chào bạn ' . $queryUser['fullname'] . ' <br/>';
                $content .= 'Chúng tôi nhận được yêu cầu khôi phục mật khẩu từ bạn. Vui lòng click vào link sau để đổi lại mật khẩu mới <Br/>';
                $content .= $resetLink . '<br/>';
                $content .= 'Trân trọng';

                $sendMailStatus = sendMail("$email", $subject, $content);
                if ($sendMailStatus) {
                    setFlashData('msg', 'Vui lòng vào email để xem hướng dẫn thay đổi mật khẩu');
                    setFlashData('msg_type', 'success');
                } else {
                    setFlashData('msg', 'Lỗi hệ thống! Vui lòng thử lại sau');
                    setFlashData('msg_type', 'danger');
                }
            } else {
                setFlashData('msg', 'Lỗi hệ thống! Vui lòng thử lại sau');
                setFlashData('msg_type', 'danger');
            }
        } else {
            setFlashData('msg', 'Email không tồn tại trong hệ thống');
            setFlashData('msg_type', 'danger');
        }
    } else {
        setFlashData('msg', 'Vui lòng nhập địa chỉ email');
        setFlashData('msg_type', 'danger');
    }

    redirect('?module=auth&action=forgot');
}


$msg = getFlashData('msg');
$msg_type = getFlashData('msg_type');
?>

<div class="container" style="margin: 0 auto; max-width: 900px;">
    <form action="" method="post">
        <h3 class="text-center my-4">Đặt lại mật khẩu</h3>
        <?php
        getMsg($msg, $msg_type);
        ?>
        <div class="form-group">
            <label for="">Email</label>
            <input type="text" placeholder="Nhập email của bạn..." name="username" class="form-control">
            <p></p>
        </div>

        <button class="btn btn-primary form-control">Xác nhận</button>
    </form>
    <br>
    <p class="text-center"><a href="?module=auth&action=login">Đăng nhập</a></p>
</div>

<?php
loadLayout('footer_login.php', $data);