<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Detail</title>
    <style>
        .book-detail {
            border: 1px solid #ccc;
            padding: 20px;
            width: 50%;
            margin: 0 auto;
            box-sizing: border-box;
        }
        .book-detail img {
            max-width: 100%;
            height: auto;
        }
        .book-detail h3 {
            margin: 10px 0;
        }
        .book-detail p {
            margin: 5px 0;
        }
        .add-to-cart {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="book-detail">
        <img src="../images/<?php echo $book['image']; ?>" alt="">
        <h3><?php echo $book['title']; ?></h3>
        <p>Tác giả: <?php echo $book['author']; ?></p>
        <p>Nhà xuất bản: <?php echo $book['publisher']; ?></p>
        <p>Giá: <?php echo number_format($book['price'], 0, '', '.'); ?> VND</p>
        <p>Mô tả: <?php echo $book['description']; ?></p>
        <form action="cart.php" method="post">
            <input type="hidden" name="anhsp" value="<?php echo $book['image']; ?>">
            <input type="hidden" name="tensp" value="<?php echo $book['title']; ?>">
            <input type="hidden" name="gia" value="<?php echo $book['price']; ?>">
            <input type="submit" name="addcart" value="Đặt hàng" class="add-to-cart">
        </form>
    </div>
</body>
</html>
