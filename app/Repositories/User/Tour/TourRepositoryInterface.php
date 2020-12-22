<?php

namespace App\Repositories\User\Tour;

interface TourRepositoryInterface {
    public function getTourPaginate();    
    public function checkTourExist($id);
    public function getTourReview($id);
    public function getTourComment($id);    
}
?>
