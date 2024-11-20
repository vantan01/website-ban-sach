<?php
session_start();
ob_start();
if (isset($_SESSION['role']) && $_SESSION['role'] == 1) {

    define('ROOT_DIR', dirname(__DIR__));
    include './header.php';
    include './menu.php';

    $action = isset($_GET['action']) ? $_GET['action'] : '';

    switch ($action) {
        case 'category':
            include 'admin_category.php';
            break;
        case 'books':
            include 'admin_books.php';
            break;
        default:
            include 'dashboard.php';
            break;
    }

    include './footer.php';
} else {
    header('location: ../php/main.php');
}
