<?php
$data = [
    'pageTitle' => 'Thêm nhóm người dùng mới'
];
layout('header', 'admin', $data);
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

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
        $dataInsert = [
            'name' => trim($body['name']),
            'create_at' => date("d/m/Y H:i:s")
        ];

        $insertStatus = insert('groups', $dataInsert);

        if (!empty($insertStatus)) {
            setFlashData('msg', 'Thêm nhóm người dùng mới thành công');
            setFlashData('msg_type', 'success');
            redirect('?module=groups');
        } else {
            setFlashData('msg', 'Lỗi hệ thống, vui lòng thử lại sau!');
            setFlashData('msg_type', 'danger');
            redirect('?module=groups&action=add');
        }
    } else {
        setFlashData('msg', 'Vui lòng kiểm tra dữ liệu nhập vào!');
        setFlashData('msg_type', 'danger');
        setFlashData('errors', $errors);
        setFlashData('old', $body);
        redirect('?module=groups&action=add');
    }
}

$msg = getFlashData('msg');
$msg_type = getFlashData('msg_type');
$errors = getFlashData('errors');
$old = getFlashData('old');

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
