
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
        case 'orders':
            include 'admin_orders.php';
            break;
        case 'account':
            include 'admin_account.php';
            break;
        case 'books':
            include 'admin_books.php';
            break;
        case 'pagelogout':
            unset($_SESSION['role']);
            break;
        default:
            include 'dashboard.php';
            break;
    }

    // include './footer.php';
} else {
    header('location: ../php/main.php');
}

?>
