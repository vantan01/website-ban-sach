<?php
include_once ROOT_DIR . '/model/Book.php';

class BookController
{
    public $book;

    public function __construct()
    {
        $this->book = new Book();
    }

    public function getBooks()
    {
        $stmt = $this->book->readAll();
        return $stmt->fetch_all(MYSQLI_ASSOC);
    }
    public function getBooksByCategory($category_id)
    {
        $stmt = $this->book->readBooksByCategory($category_id);
        return $stmt->fetch_all(MYSQLI_ASSOC);
    }
    public function addBook($title, $author, $publisher, $price, $description, $category_id, $stock, $image)
    {
        $this->book->create($title, $author, $publisher, $price, $description, $category_id, $stock, $image);
    }

    public function deleteBook($book_id)
    {
        $this->book->delete($book_id);
    }

    public function editBook($book_id, $title, $author, $publisher, $price, $description, $category_id, $stock, $image)
    {
        $this->book->update($book_id, $title, $author, $publisher, $price, $description, $category_id, $stock, $image);
    }
    public function getAllAuthors()
    {
        $stmt = $this->book->getAllAuthors();
        return $stmt->fetch_all(MYSQLI_ASSOC);
    }
}
