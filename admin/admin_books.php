<?php

include_once  '../controller/bookController.php';

$book = new BookController();


if (isset($_POST['addbook']) && $_POST['addbook']) {
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

$books = $book->getBooks();
?>
<style>
    .admin-container {
        width: 90%;
        margin: 0 auto;
        font-family: Arial, sans-serif;
    }

    .admin-header h1 {
        text-align: center;
        margin-bottom: 20px;
        color: #333;
    }

    .admin-table-container {
        margin-bottom: 20px;
    }

    .admin-table {
        width: 100%;
        border-collapse: collapse;
    }

    .admin-table th,
    .admin-table td {
        padding: 10px;
        border: 1px solid #ddd;
        text-align: left;
    }

    .admin-table th {
        background-color: #f4f4f4;
    }

    .admin-actions form {
        display: inline;
        margin: 0 5px;
    }

    .admin-actions input[type="submit"] {
        padding: 5px 10px;
        background-color: #007bff;
        color: white;
        border: none;
        cursor: pointer;
    }

    .admin-actions input[type="submit"]:hover {
        background-color: #0056b3;
    }

    #order-items-container {
        display: none;
    }

    #order-items-container h2 {
        text-align: center;
        margin-bottom: 10px;
    }
</style>
<div class="admin-container ">
    <div class="admin-header">
        <h1>Quản lý Sách</h1>
    </div>
    <div class="admin-form w85 m0">
        <form method="post" enctype="multipart/form-data">
            <div class="field">
                <input type="text" id="title" name="title" placeholder="Tên sách"><br>

                <input type="hidden" name="add_book" value="1" placeholder=" ">
            </div>
            <div class="field">
                <input type="text" id="author" name="author" placeholder=" Tác giả"><br>

            </div>
            <div class="field">
                <input type="text" id="publisher" name="publisher" placeholder=" Nhà xuất bản"><br>

            </div>
            <div class="field">
                <input type="number" step="1000" id="price" name="price" placeholder=" giá"><br>

            </div>
            <div class="field">
                <input type="number" id="category_id" name="category_id" placeholder="Danh mục "><br>

            </div>
            <div class="field">
                <input type="number" id="stock" name="stock" placeholder=" Số lượng"><br>

            </div>
            <div class="field">
                <input type="text" id="image" name="image" placeholder=" Hình ảnh"><br>

            </div>
            <div class="field">

                <textarea rows="5" cols="70" id="description" name="description" style="resize: none;" placeholder="Mô tả"></textarea><br>
            </div>
            <input type="submit" name="addbook" value="Thêm sách">
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
                                    <form action="index.php?action=books" method="post" style="display:inline;">
                                        <input type="hidden" name="delete_book" value="1">
                                        <input type="hidden" name="book_id" value="' . $book['book_id'] . '">
                                        <input type="submit" value="Xóa">
                                    </form>
                                    <form action="index.php?action=books" method="post" style="display:inline;">
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