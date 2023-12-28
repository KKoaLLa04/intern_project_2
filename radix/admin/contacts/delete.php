<?php

$body = getBody();

if (!empty($body['id'])) {

    $contactId = $body['id'];
    $contactNumRows = getRows("SELECT id FROM contacts WHERE id=$contactId");
    if ($contactNumRows > 0) {

        $condition = 'id=' . $contactId;

        $deleteStatus = delete('contacts', $condition);

        if (!empty($deleteStatus)) {
            setFlashData('msg', 'Xóa liên hệ thành công');
            setFlashData('msg_type', 'success');
        } else {
            setFlashData('msg', 'Xóa liên hệ không thành công, vui lòng thử lại sau');
            setFlashData('msg_type', 'danger');
        }
    } else {
        setFlashData('msg', 'Liên hệ không tồn tại trong hệ thống');
        setFlashData('msg_type', 'danger');
    }
} else {
    setFlashData('msg', 'Liên kết không tồn tại');
    setFlashData('msg_type', 'danger');
}

redirect('?module=contacts');
