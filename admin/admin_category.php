<?php
// define('ROOT_DIR', dirname(__DIR__));
include  ROOT_DIR . '/controller/CategoryController.php';

$categoryController = new CategoryController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_category'])) {
        $category_name = $_POST['category_name'];
        $categoryController->addCategory($category_name);
        echo "Danh mục đã được thêm thành công!";
    } elseif (isset($_POST['del_category'])) {
        $category_id = $_POST['category_id'];
        $categoryController->deleteCategory($category_id);
        echo "Danh mục đã được xóa thành công!";
    }
}

$categories = $categoryController->getCategories();

?>
<style>
        .admin-container {
            width: 90%;
            margin: 0 auto;
            font-family: Arial, sans-serif;
        }
        .admin-header h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        .admin-table-container {
            margin-bottom: 20px;
        }
        .admin-table {
            width: 100%;
            border-collapse: collapse;
        }
        .admin-table th, .admin-table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        .admin-table th {
            background-color: #f4f4f4;
        }
        .admin-actions form {
            display: inline;
            margin: 0 5px;
        }
        .admin-actions input[type="submit"] {
            padding: 5px 10px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }
        .admin-actions input[type="submit"]:hover {
            background-color: #0056b3;
        }
        #order-items-container {
            display: none;
        }
        #order-items-container h2 {
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
<div class="admin-container">
    <div class="admin-header">
        <h1>Quản lý Danh mục</h1>
    </div>
    <div class="admin-form">
        <form action="<?php ROOT_DIR . '/controller/categoryController.php' ?>" method="post">
            <input type="text" name="category_name">
            <input type="submit" value="Thêm danh mục" name="add_category">
    </div>
    <div class="admin-table-container">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên danh mục</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($categories) && is_array($categories)) {
                    foreach ($categories as $category) {
                        echo '<tr>
                                <td>' . $category['category_id'] . '</td>
                                <td>' . $category['name'] . '</td>
                                <td class="admin-actions">
                                    <form action="index.php?action=category" method="get" style="display:inline;">
                                        <input type="hidden" name="action" value="edit">
                                        <input type="hidden" name="category_id" value="' . $category['category_id'] . '">
                                        <input type="text" name="name" value="' . $category['name'] . '">
                                        <input type="submit" value="Sửa">
                                    </form>
                                    <form action="index.php?action=category" method="post" style="display:inline;">
                                        <input type="hidden" name="action" value="delete">
                                        <input type="hidden" name="category_id" value="' . $category['category_id'] . '">
                                        <input type="submit" value="Xóa" name="del_category">
                                    </form>
                                </td>
                            </tr>';
                    }
                } else {
                    echo '<tr><td colspan="3">Không có danh mục nào.</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<style>
    .admin-container {
        width: 80%;
        margin: 0 auto;
    }

    .admin-header {
        text-align: center;
        margin-bottom: 20px;
    }

    .admin-form {
        margin-bottom: 20px;
    }

    .admin-table {
        width: 100%;
        border-collapse: collapse;
    }

    .admin-table th,
    .admin-table td {
        border: 1px solid #ccc;
        padding: 10px;
        text-align: left;
    }

    .admin-table th {
        background-color: #f4f4f4;
    }

    .admin-actions {
        display: flex;
        gap: 10px;
    }
</style>