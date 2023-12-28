<?php

if (isLogin()) {
    redirect();
}

autoRemoveTokenLogin();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo !empty($data['pageTitle']) ? $data['pageTitle'] : false ?></title>

    <!-- Link boostrap4 -->
    <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE_ADMIN ?>/assets/css/adminlte.min.css">

    <!-- Link style -->
    <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE_ADMIN ?>/assets/css/style.css?ver=<?php echo rand() ?>">
</head>

<body>