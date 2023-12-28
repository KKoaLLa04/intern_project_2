<?php
$data = [
    'pageTitle' => 'Thiết lập footer'
];
layout('header', 'admin', $data);
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

updateOption();

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
            <h4>Thiết lập cột 1</h4>
            <div class="form-group">
                <label for=""><?php echo getOption('footer_title_1', 'label') ?></label>
                <input type="text" class="form-control" name="footer_title_1" placeholder="<?php echo getOption('footer_title_1', 'label') ?>...." value="<?php echo getOption('footer_title_1') ?>">
                <p class="error"><?php echo errorData('footer_title_1', $errors) ?></p>
            </div>

            <div class="form-group">
                <label for=""><?php echo getOption('footer_content_1', 'label') ?></label>
                <textarea name="footer_content_1" class="form-control editor" placeholder="<?php echo getOption('footer_content_1', 'label') ?>" rows="5"><?php echo getOption('footer_content_1') ?></textarea>
            </div>

            <h4>Thiết lập cột 2</h4>
            <div class="form-group">
                <label for=""><?php echo getOption('footer_title_2', 'label') ?></label>
                <input type="text" class="form-control" name="footer_title_2" placeholder="<?php echo getOption('footer_title_2', 'label') ?>...." value="<?php echo getOption('footer_title_2') ?>">
                <p class="error"><?php echo errorData('footer_title_2', $errors) ?></p>
            </div>

            <div class="form-group">
                <label for=""><?php echo getOption('footer_content_2', 'label') ?></label>
                <textarea name="footer_content_2" class="form-control editor" placeholder="<?php echo getOption('footer_content_2', 'label') ?>" rows="5"><?php echo getOption('footer_content_2') ?></textarea>
            </div>

            <h4>Thiết lập cột 3</h4>
            <div class="form-group">
                <label for=""><?php echo getOption('footer_title_3', 'label') ?></label>
                <input type="text" class="form-control" name="footer_title_3" placeholder="<?php echo getOption('footer_title_3', 'label') ?>...." value="<?php echo getOption('footer_title_3') ?>">
                <p class="error"><?php echo errorData('footer_title_3', $errors) ?></p>
            </div>

            <div class="form-group">
                <label for=""><?php echo getOption('footer_twitter_3', 'label') ?></label>
                <input type="text" class="form-control" name="footer_twitter_3" placeholder="<?php echo getOption('footer_twitter_3', 'label') ?>...." value="<?php echo getOption('footer_twitter_3') ?>">
                <p class="error"><?php echo errorData('footer_twitter_3', $errors) ?></p>
            </div>

            <h4>Thiết lập cột 4</h4>
            <div class="form-group">
                <label for=""><?php echo getOption('footer_title_4', 'label') ?></label>
                <input type="text" class="form-control" name="footer_title_4" placeholder="<?php echo getOption('footer_title_4', 'label') ?>...." value="<?php echo getOption('footer_title_4') ?>">
                <p class="error"><?php echo errorData('footer_title_4', $errors) ?></p>
            </div>

            <div class="form-group">
                <label for=""><?php echo getOption('footer_content_4', 'label') ?></label>
                <textarea name="footer_content_4" class="form-control editor" placeholder="<?php echo getOption('footer_content_4', 'label') ?>" rows="5"><?php echo getOption('footer_content_4') ?></textarea>
            </div>

            <h4>Thiết lập khác</h4>
            <div class="form-group">
                <label for=""><?php echo getOption('footer_copyright', 'label') ?></label>
                <input type="text" class="form-control" name="footer_copyright" placeholder="<?php echo getOption('footer_copyright', 'label') ?>...." value="<?php echo getOption('footer_copyright') ?>">
                <p class="error"><?php echo errorData('footer_copyright', $errors) ?></p>
            </div>

            <button type="submit" class="btn btn-primary btn-sm">Lưu thay đổi</button>
        </form>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<?php
layout('footer', 'admin', $data);
