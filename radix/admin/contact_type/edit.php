<?php
$body = getBody('get');
if (!empty($body['id'])) {
    $contactTypeId = $body['id'];

    $contactTypeDetail = firstRaw("SELECT * FROM contact_type WHERE id=$contactTypeId");

    if (empty($contactTypeDetail)) {
        redirect('?module=contact_type');
    }
} else {
    redirect('?module=contact_type');
}

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
        $dataUpdate = [
            'name' => trim($body['name']),
            'update_at' => date("d/m/Y H:i:s")
        ];

        $condition = 'id=' . $contactTypeId;

        $updateStatus = update('contact_type', $dataUpdate, $condition);

        if (!empty($updateStatus)) {
            setFlashData('msg', 'Cập nhật phòng ban thành công');
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

    redirect("?module=contact_type&action=lists&view=edit&id=$contactTypeId");
}

$msg = getFlashData('msg');
$msg_type = getFlashData('msg_type');
$errors = getFlashData('errors');
$old = getFlashData('old');
if (empty($old) && !empty($contactTypeDetail)) {
    $old = $contactTypeDetail;
}
?>
<h4>Cập nhật phòng ban</h4>
<form action="" method="post">
    <div class="form-group">
        <label for="">Tên phòng ban</label>
        <input type="text" class="form-control slug" name="name" placeholder="Tên phòng ban..."
            value="<?php echo oldData('name', $old) ?>">
        <p class="error"><?php echo errorData('name', $errors) ?></p>
    </div>

    <button type="submit" class="btn btn-primary btn-sm">Cập nhật</button>
    <a href="<?php echo getLinkAdmin('contact_type') ?>" class="btn btn-success btn-sm">Quay lại</a>

</form>