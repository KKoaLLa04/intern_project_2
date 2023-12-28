<?php
loadLayout('header_login.php');
if (!empty(getBody()['token'])) {
    $token = getBody()['token'];
}

echo '<div class="container text-center"><br/>';
if (!empty($token)) {
    $tokenQuery = firstRaw("SELECT id,fullname, email FROM users WHERE forgot_token='$token'");
    $userId = $tokenQuery['id'];

    if (!empty($tokenQuery)) {
        if (isPost()) {
            $body = getBody();

            $errors = [];

            // validate password
            if (empty(trim($body['password']))) {
                $errors['password'] = 'Mật khẩu không được để trống';
            } else {
                if (strlen(trim($body['password'])) < 6) {
                    $errors['password'] = 'Mật khẩu phải lớn hơn 6 ký tự';
                }
            }

            // validate confirm_password
            if (empty(trim($body['confirm_password']))) {
                $errors['confirm_password'] = 'Xác nhận mật khẩu không được để trống';
            } else {
                if (trim($body['confirm_password']) !== trim($body['password'])) {
                    $errors['confirm_password'] = 'Xác nhận mật khẩu không trùng khớp với mật khẩu bạn nhập';
                }
            }

            if (empty($errors)) {
                // Khong co loi xay ra
                $passwordHash = password_hash(trim($body['password']), PASSWORD_DEFAULT);
                $dataUpdate = [
                    'password' => $passwordHash,
                    'forgot_token' => null,
                    'update_at' => date('Y/m/d H:i:s')
                ];

                $updateStatus = update('users', $dataUpdate, "id=$userId");
                if (!empty($updateStatus)) {

                    $subject = 'Thay đổi mật khẩu thành công';
                    $content = 'Chào bạn ' . $tokenQuery['fullname'] . '<br/>';
                    $content .= 'Chúc mừng bạn thay đổi mật khẩu thành công, Nếu không phải bạn. Vui lòng liên hệ với chúng tôi sớm nhất để được xử lý <br/>';
                    $content .= 'Trân trọng!';

                    sendMail($tokenQuery['email'], $subject, $content);

                    setFlashData('msg', 'Mật khẩu của bạn thay đổi thành công!');
                    setFlashData('msg_type', 'success');
                    redirect('?module=auth&action=login');
                } else {
                    setFlashData('msg', 'Lỗi hệ thống! Vui lòng liên hệ quản trị viên');
                    setFlashData('msg_type', 'danger');
                    redirect('?module=auth&action=reset&token=' . $token);
                }
            } else {
                setFlashData('msg', 'Vui lòng kiểm tra dữ liệu nhập vào');
                setFlashData('msg_type', 'danger');
                setFlashData('errors', $errors);
                redirect('?module=auth&action=reset&token=' . $token);
            }
        }
        $msg = getFlashData('msg');
        $msgType = getFlashData('msg_type');
        $errors = getFlashData('errors');
?>
<h3>Đặt lại mật khẩu</h3>
<div class="col-6" style="margin: 0 auto;">
    <form action="" method="POST" style="text-align: left;">
        <?php
                getMsg($msg, $msgType);
                ?>
        <div class="form-group">
            <label for="">Mật khẩu mới</label>
            <input type="password" name="password" placeholder="Mật khẩu mới...." class="form-control">
            <p class="error"><?php echo !empty($errors['password']) ? $errors['password'] : false ?></p>
        </div>

        <div class="form-group">
            <label for="">Xác nhận mật khẩu mới</label>
            <input type="password" name="confirm_password" placeholder="Xác nhận mật khẩu mới...." class="form-control">
            <p class="error"><?php echo !empty($errors['confirm_password']) ? $errors['confirm_password'] : false ?></p>
        </div>

        <button type="subimt" class="btn btn-primary form-control">Xác nhận</button>
        <input type="hidden" name="token" value="<?php echo $token ?>">
    </form>
    <br>
    <p><a href="?module=auth&action=login">Đăng nhập</a></p>
</div>
<?php
    } else {
        getMsg('Liên kết không tồn tại hoặc đã hết hạn!', 'danger');
    }
} else {
    getMsg('Liên kết không tồn tại hoặc đã hết hạn!', 'danger');
}

echo '</div>';

loadLayout('footer_login.php');