<?php

include_once  '../model/user.php';

$user = new User();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_user'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $role = $_POST['role'];
        $user->create($email, $password, $role);
        echo "Tài khoản đã được thêm thành công!";
    } elseif (isset($_POST['delete_account'])) {
        $account_id = $_POST['account_id'];
        $user->delete($account_id);
        echo "Tài khoản đã được xóa thành công!";
    }
}

$users = $user->readAll()->fetch_all(MYSQLI_ASSOC);

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
<div class="admin-container ">
    <div class="admin-header">
        <h1>Quản lý tài khoản</h1>
    </div>
    <div class="admin-form w85 m0">
        <form action="index.php?action=account" method="post">
            <input type="hidden" name="add_user" value="1">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br>
            <label for="password">Mật khẩu:</label>
            <input type="password" id="password" name="password" required><br>
            <select name="role" id="role">
                <option value='0'>User</option>
                <option value='1'>Admin</option>
            </select><br>
           
            <input type="submit" value="Thêm tài khoản">
        </form>
    </div>
    <div class="admin-table-container">
        <table class="admin-table" border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Mật khẩu</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($users) && is_array($users)) {
                    foreach ($users as $user) {
                        echo '<tr>
                                <td>' . $user['account_id'] . '</td>
                                <td>' . $user['email'] . '</td>
                                <td>' . $user['password'] . '</td>
                                <td>' . $user['role'] . '</td>
                                <td class="admin-actions">
                                    <form action="index.php?action=account" method="post" style="display:inline;">
                                        <input type="hidden" name="delete_account" value="1">
                                        <input type="hidden" name="account_id" value="' . $user['account_id'] . '">
                                        <input type="submit" value="Xóa">
                                    </form>
                                    
                                </td>
                            </tr>';
                    }
                } else {
                    echo '<tr><td colspan="4">Không có tài khoản nào.</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>