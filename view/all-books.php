<?php
include ROOT_DIR . '/controller/categoryController.php';
include '../controller/bookController.php';

$bookModel = new Book();
$bookController = new BookController();
$categoryCotroller = new CategoryController();


$authors = $bookController->getAllAuthors();

$categories = $categoryCotroller->getCategories();
$limit = 12;
$page = isset($_POST['page']) ? $_POST['page'] : 1;
$start = ($page - 1) * $limit;
$category_id = isset($_GET['category_id']) ? $_GET['category_id'] : null;
if ($category_id) {
    $books = $bookController->getBooksByCategory($category_id);
} else {
    $books = $bookModel->getBooksFrom($start, $limit);
}

$total_books = $bookModel->getTotalBooks();
$total_pages = ceil($total_books / $limit);
?>

<main class="main">
    <!-- aside -->
    <div class="row left">
        <div class="aside">
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
                                        <li><a href="../php/main.php?act=allbooks&category_id='.$category["category_id"].'">' . $category["name"] . '</a></li>
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
                    echo '<p>Không có sách nào trong danh sách.</p>';
                }
                ?>
            </div>
        </div>
        <div class="change-page grid-4"> 
            <form id="paginationForm" action="../php/main.php?act=allbooks" method="post">
                <input type="hidden" name="page" id="pageInput"> 
                <?php for ($i = 1; $i <= $total_pages; $i++): ?> 
                <button type="button" class="btn-change-page" onclick="changePage(<?= $i ?>)">
                    <?= $i ?>
                </button> 
                <?php endfor; ?> 
            </form>
        </div>
    </div>
</main>



<script> 
function changePage(page) { 
    document.getElementById('pageInput').value = page; 
    document.getElementById('paginationForm').submit(); 
}
</script>