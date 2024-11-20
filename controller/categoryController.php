<?php
include_once ROOT_DIR .'/model/category.php';

class CategoryController {
    public $category;

    public function __construct() {
        $this->category = new Category();
    }

    public function getCategories() {
        $stmt = $this->category->readAll();
        return $stmt->fetch_all(MYSQLI_ASSOC);
    }

    public function addCategory($name) {
        $this->category->create($name);
    }

    public function deleteCategory($category_id) {
        $this->category->delete($category_id);
    }

    public function editCategory($category_id, $name) {
        $this->category->update($category_id, $name);
    }
}

