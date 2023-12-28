<?php

$body = getBody();

if (!empty($body['id'])) {

    $blogId = $body['id'];
    $blogDetail = firstRaw("SELECT * FROM blog WHERE id=$blogId");
    if (!empty($blogDetail)) {

        // cập nhật create at, xóa update at
        $blogDetail['create_at'] = date('d/m/Y H:i:s');
        unset($blogDetail['update_at']);
        unset($blogDetail['id']);
        $duplicate = $blogDetail['duplicate'];
        $duplicate++;
        $blogDetail['title'] = $blogDetail['title'] . ' (' . $duplicate . ')';

        $insertStatus = insert('blog', $blogDetail);

        if (!empty($insertStatus)) {
            setFlashData('msg', 'Nhân bản blog thành công');
            setFlashData('msg_type', 'success');

            update(
                'blog',
                [
                    'duplicate' => $duplicate
                ],
                "id=$blogId"
            );
        } else {
            setFlashData('msg', 'Lỗi hệ thống, vui lòng thử lại sau!');
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