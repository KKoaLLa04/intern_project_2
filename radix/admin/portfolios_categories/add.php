<?php

$userId = isLogin()['user_id'];
if (isPost()) {

    $body = getBody();

    $errors = [];

    if (empty(trim($body['name']))) {
        $errors['name'] = 'Tên danh mục không được để trống';
    } else {
        if (strlen(trim($body['name'])) < 5) {
            $errors['name'] = 'Tên danh mục không được nhỏ hơn 5 ký tự';
        }
    }

    if (empty($errors)) {
        $dataInsert = [
            'name' => trim($body['name']),
            'user_id' => $userId,
            'create_at' => date("d/m/Y H:i:s"),
        ];

        $insertStatus = insert('portfolios_categories', $dataInsert);

        if (!empty($insertStatus)) {
            setFlashData('msg', 'Thêm nhóm người dùng mới thành công');
            setFlashData('msg_type', 'success');
            redirect('?module=portfolios_categories');
        } else {
            setFlashData('msg', 'Lỗi hệ thống, vui lòng thử lại sau!');
            setFlashData('msg_type', 'danger');
            redirect('?module=portfolios_categories');
        }
    } else {
        setFlashData('msg', 'Vui lòng kiểm tra dữ liệu nhập vào!');
        setFlashData('msg_type', 'danger');
        setFlashData('errors', $errors);
        setFlashData('old', $body);
        redirect('?module=portfolios_categories');
    }
}

$msg = getFlashData('msg');
$msg_type = getFlashData('msg_type');
$errors = getFlashData('errors');
$old = getFlashData('old');
?>
<h4>Thêm danh mục mới</h4>
<form action="" method="post">
    <div class="form-group">
        <label for="">Tên danh mục</label>
        <input type="text" class="form-control" name="name" placeholder="Tên danh mục..." value="<?php echo oldData('name', $old) ?>">
        <p class="error"><?php echo errorData('name', $errors) ?></p>

    </div>

    <button type="submit" class="btn btn-primary btn-sm">Thêm mới</button>
</form>