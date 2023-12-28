<?php
$data = [
    'pageTitle' => 'Thiết lập dự án'
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
            <h4>Thiết lập dự án</h4>
            <div class="form-group">
                <label for=""><?php echo getOption('portfolios_title', 'label') ?></label>
                <input type="text" class="form-control" name="portfolios_title" placeholder="<?php echo getOption('portfolios_title', 'label') ?>...." value="<?php echo getOption('portfolios_title') ?>">
                <p class="error"><?php echo errorData('portfolios_title', $errors) ?></p>
            </div>

            <button type="submit" class="btn btn-primary btn-sm">Lưu thay đổi</button>
        </form>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<?php
layout('footer', 'admin', $data);
