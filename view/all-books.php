<?php
include ROOT_DIR . '/controller/categoryController.php';
include '../controller/BookController.php';

$bookController = new BookController();
$books = $bookController->getBooks();
$authors = $bookController->getAllAuthors();



$categoryCotroller = new CategoryController();
$categories = $categoryCotroller->getCategories();
?>

<main class="main">
    <!-- aside -->
    <div class="row left">
        <div class="aside">
            <!-- co nhieu item -->

            <div class="aside-item">
                <div class="aside-title">
                    <span> ALL CATEGORIES</span>
                </div>
                <div class="aside-content">
                    <ul>
                        <?php
                        if (isset($categories) && is_array($categories)) {
                            foreach ($categories as $category) {
                                echo '
                                        <li><a href="#">' . $category["name"] . '</a></li>
                                    ';
                            }
                        } else {
                            echo 'Chưa có danh mục nào';
                        }
                        ?>
                    </ul>
                </div>
            </div>

            <div class="aside-item">
                <div class="aside-title">
                    <span> AUTHOR</span>
                </div>
                <div class="aside-content">
                    <ul>
                        <?php
                        if (isset($authors) && is_array($authors)) {
                            foreach ($authors as $author) {
                                echo '
                                        <li><a href="#">' . $author['author'] . '</a></li>
                                    ';
                            }
                        } else {
                            echo 'Chưa có danh mục nào';
                        }
                        ?>
                    </ul>
                </div>
            </div>


        </div>
    </div>

    <!-- category -->
    <div class="row right">
        <div class="section">
            <div class="title-category w68">
                <span>ALL BOOKS</span>
            </div>
            <div class="product-grid wrap grid-4">
                <!-- hien thi toan bo sach -->
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
                        echo '<form action="../controller/cartController.php" method="post">
                                    <input type="hidden" name="id" value="' . $book['book_id'] . '">
                                    <input type="hidden" name="anhsp" value="' . $book['image'] . '">
                                    <input type="hidden" name="tensp" value="' . $book['title'] . '">
                                    <input type="hidden" name="gia" value="' . $book['price'] . '">
                                    <input type="submit" name="addcart" value="Đặt hàng" class="add-to-cart"';
                        if (!$in_stock) echo ' style="background-color:transparent;color: transparent; cursor:unset " disabled ';
                        echo ' >
                                </form>
                            </div>';
                    }
                } else {
                    echo 'Không có sách nào trong danh sách.';
                }
                ?>
            </div>
        </div>
        <div class="change-page grid-4">
            <button class="btn-change-page">1</button>
            <button class="btn-change-page">2</button>
            <button class="btn-change-page">3</button>
            <button class="btn-change-page"> ... </button>
            <button class="btn-change-page">100</button>
        </div>
    </div>
</main>