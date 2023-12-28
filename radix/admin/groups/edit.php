<?php
$data = [
    'pageTitle' => 'Cập nhật nhóm người dùng'
];
layout('header', 'admin', $data);
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

$body = getBody('get');
if (!empty($body['id'])) {
    $groupId = $body['id'];

    $groupDetail = firstRaw("SELECT * FROM groups WHERE id=$groupId");

    if (empty($groupDetail)) {
        redirect('?module=groups');
    }
} else {
    redirect('?module=groups');
}

if (isPost()) {

    $body = getBody();

    $errors = [];

    if (empty(trim($body['name']))) {
        $errors['name'] = 'Tên nhóm không được để trống';
    } else {
        if (strlen(trim($body['name'])) < 5) {
            $errors['name'] = 'Tên nhóm không được nhỏ hơn 5 ký tự';
        }
    }

    if (empty($errors)) {
        $dataUpdate = [
            'name' => trim($body['name']),
            'update_at' => date("d/m/Y H:i:s")
        ];

        $condition = 'id=' . $groupId;

        $updateStatus = update('groups', $dataUpdate, $condition);

        if (!empty($updateStatus)) {
            setFlashData('msg', 'Cập nhật nhóm người dùng thành công');
            setFlashData('msg_type', 'success');
        } else {
            setFlashData('msg', 'Lỗi hệ thống, vui lòng thử lại sau!');
            setFlashData('msg_type', 'danger');
        }
    } else {
        setFlashData('msg', 'Vui lòng kiểm tra dữ liệu nhập vào!');
        setFlashData('msg_type', 'danger');
        setFlashData('errors', $errors);
        setFlashData('old', $body);
    }

    redirect('?module=groups&action=edit&id=' . $groupId);
}

$msg = getFlashData('msg');
$msg_type = getFlashData('msg_type');
$errors = getFlashData('errors');
$old = getFlashData('old');
if (empty($old) && !empty($groupDetail)) {
    $old = $groupDetail;
}
?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <?php
        getMsg($msg, $msg_type);
        ?>
        <form action="" method="post">
            <label for="">Tên nhóm</label>
            <input type="text" class="form-control" name="name" placeholder="Tên nhóm người dùng...." value="<?php echo oldData('name', $old) ?>">
            <p class="error"><?php echo errorData('name', $errors) ?></p>

            <button type="submit" class="btn btn-primary btn-sm">Thêm mới</button>
            <a href="<?php echo getLinkAdmin('groups') ?>" class="btn btn-success btn-sm">Quay lại</a>
        </form>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<?php
layout('footer', 'admin', $data);
