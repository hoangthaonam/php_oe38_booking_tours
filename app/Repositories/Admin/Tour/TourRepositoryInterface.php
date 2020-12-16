<?php
namespace App\Repositories\Admin\Tour;

interface TourRepositoryInterface {
    public function display();
    public function getCategory();
    public function checkTourExist($id);
}
?>