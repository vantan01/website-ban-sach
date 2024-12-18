<?php
include_once '../controller/CartController.php';
?>

<main class="main">
    <div class="slider">
        <div class="slides">
            <img src="../images/website-slider-banner-modern-ecommerce-books-business-web-header-ui-kit-easily-editable-vector_927063-260.jpg" class="slide" alt="">
            <img src="../images/website-slider-banner-modern-ecommerce-books-business-web-header-ui-kit-easily-editable-vector_927063-260.jpg" class="slide" alt="">
            <img src="../images/website-slider-banner-modern-ecommerce-books-business-web-header-ui-kit-easily-editable-vector_927063-260.jpg" class="slide" alt="">
        </div>
        <div class="dots">
            
        </div>
    </div>

    <div class="section-about">

    </div>
    <div class="section">
        <div class="title-category w85 m0">
            <span>SÁCH MỚI</span>
        </div>
        <div class="product-nav">
            <div class="prev">
                <i class="fa-solid fa-chevron-left"></i>
            </div>
            <div class="next">
                <i class="fa-solid fa-chevron-right"></i>
            </div>
        </div>
        <div class="product-grid nowrap grid-5">
            <?php
            include_once '../controller/BookController.php';
            $bookController = new BookController();

            $category_id = 1; // hard code
            $books = $bookController->getBooksByCategory($category_id);
            if (isset($books) && is_array($books)) {
                foreach ($books as $book) {
                    $in_stock = $book['stock'] != 0;
                    echo '<div class="book-item">
                            <a href="../php/main.php?act=detail&id=' . $book['book_id'] . '">
                                <img src="../images/' . $book['image'] . '" alt="">
                            </a>
                            <a href="../php/main.php?act=detail&id=' . $book['book_id'] . '">
                                <h3 class="ellipsis">' . $book['title'] . '</h3>
                            </a>
                            <p>' . number_format($book['price'], 0, '', '.') . ' VND</p>';
                    if (!$in_stock) {
                        echo '<span> Hết hàng</span>';
                    } else {
                        echo '<span> Số lượng: '.$book['stock'].'</span>';
                    }
                    echo '<form action="../controller/cartController.php" method="post">
                                <input type="hidden" name="id" value="' . $book['book_id'] . '">
                                <input type="hidden" name="anhsp" value="' . $book['image'] . '">
                                <input type="hidden" name="tensp" value="' . $book['title'] . '">
                                <input type="hidden" name="gia" value="' . $book['price'] . '">
                                <input type="hidden" name="instock" value="' .  $book['stock'] . '">';
                                if ($in_stock) {
                                    echo '<input type="submit" name="addcart" value="Đặt hàng" class="add-to-cart">';
                                } else {
                                    echo '<input value="Hết hàng" class="out-of-stock"  disabled>';
                                }
                    echo '
                            </form>
                        </div>';
                }
            } else {
                echo 'Không có sách nào trong danh sách.';
            }
            ?>
            <!-- Repeat book-item for other books -->
        </div>
    </div>
    <div class="section-banner w85">
        <img src="../images/banner.jpg" alt="">
    </div>
    
</main>