<?php

$body = getBody();

if (!empty($body['id'])) {

    $cateId = $body['id'];
    $cateDetail = firstRaw("SELECT * FROM blog_categories WHERE id=$cateId");
    if (!empty($cateDetail)) {

        // cập nhật create at, xóa update at
        $cateDetail['create_at'] = date('d/m/Y H:i:s');
        unset($cateDetail['update_at']);
        unset($cateDetail['id']);
        $duplicate = $cateDetail['duplicate'];
        $duplicate++;
        $cateDetail['name'] = $cateDetail['name'] . ' (' . $duplicate . ')';

        $insertStatus = insert('blog_categories', $cateDetail);

        if (!empty($insertStatus)) {
            setFlashData('msg', 'Nhân bản danh mục thành công');
            setFlashData('msg_type', 'success');

            update(
                'blog_categories',
                [
                    'duplicate' => $duplicate
                ],
                "id=$cateId"
            );
        } else {
            setFlashData('msg', 'Lỗi hệ thống, vui lòng thử lại sau!');
            setFlashData('msg_type', 'danger');
        }
    } else {
        setFlashData('msg', 'Danh mục không tồn tại trong hệ thống');
        setFlashData('msg_type', 'danger');
    }
} else {
    setFlashData('msg', 'Liên kết không tồn tại');
    setFlashData('msg_type', 'danger');
}

redirect('?module=blog_categories');