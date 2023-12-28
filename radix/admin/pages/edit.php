<?php
$data = [
    'pageTitle' => 'Cập nhật trang'
];
layout('header', 'admin', $data);
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

$body = getBody('get');
if (!empty($body['id'])) {
    $pageId = $body['id'];

    $pageDetail = firstRaw("SELECT * FROM pages WHERE id=$pageId");

    if (empty($pageDetail)) {
        redirect('?module=pages');
    }
} else {
    redirect('?module=pages');
}

if (isPost()) {

    $body = getBody();

    $errors = [];

    if (empty(trim($body['title']))) {
        $errors['title'] = 'Tên trang không được để trống';
    }

    if (empty(trim($body['slug']))) {
        $errors['slug'] = 'Đường dẫn tĩnh không được để trống';
    }

    if (empty(trim($body['content']))) {
        $errors['content'] = 'Nội dung không được để trống';
    }

    if (empty($errors)) {
        $dataUpdate = [
            'title' => trim($body['title']),
            'slug' => trim($body['slug']),
            'content' => trim($body['content']),
            'update_at' => date("d/m/Y H:i:s")
        ];

        $condition = 'id=' . $pageId;

        $updateStatus = update('pages', $dataUpdate, $condition);

        if (!empty($updateStatus)) {
            setFlashData('msg', 'Cập nhật trang thành công');
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

    redirect('?module=pages&action=edit&id=' . $pageId);
}

$msg = getFlashData('msg');
$msg_type = getFlashData('msg_type');
$errors = getFlashData('errors');
$old = getFlashData('old');
if (empty($old) && !empty($pageDetail)) {
    $old = $pageDetail;
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
                <label for="">Tên trang</label>
                <input type="text" class="form-control slug" name="title" placeholder="Tên trang...."
                    value="<?php echo oldData('title', $old) ?>">
                <p class="error"><?php echo errorData('title', $errors) ?></p>
            </div>

            <div class="form-group">
                <label for="">Đường dẫn tĩnh</label>
                <input type="text" class="form-control slug-render" name="slug" placeholder="Đường dẫn tĩnh...."
                    value="<?php echo oldData('slug', $old) ?>">
                <p class="render-link"><b>Link:</b> <span></span></p>
                <!-- <p class="error"><?php echo errorData('slug', $errors) ?></p> -->
            </div>

            <div class="form-group">
                <label for="">Nội dung</label>
                <textarea name="content" class="form-control editor"><?php echo oldData('content', $old) ?></textarea>
                <p class="error"><?php echo errorData('content', $errors) ?></p>
            </div>

            <button type="submit" class="btn btn-primary btn-sm">Cập nhật</button>
            <a href="<?php echo getLinkAdmin('pages') ?>" class="btn btn-success btn-sm">Quay lại</a>
        </form>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<?php
layout('footer', 'admin', $data);