<?php
$data = [
    'pageTitle' => 'Đổi mật khẩu'
];
layout('header', 'admin', $data);
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

$userId = isLogin()['user_id'];
$userDetail = getUserInfor($userId);

if (isPost()) {

    $body = getBody();

    $errors = [];

    if (empty(trim($body['old_password']))) {
        $errors['old_password'] = 'Vui lòng nhập mật khẩu cũ';
    } else {
        $old_password = trim($body['old_password']);
        $passwordHash = $userDetail['password'];
        if (!password_verify($old_password, $passwordHash)) {
            $errors['old_password'] = 'Mật khẩu cũ không chính xác';
        }
    }

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

        $dataUpdate = [
            'password' => password_hash(trim($body['password']), PASSWORD_DEFAULT),
            'update_at' => date('Y-m-d H:i:S')
        ];

        $condition = 'id=' . $userId;

        $updateStatus = update('users', $dataUpdate, $condition);

        if ($updateStatus) {
            setFlashData('msg', 'Đổi mật khẩu thành công!');
            setFlashData('msg_type', 'success');
            redirect('?module=auth&action=logout');
        } else {
            setFlashData('msg', 'Hệ thống đang lỗi, vui lòng thử lại sau!');
            setFlashData('msg_type', 'danger');
        }
    } else {
        setFlashData('msg', 'Vui lòng kiểm tra dữ liệu nhập vào');
        setFlashData('msg_type', 'danger');
        setFlashData('errors', $errors);
    }
    redirect('?module=users&action=change_password');
}

$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
$errors = getFlashData('errors');

?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        <?php
        getMsg($msg, $msgType);
        ?>

        <form action="" method="POST">
            <div class="form-group">
                <label for="">Mật khẩu cũ</label>
                <input type="password" name="old_password" placeholder="Nhập lại mật khẩu cũ..." class="form-control">
                <p class="error"><?php echo errorData('old_password', $errors) ?></p>
            </div>

            <div class="form-group">
                <label for="">Mật khẩu mới</label>
                <input type="password" name="password" placeholder="Mật khẩu mới..." class="form-control">
                <p class="error"><?php echo errorData('password', $errors) ?></p>
            </div>

            <div class="form-group">
                <label for="">Nhập lại mật khẩu mới</label>
                <input type="password" name="confirm_password" placeholder="Nhập lại mật khẩu mới..." class="form-control">
                <p class="error"><?php echo errorData('confirm_password', $errors) ?></p>
            </div>

            <button type="submit" class="btn btn-primary btn-sm">Thay đổi</button>
        </form>

    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<?php
layout('footer', 'admin', $data);
