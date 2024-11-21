<div class="main">
    <?php

    ob_start();
    $action = isset($_GET['action']) ? $_GET['action'] : '';

    switch ($action) {
        case 'category':
            include 'admin_category.php';
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
    ?>
</div>