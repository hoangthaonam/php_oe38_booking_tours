<?php

namespace App\Repositories\User\Review;

interface ReviewRepositoryInterface{
    public function getReview($cmr_id);
    public function checkReviewExist($review);
    public function getReviewTour($cmr_id);
}
?>
