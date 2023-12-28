<?php
$body = getBody('get');
if (!empty($body['id'])) {
    $cateId = $body['id'];

    $cateDetail = firstRaw("SELECT * FROM blog_categories WHERE id=$cateId");

    if (empty($cateDetail)) {
        redirect('?module=blog_categories');
    }
} else {
    redirect('?module=blog_categories');
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

    if (empty(trim($body['slug']))) {
        $errors['slug'] = 'Đường dẫn tĩnh không được để trống';
    }


    if (empty($errors)) {
        $dataUpdate = [
            'name' => trim($body['name']),
            'slug' => trim($body['slug']),
            'update_at' => date("d/m/Y H:i:s")
        ];

        $condition = 'id=' . $cateId;

        $updateStatus = update('blog_categories', $dataUpdate, $condition);

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

    redirect("?module=blog_categories&action=lists&view=edit&id=$cateId");
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
        <input type="text" class="form-control slug" name="name" placeholder="Tên danh mục..." value="<?php echo oldData('name', $old) ?>">
        <p class="error"><?php echo errorData('name', $errors) ?></p>
    </div>

    <div class="form-group">
        <label for="">Đường dẫn tĩnh</label>
        <input type="text" class="form-control slug-render" name="slug" placeholder="Đường dẫn tĩnh...." value="<?php echo oldData('slug', $old) ?>">
        <p class="render-link"><b>Link:</b> <span></span></p>
        <p class="error"><?php echo errorData('slug', $errors) ?></p>
    </div>

    <button type="submit" class="btn btn-primary btn-sm">Cập nhật</button>
    <a href="<?php echo getLinkAdmin('blog_categories') ?>" class="btn btn-success btn-sm">Quay lại</a>

</form>