<?php
session_start();

//creates admin session
function createAdminSession($admin){
    $_SESSION['admin_id'] = $admin->id;
    $_SESSION['admin_name'] = $admin->name;
    $_SESSION['admin_email'] = $admin->email;
}

//redirects guest to a different page
function guestRedirect($link = '/'){
    if (!isset($_SESSION['admin_id'])){
        header('location: '.$link);
    }
}

//redirects admin to a different page
function adminRedirect($link = '/admin/dashboard'){
    if (isset($_SESSION['admin_id'])){
        header('location: '.$link);
    }
}