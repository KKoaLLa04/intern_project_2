<?php
$data = [
    'pageTitle' => 'Thông tin cá nhân'
];
layout('header', 'admin', $data);
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

$userId = isLogin()['user_id'];
$userDetail = getUserInfor($userId);

setFlashData('userDetail', $userDetail);

if (isPost()) {

    $body = getBody();

    $errors = [];

    if (empty(trim($body['fullname']))) {
        $errors['fullname'] = 'Họ và tên không được để trống';
    } else {
        if (strlen(trim($body['fullname'])) < 5) {
            $errors['fullname'] = 'Họ và tên phải lớn hơn 5 ký tự';
        }
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

        $dataUpdate = [
            'email' => trim($body['email']),
            'fullname' => trim($body['fullname']),
            'contact_facebook' => trim($body['contact_facebook']),
            'contact_twitter' => trim($body['contact_twitter']),
            'contact_linkedin' => trim($body['contact_linkedin']),
            'contact_pinterest' => trim($body['contact_pinterest']),
            'about_content' => trim($body['about_content']),
            'update_at' => date('Y-m-d H:i:S')
        ];

        $condition = 'id=' . $userId;

        $updateStatus = update('users', $dataUpdate, $condition);

        if ($updateStatus) {
            setFlashData('msg', 'Cập nhật thông tin thành công');
            setFlashData('msg_type', 'success');
        } else {
            setFlashData('msg', 'Hệ thống đang lỗi, vui lòng thử lại sau!');
            setFlashData('msg_type', 'danger');
        }
    } else {
        setFlashData('msg', 'Vui lòng kiểm tra dữ liệu nhập vào');
        setFlashData('msg_type', 'danger');
        setFlashData('errors', $errors);
        setFlashData('old', $body);
    }
    redirect('?module=users&action=profile');
}

$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
$errors = getFlashData('errors');
$old = getFlashData('old');
$userDetail = getFlashData('userDetail');
if (!empty($userDetail) && empty($old)) {
    $old = $userDetail;
}

?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        <?php
        getMsg($msg, $msgType);
        ?>

        <form action="" method="POST">
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Họ và tên</label>
                        <input type="text" name="fullname" placeholder="Họ và tên..." class="form-control"
                            value="<?php echo oldData('fullname', $old) ?>">
                        <p class="error"><?php echo errorData('fullname', $errors) ?></p>
                    </div>

                    <div class="form-group">
                        <label for="">Facebook</label>
                        <input type="text" name="contact_facebook" placeholder="Link facebook..." class="form-control"
                            value="<?php echo oldData('contact_facebook', $old) ?>">
                    </div>

                    <div class="form-group">
                        <label for="">Twiiter</label>
                        <input type="text" name="contact_twitter" placeholder="Link twitter..." class="form-control"
                            value="<?php echo oldData('contact_twitter', $old) ?>">
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" name="email" placeholder="Email..." class="form-control"
                            value="<?php echo oldData('email', $old) ?>">
                        <p class="error"><?php echo errorData('email', $errors) ?></p>
                    </div>

                    <div class="form-group">
                        <label for="">Linkedin</label>
                        <input type="text" name="contact_linkedin" placeholder="Link linkedin..." class="form-control"
                            value="<?php echo oldData('contact_linkedin', $old) ?>">
                    </div>

                    <div class="form-group">
                        <label for="">Pinterest</label>
                        <input type="text" name="contact_pinterest" placeholder="Link pinterest..." class="form-control"
                            value="<?php echo oldData('contact_pinterest', $old) ?>">
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group">
                        <label for="">Nội dung giới thiệu</label>
                        <textarea name="about_content" class="form-control"
                            placeholder="Nội dung giới thiệu..."><?php echo oldData('about_content', $old) ?></textarea>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-sm">Cập nhật</button>
        </form>

    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<?php
layout('footer', 'admin', $data);