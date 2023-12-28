<?php
$data = [
    'pageTitle' => 'Thiết lập header'
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
            <h4>Thiết lập tìm kiếm</h4>
            <div class="form-group">
                <label for=""><?php echo getOption('header_search', 'label') ?></label>
                <input type="text" class="form-control" name="header_search" placeholder="Hotline...." value="<?php echo getOption('header_search') ?>">
                <p class="error"><?php echo errorData('header_search', $errors) ?></p>
            </div>

            <h4>Thiết lập khác</h4>
            <div class="form-group">
                <label for=""><?php echo getOption('header_quote_text', 'label') ?></label>
                <input type="text" class="form-control" name="header_quote_text" placeholder="Hotline...." value="<?php echo getOption('header_quote_text') ?>">
                <p class="error"><?php echo errorData('header_quote_text', $errors) ?></p>
            </div>

            <div class="form-group">
                <label for=""><?php echo getOption('header_quote_link', 'label') ?></label>
                <input type="text" class="form-control" name="header_quote_link" placeholder="Hotline...." value="<?php echo getOption('header_quote_link') ?>">
                <p class="error"><?php echo errorData('header_quote_link', $errors) ?></p>
            </div>

            <button type="submit" class="btn btn-primary btn-sm">Lưu thay đổi</button>
        </form>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<?php
layout('footer', 'admin', $data);
