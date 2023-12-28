<?php
$data = [
    'pageTitle' => 'Thêm dự án mới'
];
layout('header', 'admin', $data);
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

$userId = isLogin()['user_id'];

if (isPost()) {

    $body = getBody();

    $errors = [];

    if (empty(trim($body['name']))) {
        $errors['name'] = 'Tên dự án không được để trống';
    }

    if (empty(trim($body['slug']))) {
        $errors['slug'] = 'Đường dẫn tĩnh không được để trống';
    }

    if (empty(trim($body['content']))) {
        $errors['content'] = 'Nội dung không được để trống';
    }

    if (empty(trim($body['thumbnail']))) {
        $errors['thumbnail'] = 'Ảnh đại diện của dự án không được để trống';
    }

    if (empty(trim($body['video']))) {
        $errors['video'] = 'Link video của dự án không được để trống';
    }

    if (empty(trim($body['portfolio_categories_id']))) {
        $errors['portfolio_categories_id'] = 'Danh mục dự án bắt buộc phải chọn';
    }

    if (empty($errors)) {
        $dataInsert = [
            'name' => trim($body['name']),
            'slug' => trim($body['slug']),
            'content' => trim($body['content']),
            'user_id' => $userId,
            'thumbnail' => trim($body['thumbnail']),
            'description' => trim($body['description']),
            'video' => trim($body['video']),
            'portfolio_categories_id' => trim($body['portfolio_categories_id']),
            'create_at' => date("d/m/Y H:i:s")
        ];

        $insertStatus = insert('portfolios', $dataInsert);

        if (!empty($insertStatus)) {
            setFlashData('msg', 'Thêm dự án mới thành công');
            setFlashData('msg_type', 'success');
            redirect('?module=portfolios');
        } else {
            setFlashData('msg', 'Lỗi hệ thống, vui lòng thử lại sau!');
            setFlashData('msg_type', 'danger');
            redirect('?module=portfolios&action=add');
        }
    } else {
        setFlashData('msg', 'Vui lòng kiểm tra dữ liệu nhập vào!');
        setFlashData('msg_type', 'danger');
        setFlashData('errors', $errors);
        setFlashData('old', $body);
        redirect('?module=portfolios&action=add');
    }
}

$msg = getFlashData('msg');
$msg_type = getFlashData('msg_type');
$errors = getFlashData('errors');
$old = getFlashData('old');

// truy van den danh muc
$listAllCategories = getRaw("SELECT * FROM portfolios_categories ORDER BY name");
?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <?php
        getMsg($msg, $msg_type);
        ?>
        <form action="" method="post">
            <div class="form-group">
                <label for="">Tên dự án</label>
                <input type="text" class="form-control slug" name="name" placeholder="Tên dự án...."
                    value="<?php echo oldData('name', $old) ?>">
                <p class="error"><?php echo errorData('name', $errors) ?></p>
            </div>

            <div class="form-group">
                <label for="">Đường dẫn tĩnh</label>
                <input type="text" class="form-control slug-render" name="slug" placeholder="Đường dẫn tĩnh...."
                    value="<?php echo oldData('slug', $old) ?>">
                <p class="render-link"><b>Link:</b> <span></span></p>
                <p class="error"><?php echo errorData('slug', $errors) ?></p>
            </div>

            <div class="form-group">
                <label for="">Mô tả dự án</label>
                <textarea name="description" class="form-control"
                    placeholder="mô tả ngắn cho dự án..."><?php echo oldData('description', $old) ?></textarea>
                <p class="error"><?php echo errorData('description', $errors) ?></p>
            </div>

            <div class="form-group">
                <label for="">Nội dung</label>
                <textarea name="content" class="form-control editor"><?php echo oldData('content', $old) ?></textarea>
                <p class="error"><?php echo errorData('content', $errors) ?></p>
            </div>

            <div class="form-group">
                <label for="">Ảnh đại diện của dự án</label>
                <div class="row ckfinder-group">
                    <div class="col-10">
                        <input type="text" class="form-control image-render" name="thumbnail"
                            placeholder="Đường dẫn ảnh hoặc mã icon...."
                            value="<?php echo oldData('thumbnail', $old) ?>">
                    </div>
                    <div class="col-2">
                        <button type="button" class="btn btn-success btn-block choose-image">Chọn ảnh</button>
                    </div>
                </div>
                <p class="error"><?php echo errorData('thumbnail', $errors) ?></p>
            </div>


            <div class="form-group">
                <label for="">Link video</label>
                <input type="url" name="video" class="form-control" placeholder="Link video của dự án..."
                    value="<?php echo oldData('video', $old) ?>">
                <p class="error"><?php echo errorData('video', $errors) ?></p>
            </div>

            <div class="form-group">
                <label for="">Danh mục</label>
                <select name="portfolio_categories_id" class="form-control">
                    <option value="0">Chọn danh mục</option>
                    <?php
                    if (!empty($listAllCategories)) {
                        foreach ($listAllCategories as $item) {
                    ?>
                    <option value="<?php echo $item['id'] ?>"
                        <?php echo oldData('portfolio_categories_id', $old) == $item['id'] ? 'selected' : false ?>>
                        <?php echo $item['name'] ?></option>
                    <?php
                        }
                    }
                    ?>
                </select>
                <p class="error"><?php echo errorData('portfolio_categories_id', $errors) ?></p>
            </div>


            <div class="form-group">
                <label for="">Ảnh dự án</label>
                <div class="gallery-images">

                </div>
                <p>
                    <button type="button" class="btn btn-warning btn-sm add-gallery">Thêm ảnh</button>
                </p>
            </div>

            <button type="submit" class="btn btn-primary btn-sm">Thêm mới</button>
            <a href="<?php echo getLinkAdmin('portfolios') ?>" class="btn btn-success btn-sm">Quay lại</a>
        </form>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<?php
layout('footer', 'admin', $data);