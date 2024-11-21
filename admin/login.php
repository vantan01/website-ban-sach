<?php
include '../model/user.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
ob_start();

if ((isset($_POST['login'])) && ($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    // unset($_SESSION['role']);
    $account = new Account();

    $result = $account->getUser($email, $password);
    //check email bị trùng trước
    if (!empty($result)) {
        switch ($result['role']) {
            case '1':
                $_SESSION['role'] = $result['role'];
                header('Location: index.php');
                break;
            case '0':
                $_SESSION['role'] = $result['role'];
                $_SESSION['email'] = $result['email'];
                $_SESSION['account_id'] = $result['account_id'];
                header('Location: ../php/main.php?act=account');
                break;
            default:
                echo 'Sai email hoặc mật khẩu!!!';
        }
    } else {
        echo 'Sai email hoặc mật khẩu!!!';
    }
}
?>
<main class="main">
    <form action="../admin/login.php" method="post" class="register">
        <div class="form-title">
            <span>Đăng nhập</span>
        </div>
        <input placeholder="Email" type="email" name="email" value="admin@test.com" required>
        <input placeholder="Mật khẩu" type="password" name="password" value="admin" required>
        <input type="submit" name="login" value="Đăng nhập">
    </form>
    <span>Bạn chưa có tài khoản, vui lòng đăng ký <u><a href="../php/main.php?act=register">tại đây</a></u></span>
</main>