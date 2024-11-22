
<?php
if (isset($_SESSION['email'])) {
     echo '<h2 style="text-align: center;">Thông tin tài khoản</h2>';
     echo $_SESSION['email'];
} else {
     echo '<p style="text-align:center;">Bạn chưa đăng nhập vào tài khoản!!!</p>';
}
?>