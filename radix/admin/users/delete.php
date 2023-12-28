<?php

$body = getBody();

if (!empty($body['id'])) {
    $userId = $body['id'];

    $userDetailRow = getRows("SELECT id FROM users WHERE id=$userId");
    if ($userDetailRow > 0) {
        // 1.Xoa nguoi dung tai bang login token
        $condition = 'user_id=' . $userId;
        $deleteLoginToken = delete('login_token', $condition);

        if (!empty($deleteLoginToken)) {
            // 2. xoa nguoi dung trong bang users
            $deleteStatus = delete('users', 'id=' . $userId);
            if (!empty($deleteStatus)) {
                setFlashData('msg', 'Xóa người dùng thành công!');
                setFlashData('msg_type', 'success');
            } else {
                setFlashData('msg', 'Lỗi hệ thống!');
                setFlashData('msg_type', 'danger');
            }
        } else {
            setFlashData('msg', 'Lỗi hệ thống, vui lòng thử lại sau!');
            setFlashData('msg_type', 'danger');
        }
    } else {
        setFlashData('msg', 'Người dùng không tồn tại trong hệ thống!');
        setFlashData('msg_type', 'danger');
    }
} else {
    setFlashData('msg', 'Liên kết không tồn tại!');
    setFlashData('msg_type', 'danger');
}

redirect('?module=users');
