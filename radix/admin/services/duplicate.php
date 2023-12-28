<?php

$body = getBody();

if (!empty($body['id'])) {

    $serviceId = $body['id'];
    $serviceDetail = firstRaw("SELECT * FROM services WHERE id=$serviceId");
    if (!empty($serviceDetail)) {

        // cập nhật create at, xóa update at
        $serviceDetail['create_at'] = date('d/m/Y H:i:s');
        unset($serviceDetail['update_at']);
        unset($serviceDetail['id']);
        $duplicate = $serviceDetail['duplicate'];
        $duplicate++;
        $serviceDetail['name'] = $serviceDetail['name'] . ' (' . $duplicate . ')';

        $insertStatus = insert('services', $serviceDetail);

        if (!empty($insertStatus)) {
            setFlashData('msg', 'Nhân bản dịch vụ thành công');
            setFlashData('msg_type', 'success');

            update(
                'services',
                [
                    'duplicate' => $duplicate
                ],
                "id=$serviceId"
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

redirect('?module=services');
