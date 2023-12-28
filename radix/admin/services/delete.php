<?php

$body = getBody();

if (!empty($body['id'])) {

    $serviceId = $body['id'];
    $serviceNumRows = getRows("SELECT id FROM services WHERE id=$serviceId");
    if ($serviceNumRows > 0) {

        $condition = 'id=' . $serviceId;

        $deleteStatus = delete('services', $condition);

        if (!empty($deleteStatus)) {
            setFlashData('msg', 'Xóa dịch vụ thành công');
            setFlashData('msg_type', 'success');
        } else {
            setFlashData('msg', 'Xóa dịch vụ không thành công, vui lòng thử lại sau');
            setFlashData('msg_type', 'danger');
        }
    } else {
        setFlashData('msg', 'Dịch vụ không tồn tại trong hệ thống');
        setFlashData('msg_type', 'danger');
    }
} else {
    setFlashData('msg', 'Liên kết không tồn tại');
    setFlashData('msg_type', 'danger');
}

redirect('?module=services');
