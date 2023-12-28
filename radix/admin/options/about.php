<?php
$data = [
    'pageTitle' => 'Thiết lập giới thiệu'
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
            <h4>Thiết lập giới thiệu</h4>
            <div class="form-group">
                <label for=""><?php echo getOption('about_title', 'label') ?></label>
                <input type="text" class="form-control" name="about_title"
                    placeholder="<?php echo getOption('about_title', 'label') ?>...."
                    value="<?php echo getOption('about_title') ?>">
                <p class="error"><?php echo errorData('about_title', $errors) ?></p>
            </div>

            <button type="submit" class="btn btn-primary btn-sm">Lưu thay đổi</button>
        </form>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<?php
layout('footer', 'admin', $data);