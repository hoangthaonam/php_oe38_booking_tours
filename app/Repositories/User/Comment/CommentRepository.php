<?php

namespace App\Repositories\User\Comment;
use App\Repositories\User\Comment\CommentRepositoryInterface;
use App\Repositories\BaseRepository;
use App\Models\CommentReview;

class CommentRepository extends BaseRepository implements CommentRepositoryInterface{

    public function getModel()
    {
        return \App\Models\CommentReview::class;
    }

    public function getTourComment($id){
        return $listComments = CommentReview::with('user')
                        ->where('type', config('app.comment_type'))
                        ->where('tour_id', $id)
                        ->get();
    }
}
?>
