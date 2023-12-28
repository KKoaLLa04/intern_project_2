<?php
$body = getBody('get');
if (!empty($body['id'])) {
    $cateId = $body['id'];

    $cateDetail = firstRaw("SELECT * FROM portfolios_categories WHERE id=$cateId");

    if (empty($cateDetail)) {
        redirect('?module=portfolios_categories');
    }
} else {
    redirect('?module=portfolios_categories');
}

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
        $dataUpdate = [
            'name' => trim($body['name']),
            'update_at' => date("d/m/Y H:i:s")
        ];

        $condition = 'id=' . $cateId;

        $updateStatus = update('portfolios_categories', $dataUpdate, $condition);

        if (!empty($updateStatus)) {
            setFlashData('msg', 'Cập nhật danh mục thành công');
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

    redirect("?module=portfolios_categories&action=lists&view=edit&id=$cateId");
}

$msg = getFlashData('msg');
$msg_type = getFlashData('msg_type');
$errors = getFlashData('errors');
$old = getFlashData('old');
if (empty($old) && !empty($cateDetail)) {
    $old = $cateDetail;
}
?>
<h4>Cập nhật danh mục</h4>
<form action="" method="post">
    <div class="form-group">
        <label for="">Tên danh mục</label>
        <input type="text" class="form-control" name="name" placeholder="Tên danh mục..." value="<?php echo oldData('name', $old) ?>">
        <p class="error"><?php echo errorData('name', $errors) ?></p>
    </div>

    <button type="submit" class="btn btn-primary btn-sm">Cập nhật</button>
    <a href="<?php echo getLinkAdmin('portfolios_categories') ?>" class="btn btn-success btn-sm">Quay lại</a>

</form>