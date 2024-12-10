<?php

include ROOT_DIR . '/controller/bookController.php';
include ROOT_DIR . '/controller/categoryController.php';

$bookModel = new Book();
$bookController = new BookController();
$categoryCotroller = new CategoryController();

$categories = $categoryCotroller->getCategories();
$query = isset($_POST['query']) ? $_POST['query'] : '';
$books = $bookModel->searchBooks($query);

$total_books = count($books);
?>

<main class="main">
    <!-- hiển thị kết quả tìm kiếm -->
    <div class="row right">
        <div class="section">
            <div class="title-category w68">
                <span>Kết quả tìm kiếm cho "<?php echo htmlspecialchars($query); ?>"</span>
            </div>
            <div class="product-grid wrap grid-4">
                <?php
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
                            echo '<span> Còn hàng</span>';
                        }
                        echo '<form action="../controller/cartController.php?stock=' . $book['stock'] . '" method="post">
                                    <input type="hidden" name="id" value="' . $book['book_id'] . '">
                                    <input type="hidden" name="anhsp" value="' . $book['image'] . '">
                                    <input type="hidden" name="tensp" value="' . $book['title'] . '">
                                    <input type="hidden" name="gia" value="' . $book['price'] . '">';
                        if ($in_stock) {
                            echo '<input type="submit" name="addcart" value="Đặt hàng" class="add-to-cart">';
                        } else {
                            echo '<input value="Hết hàng" class=" out-of-stock" disabled>';
                        }
                        echo '
                                </form>
                            </div>';
                    }
                } else {
                    echo 'Không có kết quả nào phù hợp với từ khóa của bạn.';
                }
                ?>
            </div>
        </div>
    </div>
</main>

