<?php

$body = getBody();

if (!empty($body['id'])) {

    $pageId = $body['id'];
    $pageNumRows = getRows("SELECT id FROM pages WHERE id=$pageId");
    if ($pageNumRows > 0) {

        $condition = 'id=' . $pageId;

        $deleteStatus = delete('pages', $condition);

        if (!empty($deleteStatus)) {
            setFlashData('msg', 'Xóa trang thành công');
            setFlashData('msg_type', 'success');
        } else {
            setFlashData('msg', 'Xóa trang không thành công, vui lòng thử lại sau');
            setFlashData('msg_type', 'danger');
        }
    } else {
        setFlashData('msg', 'Trang không tồn tại trong hệ thống');
        setFlashData('msg_type', 'danger');
    }
} else {
    setFlashData('msg', 'Liên kết không tồn tại');
    setFlashData('msg_type', 'danger');
}

redirect('?module=pages');
