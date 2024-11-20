<?php
include '../model/user.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
ob_start();

if ((isset($_POST['login'])) && ($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    // unset($_SESSION['role']);
    $account = new Account();
    $role = $account->checkUser($username, $password);
        if ($role==1) {
            $_SESSION['role'] = $role;
            header('location: ../admin/index.php');
        }elseif(is_null($role)){
            echo 'tai khoan khong ton tai';
        }
         else {
            // khi tai khoan khong phai admin
            header('location: ../php/main.php');
        }
}
?>
<main class="main">
    <form action="../admin/login.php" method="post" class="register">
        <div class="form-title">
            <span>Đăng nhập</span>
        </div>
        <input placeholder="Email" type="email" name="username" value="admin@test.com" required>
        <input placeholder="Mật khẩu" type="password" name="password" value="admin" required>
        <input type="submit" name="login" value="Đăng nhập">
    </form>
    <span>Bạn chưa có tài khoản, vui lòng đăng ký <u><a href="../php/main.php?act=register">tại đây</a></u></span>
</main>