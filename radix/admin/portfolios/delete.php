<?php

$body = getBody();

if (!empty($body['id'])) {

    $portfolioId = $body['id'];
    $portfolioNumRows = getRows("SELECT id FROM portfolios WHERE id=$portfolioId");
    if ($portfolioNumRows > 0) {

        $condition = 'id=' . $portfolioId;

        $deleteStatus = delete('portfolios', $condition);

        if (!empty($deleteStatus)) {
            setFlashData('msg', 'Xóa dự án thành công');
            setFlashData('msg_type', 'success');
        } else {
            setFlashData('msg', 'Xóa dự án không thành công, vui lòng thử lại sau');
            setFlashData('msg_type', 'danger');
        }
    } else {
        setFlashData('msg', 'Dự án không tồn tại trong hệ thống');
        setFlashData('msg_type', 'danger');
    }
} else {
    setFlashData('msg', 'Liên kết không tồn tại');
    setFlashData('msg_type', 'danger');
}

redirect('?module=portfolios');
