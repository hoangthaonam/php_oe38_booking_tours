<?php

namespace App\Repositories\Admin\Category;

interface CategoryRepositoryInterface {
    public function getAllCategory();
    public function get();
    public function checkCategoryExist($id);
}
?>
