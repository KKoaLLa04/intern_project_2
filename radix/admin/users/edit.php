<?php
$data = [
    'pageTitle' => 'Cập nhật người dùng'
];
layout('header', 'admin', $data);
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

$body = getBody('get');
if (!empty($body['id'])) {
    $userId = $body['id'];

    $userDetail = firstRaw("SELECT * FROM users WHERE id=$userId");

    if (empty($userDetail)) {
        setFlashData('msg', 'Người dùng không tồn tại');
        setFlashData('msg_type', 'danger');
        redirect('?module=users');
    }
} else {
    setFlashData('msg', 'Liên kết không tồn tại');
    setFlashData('msg_type', 'danger');
    redirect('?module=users');
}

if (isPost()) {

    $body = getBody();

    $errors = [];

    // validate fullname
    if (empty(trim($body['fullname']))) {
        $errors['fullname'] = 'Họ tên không được để trống';
    } else {
        if (strlen(trim($body['fullname'])) < 5) {
            $errors['fullname'] = 'Họ tên không được nhỏ hơn 5 ký tự';
        }
    }

    // validate phone number
    if (empty(trim($body['group_id']))) {
        $errors['group_id'] = 'Nhóm người dùng bắt buộc phải chọn';
    }

    // validate email
    if (empty(trim($body['email']))) {
        $errors['email'] = 'Email không được để trống';
    } else {
        if (!isEmail(trim($body['email']))) {
            $errors['email'] = 'Email không đúng định dạng';
        } else {
            $email = trim($body['email']);
            $sql = "SELECT id FROM users WHERE email='$email' AND id <> $userId";

            if (getRows($sql) > 0) {
                $errors['email'] = 'Email đã tồn tại';
            }
        }
    }

    if (empty($errors)) {
        // khong co loi xay ra

        $dataUpdate = [
            'email' => trim($body['email']),
            'fullname' => trim($body['fullname']),
            'group_id' => trim($body['group_id']),
            'status' => $body['status'],
            'update_at' => date('Y-m-d H:i:S')
        ];

        if (!empty(trim($body['password']))) {
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
            $dataUpdate['password'] = password_hash(trim($body['password']), PASSWORD_DEFAULT);
        }

        $condition = 'id=' . $userId;

        $updateStatus = update('users', $dataUpdate, $condition);

        if ($updateStatus) {
            setFlashData('msg', 'Cập nhật người dùng thành công');
            setFlashData('msg_type', 'success');
            redirect('?module=users&action=edit&id=' . $userId);
        } else {
            setFlashData('msg', 'Hệ thống đang lỗi, vui lòng thử lại sau!');
            setFlashData('msg_type', 'danger');
            redirect('?module=users&action=edit&id=' . $userId);
        }

        // redirect('?module=auth&action=login');
    } else {
        setFlashData('msg', 'Vui lòng kiểm tra dữ liệu nhập vào');
        setFlashData('msg_type', 'danger');
        setFlashData('errors', $errors);
        setFlashData('old', $body);
        redirect('?module=users&action=edit&id=' . $userId);
    }
}

// lay du lieu nhom nguoi dung
$allGroup = getRaw("SELECT * FROM groups ORDER BY create_at DESC");


$msg = getFlashData('msg');
$msg_type = getFlashData('msg_type');
$errors = getFlashData('errors');
$old = getFlashData('old');
if (empty($old) && !empty($userDetail)) {
    $old = $userDetail;
}
?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <?php
        getMsg($msg, $msg_type);
        ?>
        <form action="" method="post">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="">Họ và tên</label>
                        <input type="text" name="fullname" placeholder="Họ và tên...." class="form-control" value="<?php echo oldData('fullname', $old) ?>">
                        <p class="error"><?php echo errorData('fullname', $errors) ?></p>
                    </div>

                    <div class="form-group">
                        <label for="">Nhóm</label>
                        <select name="group_id" class="form-control">
                            <option value="0">---Chọn nhóm người dùng---</option>
                            <?php
                            if (!empty($allGroup)) {
                                foreach ($allGroup as $item) {
                            ?>
                                    <option value="<?php echo $item['id'] ?>" <?php echo (!empty($old['group_id']) && $old['group_id'] == $item['id']) ? 'selected' : false ?>>
                                        <?php echo $item['name'] ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                        <p class="error"><?php echo errorData('group_id', $errors) ?></p>
                    </div>

                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" name="email" placeholder="Email...." class="form-control" value="<?php echo oldData('email', $old) ?>">
                        <p class="error"><?php echo errorData('email', $errors) ?></p>
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                        <label for="">Mật khẩu</label>
                        <input type="password" name="password" placeholder="Mật khẩu (Không nhập nếu không thay đổi) ...." class="form-control">
                        <p class="error"><?php echo errorData('password', $errors) ?></p>
                    </div>

                    <div class="form-group">
                        <label for="">Xác nhận mật khẩu</label>
                        <input type="password" name="confirm_password" placeholder="Xác nhận mật khẩu (Không nhập nếu khong thay đổi) ...." class="form-control">
                        <p class="error">
                            <?php echo errorData('confirm_password', $errors) ?>
                        </p>
                    </div>

                    <div class="form-group">
                        <label for="">Chọn Trạng Thái</label>
                        <select name="status" class="form-control">
                            <option value="0" <?php echo (!empty($old['status']) && $old['status'] == 0) ? 'selected' : false ?>>Chưa
                                kích
                                hoạt</option>
                            <option value="1" <?php echo (!empty($old['status']) && $old['status'] == 1) ? 'selected' : false ?>>Đã
                                kích
                                hoạt</option>
                        </select>
                        <p class="error">
                            <?php echo errorData('status', $errors) ?>
                        </p>
                    </div>
                </div>
            </div>
            <input type="hidden" name="id" value="<?php echo $userId ?>">

            <button type="submit" class="btn btn-primary btn-sm">Cập nhật</button>
            <a href="<?php echo getLinkAdmin('users') ?>" class="btn btn-success btn-sm">Quay lại</a>
        </form>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<?php
layout('footer', 'admin', $data);
