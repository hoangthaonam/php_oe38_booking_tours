<?php
namespace App\Repositories\Tour;

interface TourRepositoryInterface {
    public function display();
    public function getCategory();
    public function checkTourExist($id);
}
?>