<?php

$data = [
    'pageTitle' => 'Đăng nhập hệ thống',
];

layout('header_login', 'admin', $data);

// Chặn quay trở lại đăng nhập
// if (isLogin()) {
//     redirect('?module=users');
// }

if (isPost()) {

    $body = getBody();

    if (!empty(trim($body['username'])) && !empty(trim($body['password']))) {
        $email = trim($body['username']);

        $queryToken = firstRaw("SELECT id,password FROM users WHERE email='$email' AND status=1");

        if (!empty($queryToken)) {
            $password = trim($body['password']);
            $passwordHash = $queryToken['password'];

            if (password_verify($password, $passwordHash)) {
                // Đăng nhập thành công

                // user_id (FK)
                $user_id = $queryToken['id'];

                // Tạo link token
                $token = sha1(uniqid() . time());

                $dataInsert = [
                    'user_id' => $user_id,
                    'token' => $token,
                    'create_at' => date('Y-m-d H:i:s'),
                ];

                $insertTokenStatus = insert('login_token', $dataInsert);

                if (!empty($insertTokenStatus)) {

                    // Tạo session đăng nhập
                    setSession('loginToken', $token);
                    redirect();
                } else {
                    setFlashData('msg', 'Lỗi hệ thống! Vui lòng thử lại sau');
                    setFlashData('msg_type', 'danger');
                }
            } else {
                setFlashData('msg', 'Mật khẩu không chính xác');
                setFlashData('msg_type', 'danger');
            }
        } else {
            setFlashData('msg', 'Email không tồn tại trong hệ thống hoặc chưa được kích hoạt');
            setFlashData('msg_type', 'danger');
        }
    } else {
        setFlashData('msg', 'Vui lòng nhập email và mật khẩu');
        setFlashData('msg_type', 'danger');
        redirect('?module=auth&action=login');
    }
}


$msg = getFlashData('msg');
$msg_type = getFlashData('msg_type');
?>

<div class="container" style="margin: 0 auto; max-width: 900px;">
    <form action="" method="post">
        <h3 class="text-center my-4">Đăng nhập hệ thống</h3>
        <?php
        getMsg($msg, $msg_type);
        ?>
        <div class="form-group">
            <label for="">Tài khoản</label>
            <input type="text" placeholder="Tài khoản đăng nhập..." name="username" class="form-control">
            <p></p>
        </div>

        <div class="form-group">
            <label for="">Mật khẩu</label>
            <input type="password" placeholder="Mật khẩu đăng nhập..." name="password" class="form-control">
            <p></p>
        </div>

        <button class="btn btn-primary form-control">Đăng nhập</button>
    </form>
    <br>
    <p class="text-center"><a href="?module=auth&action=forgot">Quên mật khẩu</a></p>
</div>

<?php

layout('footer_login', 'admin');
