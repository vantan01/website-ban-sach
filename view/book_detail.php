<?php
include_once '../controller/bookController.php';
// Lấy dữ liệu từ form
if (isset($_GET['id']) && $_GET['id'] > 0) {
    $id = $_GET['id'];
    $book = new BookController();
    $kq = $book->getBookById($id);
    $soluong = $_GET['quantity'] ?? 1;
    $in_stock = $kq['stock'] != 0;
    if ($soluong > $kq['stock']) { $soluong = $kq['stock'];}
    echo '<div class="book-detail w68">
                <div class="left">
                    <img src="../images/' . $kq['image'] . '" alt="">
                </div>
                <div class="right flex ">
                    <div class="book-detail-item">
                        <h3>' . $kq['title'] . '</h3>
                        <p>Tác giả: ' . $kq['author'] . '</p>
                        <p>Giá: ' . $kq['price'] . ' VND</p>
                        <p>Nhà xuất bản: ' . $kq['publisher'] . '</p>
                    </div>
                    <div class="book-detail-item"> 
                    <form action="../controller/cartController.php?" method="post">

                        <input type="hidden" name="id" value="' . $kq['book_id'] . '">
                        <input type="hidden" name="anhsp" value="' . $kq['image'] . '">
                        <input type="hidden" name="tensp" value="' . $kq['title'] . '">
                        <input type="hidden" name="gia" value="' . $kq['price'] . '">
                        <input type="hidden" name="instock" value="' .$kq['stock'] . '">
                        <label>Số lượng</label>
                        <div class="quantity">
                            <i class="fa-solid fa-caret-up increment" onclick="updateQuantity(1,this)"></i>
                            <input type="number" min="-100" max="'.$kq['stock'].'" name="quantityincart" value="' . $soluong . '" >
                            <i class="fa-solid fa-caret-down decrement" onclick="updateQuantity(-1,this)"></i>
                        </div><br>';
    if ($kq['stock'] == 0) {
        echo '<input value="Hết hàng" class="add-to-cart" disabled>';
    } else {
        echo '<input type="submit" name="addcart" value="Thêm vào giỏ hàng" class="add-to-cart">';
    }
    echo '</form>
                    </div>
                    
                </div>
                <div class="description clear">
                    <p>Mô tả: ' . $kq['description'] . '</p>

                </div>
            </div>';
} else {
    echo "<script>alert('Có lỗi xảy ra =<');</script>";
}
