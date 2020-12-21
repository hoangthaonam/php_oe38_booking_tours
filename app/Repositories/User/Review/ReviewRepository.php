<?php

namespace App\Repositories\User\Review;
use App\Repositories\BaseRepository;
use App\Repositories\User\Review\ReviewRepositoryInterface;
use App\Models\CommentReview;
use Session;

class ReviewRepository extends BaseRepository implements ReviewRepositoryInterface{

    public function getModel()
    {
        return \App\Models\CommentReview::class;
    }
    
    public function getReview($cmr_id)
    {
        return CommentReview::with('tour','user')->find($cmr_id);
    }

    public function getReviewTour($cmr_id){
        return CommentReview::find($cmr_id)->tour()->first();
    }

    public function checkReviewExist($review)
    {
        if(!$review){
            Session::flash('Error', trans('language.error.error_find'));
            return false;
        } else {
            return $review;
        }
    }
}
?>
