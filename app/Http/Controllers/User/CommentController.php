<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CommentReview;
use App\Component\CommentRecursive;
use App\Repositories\User\Comment\CommentRepositoryInterface;
use Auth;


class CommentController extends Controller
{
    protected $commentRepo;

    public function __construct(CommentRepositoryInterface $commentRepo) {
        $this->commentRepo = $commentRepo;
    }

    public function create(Request $request)
    {
        if(Auth::check()){
            $comment['type'] = config('app.comment_type');
            $comment['user_id'] = Auth::user()->user_id;
            $comment['tour_id'] = (int)$request->tour_id;
            $comment['content'] = $request->content;
            $comment['parent_id'] = (int)$request->cmr_id;
            $comment['status'] = 0;
            $this->commentRepo->create($comment);
            $listComments = $this->commentRepo->getTourComment($request->tour_id);
            $commentRecursive = new CommentRecursive();
            $response = $commentRecursive->recursive($listComments);

            return $response;
        } else {
            Session::flash('Error', 'Login first');
            return redirect()->route('login');
        }
    }

    public function update(Request $request)
    {
        if(Auth::check()){
            $comment['content'] = $request->content;
            $this->commentRepo->update($request->cmr_id, $comment);
            $listComments = $this->commentRepo->getTourComment($request->tour_id);
            $commentRecursive = new CommentRecursive();
            $response = $commentRecursive->recursive($listComments);
            return $response;
        } else {
            Session::flash('Error', 'Login first');
            return redirect()->route('login');
        }
    }
    public function destroy(Request $request)
    {
        $cmr_id = (int)($request->cmr_id);
        $this->commentRepo->delete($cmr_id);
        $commentRecursive = new CommentRecursive();
        $listComments = $this->commentRepo->getTourComment($request->tour_id);
        $commentRecursive = new CommentRecursive();
        $response = $commentRecursive->recursive($listComments);
        return $response;
    }
}
