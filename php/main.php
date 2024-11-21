<?php
session_start();
define('ROOT_DIR', dirname(__DIR__));
include_once ROOT_DIR .'/view/header.php';

$act = isset($_GET['act']) ? $_GET['act'] : '';

switch ($act) {
    case 'cart':
        include ROOT_DIR .'/view/cart_view.php';
        break;
    case 'detail':
        include ROOT_DIR .'/view/book_detail.php';
        break;
    case 'register':
        include ROOT_DIR .'/view/register.php';
        break;
    case 'allbooks':
        include ROOT_DIR .'/view/all-books.php';
        break;
    case 'contact':
        include ROOT_DIR .'/view/contact.php';
        break;
    case 'pagelogin':
        include '../admin/login.php';
        break;
    case 'pagelogout':
        if(isset($_SESSION['role']))
            unset($_SESSION['role']);
        if(isset($_SESSION['email']))
            unset($_SESSION['email']);
        if(isset($_SESSION['account_id']))
            unset($_SESSION['account_id']);
        header('location: ../php/main.php');
        break;
    case 'account':
        include '../view/account.php';
        break;
    default:
        include ROOT_DIR .'/view/home.php';
        break;
}

include ROOT_DIR .'/view/footer.php';
