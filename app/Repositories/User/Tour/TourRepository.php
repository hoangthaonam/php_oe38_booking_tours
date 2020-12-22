<?php

namespace App\Repositories\User\Tour;
use App\Repositories\BaseRepository;
use App\Repositories\User\Tour\TourRepositoryInterface;
use App\Models\Tour;
use App\Models\CommentReview;

class TourRepository extends BaseRepository implements TourRepositoryInterface {

    public function getModel()
    {
        return \App\Models\Tour::class;
    }

    public function getTourPaginate(){
        return Tour::paginate(config('app.paginate_number'));
    } 

    public function checkTourExist($id){
        $tour = Tour::find($id);
        if(!$tour){
            Session::flash('Error', trans('language.error.error_find'));
            return false;
        } else {
            return $tour;
        }
    }

    public function getTourReview($id){
        return $reviews = CommentReview::with('tour')
                    ->where('tour_id', $id)
                    ->where('type', config('app.review_type'))
                    ->get();
    }
    
    public function getTourComment($id){
        return $comments = CommentReview::with('user')
                    ->where('type', config('app.comment_type'))
                    ->where('tour_id', $id)
                    ->get();
    }   
}
?>
