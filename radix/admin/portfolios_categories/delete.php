<?php

$body = getBody();

if (!empty($body['id'])) {

    $cateId = $body['id'];
    $cateNumRows = getRows("SELECT id FROM portfolios_categories WHERE id=$cateId");
    if ($cateNumRows > 0) {

        $portfolioNum = getRows("SELECT id FROM portfolios WHERE portfolio_categories_id=$cateId");

        if ($portfolioNum > 0) {
            setFlashData('msg', 'Không thể xóa danh mục .Trong danh mục vẫn còn ' . $portfolioNum . ' dự án');
            setFlashData('msg_type', 'danger');
        } else {
            $condition = 'id=' . $cateId;

            $deleteStatus = delete('portfolios_categories', $condition);

            if (!empty($deleteStatus)) {
                setFlashData('msg', 'Xóa danh mục dự án thành công');
                setFlashData('msg_type', 'success');
            } else {
                setFlashData('msg', 'Xóa danh mục dự án không thành công, vui lòng thử lại sau');
                setFlashData('msg_type', 'danger');
            }
        }
    } else {
        setFlashData('msg', 'Danh mục dự án không tồn tại trong hệ thống');
        setFlashData('msg_type', 'danger');
    }
} else {
    setFlashData('msg', 'Liên kết không tồn tại');
    setFlashData('msg_type', 'danger');
}

redirect('?module=portfolios_categories');
