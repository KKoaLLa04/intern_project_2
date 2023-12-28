<?php

$body = getBody();

if (!empty($body['id'])) {

    $pageId = $body['id'];
    $pageDetail = firstRaw("SELECT * FROM pages WHERE id=$pageId");
    if (!empty($pageDetail)) {

        // cập nhật create at, xóa update at
        $pageDetail['create_at'] = date('d/m/Y H:i:s');
        unset($pageDetail['update_at']);
        unset($pageDetail['id']);
        $duplicate = $pageDetail['duplicate'];
        $duplicate++;
        $pageDetail['title'] = $pageDetail['title'] . ' (' . $duplicate . ')';

        $insertStatus = insert('pages', $pageDetail);

        if (!empty($insertStatus)) {
            setFlashData('msg', 'Nhân bản dịch vụ thành công');
            setFlashData('msg_type', 'success');

            update(
                'pages',
                [
                    'duplicate' => $duplicate
                ],
                "id=$pageId"
            );
        } else {
            setFlashData('msg', 'Lỗi hệ thống, vui lòng thử lại sau!');
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

redirect('?module=pages');
