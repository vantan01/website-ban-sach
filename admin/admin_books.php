<?php

include_once  '../controller/bookController.php';

$book = new BookController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_book'])) {
        $title = $_POST['title'];
        $author = $_POST['author'];
        $publisher = $_POST['publisher'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $category_id = $_POST['category_id'];
        $stock = $_POST['stock'];
        $image = $_POST['image'];
        // move_uploaded_file();
        $book->addBook($title, $author, $publisher, $price, $description, $category_id, $stock, $image);
        echo "Sách đã được thêm thành công!";
    } elseif (isset($_POST['delete_book'])) {
        $book_id = $_POST['book_id'];
        $book->deleteBook($book_id);
        echo "Sách đã được xóa thành công!";
    } elseif (isset($_POST['update_book'])) {
        $book_id = $_POST['book_id'];
        $title = $_POST['title'];
        $author = $_POST['author'];
        $publisher = $_POST['publisher'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $category_id = $_POST['category_id'];
        $stock = $_POST['stock'];
        $image = $_POST['image'];
        // move_uploaded_file();
        $book->editBook($book_id, $title, $author, $publisher, $price, $description, $category_id, $stock, $image);
        echo "Sách đã được cập nhật thành công!";
    }
}

$books = $book->getBooks();
?>
<div class="admin-container ">
    <div class="admin-header">
        <h1>Quản lý Sách</h1>
    </div>
    <div class="admin-form w85 m0">
        <form action="index.php?action=books" method="post" enctype="multipart/form-data">
            <input type="hidden" name="add_book" value="1">
            <label for="title">Tiêu đề:</label>
            <input type="text" id="title" name="title"><br>
            <label for="author">Tác giả:</label>
            <input type="text" id="author" name="author"><br>
            <label for="publisher">Nhà xuất bản:</label>
            <input type="text" id="publisher" name="publisher"><br>
            <label for="price">Giá:</label>
            <input type="number" step="1000" id="price" name="price"><br>
            <label for="category_id">ID Danh mục:</label>
            <input type="number" id="category_id" name="category_id"><br>
            <label for="stock">Số lượng:</label>
            <input type="number" id="stock" name="stock"><br>
            <label for="image">Hình ảnh:</label>
            <input type="text" id="image" name="image"><br>
            <label for="description">Mô tả:</label>
            <textarea rows="5" cols="70" id="description" name="description" style="resize: none;"></textarea><br>
            <input type="submit" value="Thêm sách">
        </form>
    </div>
    <div class="admin-table-container">
        <table class="admin-table" border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tiêu đề</th>
                    <th>Tác giả</th>
                    <th>Nhà xuất bản</th>
                    <th>Giá</th>
                    <th>Mô tả</th>
                    <th>ID Danh mục</th>
                    <th>Số lượng</th>
                    <th>Hình ảnh</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($books) && is_array($books)) {
                    foreach ($books as $book) {
                        echo '<tr>
                                <td>' . $book['book_id'] . '</td>
                                <td>' . $book['title'] . '</td>
                                <td>' . $book['author'] . '</td>
                                <td>' . $book['publisher'] . '</td>
                                <td>' . $book['price'] . '</td>
                                <td>' . $book['description'] . '</td>
                                <td>' . $book['category_id'] . '</td>
                                <td>' . $book['stock'] . '</td>
                                <td>' . $book['image'] . '</td>
                                <td class="admin-actions">
                                    <form action="admin_books.php" method="post" style="display:inline;">
                                        <input type="hidden" name="delete_book" value="1">
                                        <input type="hidden" name="book_id" value="' . $book['book_id'] . '">
                                        <input type="submit" value="Xóa">
                                    </form>
                                    <form action="admin_books.php" method="post" style="display:inline;">
                                        <input type="hidden" name="update_book" value="1">
                                        <input type="hidden" name="book_id" value="' . $book['book_id'] . '">
                                        <input type="text" name="title" value="' . $book['title'] . '">
                                        <input type="text" name="author" value="' . $book['author'] . '">
                                        <input type="text" name="publisher" value="' . $book['publisher'] . '">
                                        <input type="number" step="1000" name="price" value="' . $book['price'] . '">
                                        <textarea name="description">' . $book['description'] . '</textarea>
                                        <input type="number" name="category_id" value="' . $book['category_id'] . '">
                                        <input type="number" name="stock" value="' . $book['stock'] . '">
                                        <input type="text" name="image" value="' . $book['image'] . '">
                                        <input type="submit" value="Cập nhật">
                                    </form>
                                </td>
                            </tr>';
                    }
                } else {
                    echo '<tr><td colspan="10">Không có sách nào.</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>