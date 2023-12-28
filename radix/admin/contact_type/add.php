<?php
if (isPost()) {

    $body = getBody();

    $errors = [];

    if (empty(trim($body['name']))) {
        $errors['name'] = 'Tên phòng ban không được để trống';
    } else {
        if (strlen(trim($body['name'])) < 5) {
            $errors['name'] = 'Tên phòng ban không được nhỏ hơn 5 ký tự';
        }
    }

    if (empty($errors)) {
        $dataInsert = [
            'name' => trim($body['name']),
            'create_at' => date("d/m/Y H:i:s"),
        ];

        $insertStatus = insert('contact_type', $dataInsert);

        if (!empty($insertStatus)) {
            setFlashData('msg', 'Thêm phòng ban mới thành công');
            setFlashData('msg_type', 'success');
            redirect('?module=contact_type');
        } else {
            setFlashData('msg', 'Lỗi hệ thống, vui lòng thử lại sau!');
            setFlashData('msg_type', 'danger');
            redirect('?module=contact_type');
        }
    } else {
        setFlashData('msg', 'Vui lòng kiểm tra dữ liệu nhập vào!');
        setFlashData('msg_type', 'danger');
        setFlashData('errors', $errors);
        setFlashData('old', $body);
        redirect('?module=contact_type');
    }
}

$msg = getFlashData('msg');
$msg_type = getFlashData('msg_type');
$errors = getFlashData('errors');
$old = getFlashData('old');
?>
<h4>Thêm phòng ban mới</h4>
<form action="" method="post">
    <div class="form-group">
        <label for="">Tên phòng ban</label>
        <input type="text" class="form-control" name="name" placeholder="Tên phòng ban..." value="<?php echo oldData('name', $old) ?>">
        <p class="error"><?php echo errorData('name', $errors) ?></p>
    </div>

    <button type="submit" class="btn btn-primary btn-sm">Thêm mới</button>
</form>