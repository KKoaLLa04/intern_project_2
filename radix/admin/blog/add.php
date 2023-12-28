<?php
$data = [
    'pageTitle' => 'Thêm blog mới'
];
layout('header', 'admin', $data);
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

$userId = isLogin()['user_id'];

if (isPost()) {

    $body = getBody();

    $errors = [];

    if (empty(trim($body['title']))) {
        $errors['title'] = 'Tiêu đề blog không được để trống';
    }

    if (empty(trim($body['slug']))) {
        $errors['slug'] = 'Đường dẫn tĩnh không được để trống';
    }

    if (empty(trim($body['content']))) {
        $errors['content'] = 'Nội dung không được để trống';
    }

    if (empty(trim($body['thumbnail']))) {
        $errors['thumbnail'] = 'Ảnh đại diện không được để trống';
    }

    if (empty(trim($body['category_id']))) {
        $errors['category_id'] = 'Danh mục bắt buộc phải chọn';
    }

    if (empty($errors)) {
        $dataInsert = [
            'title' => trim($body['title']),
            'slug' => trim($body['slug']),
            'content' => trim($body['content']),
            'user_id' => $userId,
            'thumbnail' => trim($body['thumbnail']),
            'category_id' => trim($body['category_id']),
            'description' => trim($body['description']),
            'create_at' => date("d/m/Y H:i:s")
        ];

        $insertStatus = insert('blog', $dataInsert);

        if (!empty($insertStatus)) {
            setFlashData('msg', 'Thêm blog mới thành công');
            setFlashData('msg_type', 'success');
            redirect('?module=blog');
        } else {
            setFlashData('msg', 'Lỗi hệ thống, vui lòng thử lại sau!');
            setFlashData('msg_type', 'danger');
            redirect('?module=blog&action=add');
        }
    } else {
        setFlashData('msg', 'Vui lòng kiểm tra dữ liệu nhập vào!');
        setFlashData('msg_type', 'danger');
        setFlashData('errors', $errors);
        setFlashData('old', $body);
        redirect('?module=blog&action=add');
    }
}

$msg = getFlashData('msg');
$msg_type = getFlashData('msg_type');
$errors = getFlashData('errors');
$old = getFlashData('old');

// truy van du lieu blog_categories
$allCate = getRaw("SELECT * FROM blog_categories ORDER BY name");

?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <?php
        getMsg($msg, $msg_type);
        ?>
        <form action="" method="post">
            <div class="form-group">
                <label for="">Tiêu đề</label>
                <input type="text" class="form-control slug" name="title" placeholder="Tiêu đề blog...."
                    value="<?php echo oldData('title', $old) ?>">
                <p class="error"><?php echo errorData('title', $errors) ?></p>
            </div>

            <div class="form-group">
                <label for="">Đường dẫn tĩnh</label>
                <input type="text" class="form-control slug-render" name="slug" placeholder="Đường dẫn tĩnh...."
                    value="<?php echo oldData('slug', $old) ?>">
                <p class="render-link"><b>Link:</b> <span></span></p>
                <p class="error"><?php echo errorData('slug', $errors) ?></p>
            </div>

            <div class="form-group">
                <label for="">Mô tả</label>
                <textarea name="description" class="form-control"
                    placeholder="Mô tả blog..."><?php echo oldData('description', $old) ?></textarea>
                <p class="error"><?php echo errorData('description', $errors) ?></p>
            </div>

            <div class="form-group">
                <label for="">Nội dung</label>
                <textarea name="content" class="form-control editor"><?php echo oldData('content', $old) ?></textarea>
                <p class="error"><?php echo errorData('content', $errors) ?></p>
            </div>

            <div class="form-group">
                <label for="">Ảnh đại diện</label>
                <div class="row ckfinder-group">
                    <div class="col-10">
                        <input type="text" class="form-control image-render" name="thumbnail"
                            placeholder="Đường dẫn ảnh...." value="<?php echo oldData('thumbnail', $old) ?>">
                    </div>
                    <div class="col-2">
                        <button type="button" class="btn btn-success btn-block choose-image">Chọn ảnh</button>
                    </div>
                </div>
                <p class="error"><?php echo errorData('thumbnail', $errors) ?></p>
            </div>

            <div class="form-group">
                <label for="">Danh mục</label>
                <select name="category_id" class="form-control">
                    <option value="0">---Chọn danh mục---</option>
                    <?php if (!empty($allCate)) {
                        foreach ($allCate as $item) {
                    ?>
                    <option value="<?php echo $item['id'] ?>"
                        <?php echo (oldData('category_id', $old) == $item['id']) ? 'selected' : false ?>>
                        <?php echo $item['name'] ?></option>
                    <?php
                        }
                    } ?>
                </select>
                <p class="error"><?php echo errorData('category_id', $errors) ?></p>
            </div>

            <button type="submit" class="btn btn-primary btn-sm">Thêm mới</button>
            <a href="<?php echo getLinkAdmin('blog') ?>" class="btn btn-success btn-sm">Quay lại</a>
        </form>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<?php
layout('footer', 'admin', $data);