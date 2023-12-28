<?php
$data = [
    'pageTitle' => 'Thiết lập chung'
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
            <h4>Thông tin liên hệ</h4>
            <div class="form-group">
                <label for=""><?php echo getOption('general_hotline', 'label') ?></label>
                <input type="text" class="form-control" name="general_hotline" placeholder="Hotline...."
                    value="<?php echo getOption('general_hotline') ?>">
                <p class="error"><?php echo errorData('general_hotline', $errors) ?></p>
            </div>

            <div class="form-group">
                <label for=""><?php echo getOption('general_email', 'label') ?></label>
                <input type="text" class="form-control" name="general_email" placeholder="Hotline...."
                    value="<?php echo getOption('general_email') ?>">
                <p class="error"><?php echo errorData('general_email', $errors) ?></p>
            </div>

            <div class="form-group">
                <label for=""><?php echo getOption('general_time', 'label') ?></label>
                <input type="text" class="form-control" name="general_time" placeholder="Hotline...."
                    value="<?php echo getOption('general_time') ?>">
                <p class="error"><?php echo errorData('general_time', $errors) ?></p>
            </div>

            <div class="form-group">
                <label for=""><?php echo getOption('general_address', 'label') ?></label>
                <input type="text" class="form-control" name="general_address"
                    placeholder="<?php echo getOption('general_address','label') ?>"
                    value="<?php echo getOption('general_address') ?>">
                <p class="error"><?php echo errorData('general_address', $errors) ?></p>
            </div>

            <div class="form-group">
                <label for=""><?php echo getOption('general_twitter', 'label') ?></label>
                <input type="text" class="form-control" name="general_twitter" placeholder="Hotline...."
                    value="<?php echo getOption('general_twitter') ?>">
                <p class="error"><?php echo errorData('general_twitter', $errors) ?></p>
            </div>

            <div class="form-group">
                <label for=""><?php echo getOption('general_facebook', 'label') ?></label>
                <input type="text" class="form-control" name="general_facebook" placeholder="Hotline...."
                    value="<?php echo getOption('general_facebook') ?>">
                <p class="error"><?php echo errorData('general_facebook', $errors) ?></p>
            </div>

            <div class="form-group">
                <label for=""><?php echo getOption('general_linkedin', 'label') ?></label>
                <input type="text" class="form-control" name="general_linkedin" placeholder="Hotline...."
                    value="<?php echo getOption('general_linkedin') ?>">
                <p class="error"><?php echo errorData('general_linkedin', $errors) ?></p>
            </div>

            <div class="form-group">
                <label for=""><?php echo getOption('general_behance', 'label') ?></label>
                <input type="text" class="form-control" name="general_behance" placeholder="Hotline...."
                    value="<?php echo getOption('general_behance') ?>">
                <p class="error"><?php echo errorData('general_behance', $errors) ?></p>
            </div>

            <div class="form-group">
                <label for=""><?php echo getOption('general_youtube', 'label') ?></label>
                <input type="text" class="form-control" name="general_youtube" placeholder="Hotline...."
                    value="<?php echo getOption('general_youtube') ?>">
                <p class="error"><?php echo errorData('general_youtube', $errors) ?></p>
            </div>

            <button type="submit" class="btn btn-primary btn-sm">Lưu thay đổi</button>
        </form>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<?php
layout('footer', 'admin', $data);