<?php

$body = getBody();

if (!empty($body['id'])) {

    $cateId = $body['id'];
    $cateNumRows = getRows("SELECT id FROM blog_categories WHERE id=$cateId");
    if ($cateNumRows > 0) {

        $blogNum = getRows("SELECT id FROM blog WHERE category_id=$cateId");

        if ($blogNum > 0) {
            setFlashData('msg', 'Không thể xóa danh mục .Trong danh mục vẫn còn ' . $blogNum . ' blog');
            setFlashData('msg_type', 'danger');
        } else {
            $condition = 'id=' . $cateId;

            $deleteStatus = delete('blog_categories', $condition);

            if (!empty($deleteStatus)) {
                setFlashData('msg', 'Xóa danh mục blog thành công');
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

redirect('?module=blog_categories');
