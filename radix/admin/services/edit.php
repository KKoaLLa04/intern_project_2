<?php
$data = [
    'pageTitle' => 'Cập nhật dịch vụ'
];
layout('header', 'admin', $data);
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

$body = getBody('get');
if (!empty($body['id'])) {
    $serviceId = $body['id'];

    $serviceDetail = firstRaw("SELECT * FROM services WHERE id=$serviceId");

    if (empty($serviceDetail)) {
        redirect('?module=services');
    }
} else {
    redirect('?module=services');
}

if (isPost()) {

    $body = getBody();

    $errors = [];

    if (empty(trim($body['name']))) {
        $errors['name'] = 'Tên dịch vụ không được để trống';
    }

    if (empty(trim($body['slug']))) {
        $errors['slug'] = 'Đường dẫn tĩnh không được để trống';
    }

    if (empty(trim($body['icon']))) {
        $errors['icon'] = 'Icon không được để trống';
    }

    if (empty(trim($body['content']))) {
        $errors['content'] = 'Nội dung không được để trống';
    }

    if (empty($errors)) {
        $dataUpdate = [
            'name' => trim($body['name']),
            'slug' => trim($body['slug']),
            'icon' => trim($body['icon']),
            'description' => trim($body['description']),
            'content' => trim($body['content']),
            'update_at' => date("d/m/Y H:i:s")
        ];

        $condition = 'id=' . $serviceId;

        $updateStatus = update('services', $dataUpdate, $condition);

        if (!empty($updateStatus)) {
            setFlashData('msg', 'Cập nhật dịch vụ thành công');
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

    redirect('?module=services&action=edit&id=' . $serviceId);
}

$msg = getFlashData('msg');
$msg_type = getFlashData('msg_type');
$errors = getFlashData('errors');
$old = getFlashData('old');
if (empty($old) && !empty($serviceDetail)) {
    $old = $serviceDetail;
}
?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <?php
        getMsg($msg, $msg_type);
        ?>
        <form action="" method="post">

            <div class="form-group">
                <label for="">Tên dịch vụ</label>
                <input type="text" class="form-control slug" name="name" placeholder="Tên dịch vụ...."
                    value="<?php echo oldData('name', $old) ?>">
                <p class="error"><?php echo errorData('name', $errors) ?></p>
            </div>

            <div class="form-group">
                <label for="">Đường dẫn tĩnh</label>
                <input type="text" class="form-control slug-render" name="slug" placeholder="Đường dẫn tĩnh...."
                    value="<?php echo oldData('slug', $old) ?>">
                <p class="render-link"><b>Link:</b> <span></span></p>
                <!-- <p class="error"><?php echo errorData('slug', $errors) ?></p> -->
            </div>

            <div class="form-group">
                <label for="">Ảnh hoặc Icon</label>
                <div class="row ckfinder-group">
                    <div class="col-10">
                        <input type="text" class="form-control image-render" name="icon"
                            placeholder="Đường dẫn ảnh hoặc mã icon...." value="<?php echo oldData('icon', $old) ?>">
                    </div>
                    <div class="col-2">
                        <button type="button" class="btn btn-success btn-block choose-image">Chọn ảnh</button>
                    </div>
                </div>
                <p class="error"><?php echo errorData('icon', $errors) ?></p>
            </div>



            <div class="form-group">
                <label for="">Mô tả ngắn</label>
                <textarea name="description" class="form-control"
                    placeholder="Mô tả ngắn..."><?php echo oldData('description', $old) ?></textarea>
                <p class="error"><?php echo errorData('description', $errors) ?></p>
            </div>

            <div class="form-group">
                <label for="">Nội dung</label>
                <textarea name="content" class="form-control editor"><?php echo oldData('content', $old) ?></textarea>
                <p class="error"><?php echo errorData('content', $errors) ?></p>
            </div>

            <button type="submit" class="btn btn-primary btn-sm">Cập nhật</button>
            <a href="<?php echo getLinkAdmin('services') ?>" class="btn btn-success btn-sm">Quay lại</a>
        </form>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<?php
layout('footer', 'admin', $data);