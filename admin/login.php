<?php
include '../model/user.php';
$email_validation_regex = '/^\\S+@\\S+\\.\\S+$/';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
ob_start();
if (isset($_POST['register']) && $_POST['register']) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (preg_match($email_validation_regex, $email)) {
        $user = new User();
        if ($user->create($email, $password)) {
            $_SESSION['role'] = 0;
            $_SESSION['email'] = $email;
            $_SESSION['account_id'] = $result['account_id'];
            if ($_SESSION['redirect_to'] == 'pagepayment') {
                header('Location: ../php/main.php?act=pagepayment');
            }
            header('Location: ../php/main.php?act=account');
        } else {
            echo '<script>alert(" Đăng ký tài khoản không thành công ");</script>';
        }
    } else {
        echo '<script>alert("Email không hợp lệ");</script>';
    }
}
if ((isset($_POST['login'])) && ($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $user = new User();
    $result = $user->getUser($email, $password);
    echo empty(!$result);
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

                if ($_SESSION['redirect_to'] == 'pagepayment') {
                    header('Location: ../php/main.php?act=pagepayment');
                    break;
                }
                header('Location: ../php/main.php?act=account');
                break;
            default:
                // echo '<script>alert("Sai email hoặc mật khẩu");</script>';
                header('Location: ../php/main.php?act=pagelogin');
        }
    } else {
        header('Location: ../php/main.php?act=pagelogin');
    }
}

?>
<main class="main" style="text-align: center;">
    <form action="../admin/login.php" method="post" class="register">
        <div class="form-title">
            <span>Đăng nhập</span>
        </div>
        <input placeholder="Email" type="email" name="email" value="user@test.com" required>
        <input placeholder="Mật khẩu" type="password" name="password" value="user" required>
        <input type="submit" name="login" value="Đăng nhập">
    </form>
    <span>Bạn chưa có tài khoản, vui lòng đăng ký <u><a href="../php/main.php?act=pageregister">tại đây</a></u></span>
</main>