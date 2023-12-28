<?php
$data = [
    'pageTitle' => 'Cập nhật liên hệ'
];
layout('header', 'admin', $data);
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

// Truy van lay du lieu cu
$body = getBody('get');
if (!empty($body['id'])) {
    $contactId = $body['id'];

    $contactDetail = firstRaw("SELECT * FROM contacts WHERE id=$contactId");

    if (empty($contactDetail)) {
        redirect('?module=contacts');
    }
} else {
    redirect('?module=contacts');
}

if (isPost()) {

    $body = getBody();

    $errors = [];

    if (empty(trim($body['fullname']))) {
        $errors['fullname'] = 'Họ tên người gửi liên hệ không được để trống';
    }

    if (empty(trim($body['message']))) {
        $errors['message'] = 'Nội dung liên hệ không được để trống';
    }

    if (empty(trim($body['email']))) {
        $errors['email'] = 'Email người liên hệ không được để trống';
    }

    if (empty(trim($body['type_id']))) {
        $errors['type_id'] = 'Phòng ban bắt buộc phải chọn';
    }

    if (empty($errors)) {
        $dataUpdate = [
            'fullname' => trim($body['fullname']),
            'email' => trim($body['email']),
            'type_id' => trim($body['type_id']),
            'message' => trim($body['message']),
            'status' => trim($body['status']),
            'note' => trim($body['note']),
            'update_at' => date("d/m/Y H:i:s")
        ];

        $condition = 'id=' . $contactId;

        $updateStatus = update('contacts', $dataUpdate, $condition);

        if (!empty($updateStatus)) {
            setFlashData('msg', 'Cập nhật liên hệ thành công');
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

    redirect('?module=contacts&action=edit&id=' . $contactId);
}

$msg = getFlashData('msg');
$msg_type = getFlashData('msg_type');
$errors = getFlashData('errors');
$old = getFlashData('old');

if (empty($old) && !empty($contactDetail)) {
    $old = $contactDetail;
}

// truy van du lieu contact_type
$allContactType = getRaw("SELECT * FROM contact_type ORDER BY name");

?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <?php
        getMsg($msg, $msg_type);
        ?>
        <form action="" method="post">
            <div class="form-group">
                <label for="">Họ và tên</label>
                <input type="text" class="form-control" name="fullname" placeholder="Họ và tên người gửi liên hệ...." value="<?php echo oldData('fullname', $old) ?>">
                <p class="error"><?php echo errorData('fullname', $errors) ?></p>
            </div>

            <div class="form-group">
                <label for="">Email</label>
                <textarea name="email" class="form-control" placeholder="Email của người gửi liên hệ..."><?php echo oldData('email', $old) ?></textarea>
                <p class="error"><?php echo errorData('email', $errors) ?></p>
            </div>

            <div class="form-group">
                <label for="">Nội dung</label>
                <textarea name="message" class="form-control" rows="10"><?php echo oldData('message', $old) ?></textarea>
                <p class="error"><?php echo errorData('message', $errors) ?></p>
            </div>

            <div class="form-group">
                <label for="">Phòng ban</label>
                <select name="type_id" class="form-control">
                    <option value="0">---Chọn phòng ban---</option>
                    <?php if (!empty($allContactType)) {
                        foreach ($allContactType as $item) {
                    ?>
                            <option value="<?php echo $item['id'] ?>" <?php echo (oldData('type_id', $old) == $item['id']) ? 'selected' : false ?>>
                                <?php echo $item['name'] ?></option>
                    <?php
                        }
                    } ?>
                </select>
                <p class="error"><?php echo errorData('type_id', $errors) ?></p>
            </div>

            <div class="form-group">
                <label for="">Chọn Trạng Thái</label>
                <select name="status" class="form-control">
                    <option value="0" <?php echo (!empty($old['status']) && $old['status'] == 0) ? 'selected' : false ?>>Chưa
                        xử lý</option>
                    <option value="1" <?php echo (!empty($old['status']) && $old['status'] == 1) ? 'selected' : false ?>>Đã
                        xử lý</option>
                </select>
                <p class="error">
                    <?php echo errorData('status', $errors) ?>
                </p>
            </div>

            <div class="form-group">
                <label for="">Ghi chú</label>
                <textarea name="note" class="form-control"><?php echo oldData('note', $old) ?></textarea>
                <p class="error"><?php echo errorData('note', $errors) ?></p>
            </div>

            <button type="submit" class="btn btn-primary btn-sm">Cập nhật</button>
            <a href="<?php echo getLinkAdmin('contacts') ?>" class="btn btn-success btn-sm">Quay lại</a>
        </form>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<?php
layout('footer', 'admin', $data);
