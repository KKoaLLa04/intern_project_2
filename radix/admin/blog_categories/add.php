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

    if (empty(trim($body['slug']))) {
        $errors['slug'] = 'Đường dẫn tĩnh không được để trống';
    }

    if (empty($errors)) {
        $dataInsert = [
            'name' => trim($body['name']),
            'slug' => trim($body['slug']),
            'user_id' => $userId,
            'create_at' => date("d/m/Y H:i:s"),
        ];

        $insertStatus = insert('blog_categories', $dataInsert);

        if (!empty($insertStatus)) {
            setFlashData('msg', 'Thêm danh mục mới thành công');
            setFlashData('msg_type', 'success');
            redirect('?module=blog_categories');
        } else {
            setFlashData('msg', 'Lỗi hệ thống, vui lòng thử lại sau!');
            setFlashData('msg_type', 'danger');
            redirect('?module=blog_categories');
        }
    } else {
        setFlashData('msg', 'Vui lòng kiểm tra dữ liệu nhập vào!');
        setFlashData('msg_type', 'danger');
        setFlashData('errors', $errors);
        setFlashData('old', $body);
        redirect('?module=blog_categories');
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
        <input type="text" class="form-control slug" name="name" placeholder="Tên danh mục..." value="<?php echo oldData('name', $old) ?>">
        <p class="error"><?php echo errorData('name', $errors) ?></p>
    </div>

    <div class="form-group">
        <label for="">Đường dẫn tĩnh</label>
        <input type="text" class="form-control slug-render" name="slug" placeholder="Đường dẫn tĩnh...." value="<?php echo oldData('slug', $old) ?>">
        <p class="render-link"><b>Link:</b> <span></span></p>
        <p class="error"><?php echo errorData('slug', $errors) ?></p>
    </div>

    <button type="submit" class="btn btn-primary btn-sm">Thêm mới</button>
</form>