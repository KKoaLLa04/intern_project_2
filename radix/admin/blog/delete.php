<?php

$body = getBody();

if (!empty($body['id'])) {

    $blogId = $body['id'];
    $blogNumRows = getRows("SELECT id FROM blog WHERE id=$blogId");
    if ($blogNumRows > 0) {

        $condition = 'id=' . $blogId;

        $deleteStatus = delete('blog', $condition);

        if (!empty($deleteStatus)) {
            setFlashData('msg', 'Xóa blog thành công');
            setFlashData('msg_type', 'success');
        } else {
            setFlashData('msg', 'Xóa blog không thành công, vui lòng thử lại sau');
            setFlashData('msg_type', 'danger');
        }
    } else {
        setFlashData('msg', 'Blog không tồn tại trong hệ thống');
        setFlashData('msg_type', 'danger');
    }
} else {
    setFlashData('msg', 'Liên kết không tồn tại');
    setFlashData('msg_type', 'danger');
}

redirect('?module=blog');
