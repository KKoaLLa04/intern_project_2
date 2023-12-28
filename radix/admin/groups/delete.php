<?php

$body = getBody();

if (!empty($body['id'])) {

    $groupId = $body['id'];
    $groupNumRows = getRows("SELECT id FROM groups WHERE id=$groupId");
    if ($groupNumRows > 0) {

        $userNum = getRows("SELECT id FROM users WHERE group_id=$groupId");

        if ($userNum > 0) {
            setFlashData('msg', 'Không thể xóa nhóm người dùng .Trong nhóm vẫn còn ' . $userNum . ' người dùng');
            setFlashData('msg_type', 'danger');
        } else {
            $condition = 'id=' . $groupId;

            $deleteStatus = delete('groups', $condition);

            if (!empty($deleteStatus)) {
                setFlashData('msg', 'Xóa nhóm người dùng thành công');
                setFlashData('msg_type', 'success');
            } else {
                setFlashData('msg', 'Xóa nhóm người dùng không thành công, vui lòng thử lại sau');
                setFlashData('msg_type', 'danger');
            }
        }
    } else {
        setFlashData('msg', 'Nhóm người dùng không tồn tại trong hệ thống');
        setFlashData('msg_type', 'danger');
    }
} else {
    setFlashData('msg', 'Liên kết không tồn tại');
    setFlashData('msg_type', 'danger');
}

redirect('?module=groups');
