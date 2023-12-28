<?php

$body = getBody();

if (!empty($body['id'])) {

    $contactTypeId = $body['id'];
    $contactTypeNumRows = getRows("SELECT id FROM contact_type WHERE id=$contactTypeId");
    if ($contactTypeNumRows > 0) {

        $contactNum = getRows("SELECT id FROM contacts WHERE type_id=$contactTypeId");

        if ($contactNum > 0) {
            setFlashData('msg', 'Không thể xóa phòng ban .Trong phòng ban vẫn còn ' . $contactNum . ' liên hệ');
            setFlashData('msg_type', 'danger');
        } else {
            $condition = 'id=' . $contactTypeId;

            $deleteStatus = delete('contact_type', $condition);

            if (!empty($deleteStatus)) {
                setFlashData('msg', 'Xóa phòng ban thành công');
                setFlashData('msg_type', 'success');
            } else {
                setFlashData('msg', 'Xóa phòng ban không thành công, vui lòng thử lại sau');
                setFlashData('msg_type', 'danger');
            }
        }
    } else {
        setFlashData('msg', 'phòng ban không tồn tại trong hệ thống');
        setFlashData('msg_type', 'danger');
    }
} else {
    setFlashData('msg', 'Liên kết không tồn tại');
    setFlashData('msg_type', 'danger');
}

redirect('?module=contact_type');
