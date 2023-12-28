<?php

if (!empty(getSession('loginToken'))) {
    $token = getSession('loginToken');
    delete('login_token', "token='$token'");
    removeSession('loginToken');
    redirect('?module=auth&action=login');
} else {
    removeSession('loginToken');
}
