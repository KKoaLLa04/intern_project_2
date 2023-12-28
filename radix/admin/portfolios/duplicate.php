<?php

$body = getBody();

if (!empty($body['id'])) {

    $portfolioId = $body['id'];
    $portfolioDetail = firstRaw("SELECT * FROM portfolios WHERE id=$portfolioId");
    if (!empty($portfolioDetail)) {

        // cập nhật create at, xóa update at
        $portfolioDetail['create_at'] = date('d/m/Y H:i:s');
        unset($portfolioDetail['update_at']);
        unset($portfolioDetail['id']);
        $duplicate = $portfolioDetail['duplicate'];
        $duplicate++;
        $portfolioDetail['name'] = $portfolioDetail['name'] . ' (' . $duplicate . ')';

        $insertStatus = insert('portfolios', $portfolioDetail);

        if (!empty($insertStatus)) {
            setFlashData('msg', 'Nhân bản dự án thành công');
            setFlashData('msg_type', 'success');

            update(
                'portfolios',
                [
                    'duplicate' => $duplicate
                ],
                "id=$portfolioId"
            );
        } else {
            setFlashData('msg', 'Lỗi hệ thống, vui lòng thử lại sau!');
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
