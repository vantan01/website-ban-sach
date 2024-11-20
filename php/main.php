<?php
session_start();
define('ROOT_DIR', dirname(__DIR__));
include_once ROOT_DIR .'/view/header.php';

$act = isset($_GET['act']) ? $_GET['act'] : '';

switch ($act) {
    case 'cart':
        include ROOT_DIR .'/view/cart_view.php';
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
        // case 'cart':
        //     include '../view/cart.php';
        //     break;
        // case 'about':
        //     include '../view/about.php';
        //     break;
    default:
        include ROOT_DIR .'/view/home.php';
        break;
}

include ROOT_DIR .'/view/footer.php';
