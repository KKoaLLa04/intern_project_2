<?php
$data = [
    'pageTitle' => 'Thiết lập bài viết'
];
layout('header', 'admin', $data);
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

if (isPost()) {
    updateOption();
}

$msg = getFlashData('msg');
$msg_type = getFlashData('msg_type');
$errors = getFlashData('errors');
?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <?php
        getMsg($msg, $msg_type);
        ?>
        <form action="" method="post">
            <h4>Thiết lập bài viết</h4>
            <div class="form-group">
                <label for=""><?php echo getOption('blog_title', 'label') ?></label>
                <input type="text" class="form-control" name="blog_title"
                    placeholder="<?php echo getOption('blog_title', 'label') ?>...."
                    value="<?php echo getOption('blog_title') ?>">
                <p class="error"><?php echo errorData('blog_title', $errors) ?></p>
            </div>

            <div class="form-group">
                <label for=""><?php echo getOption('blog_per_page', 'label') ?></label>
                <input type="text" class="form-control" name="blog_per_page" min="1"
                    placeholder="<?php echo getOption('blog_per_page', 'label') ?>...."
                    value="<?php echo getOption('blog_per_page') ?>">
                <p class="error"><?php echo errorData('blog_per_page', $errors) ?></p>
            </div>

            <button type="submit" class="btn btn-primary btn-sm">Lưu thay đổi</button>
        </form>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<?php
layout('footer', 'admin', $data);