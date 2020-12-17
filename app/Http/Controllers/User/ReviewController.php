<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CommentReview;
use App\Http\Requests\ReviewRequest;
use App\Repositories\User\Review\ReviewRepositoryInterface;
use Auth;
use Session;

class ReviewController extends Controller
{
    protected $reviewRepo;

    public function __construct(ReviewRepositoryInterface $reviewRepo) {
        $this->middleware('auth')->except(['show']);
        $this->reviewRepo = $reviewRepo;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReviewRequest $request)
    {
        $reviews = $request->all();
        $reviews['user_id'] = Auth::user()->user_id;
        $reviews['type'] = config('app.review_type');
        $newReview = $this->reviewRepo->create($reviews);
        return redirect()->route('review.show', $newReview->cmr_id);
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($cmr_id)
    {
        $review = $this->reviewRepo->getReview($cmr_id);
        $review = $this->reviewRepo->checkReviewExist($review);
        if($review){
            return view('client.layouts.review_detail', compact('review'));
        } else {
            return redirect()->route('user.tour.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ReviewRequest $request, $cmr_id)
    {
        $review = $this->reviewRepo->find($cmr_id);
        $review = $this->reviewRepo->checkReviewExist($review);
        if($review){
            if (Auth::user()->can('update', $review)) {
                $this->reviewRepo->update($review->cmr_id, $request->all());
                return redirect()->route('review.show',$review->cmr_id);
            } else {
                Session::flash('Error',trans('language.error_edit_review'));
                return redirect()->route('review.show', $cmr_id);
            }
        } else {
            return redirect()->route('user.tour.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($cmr_id)
    {
        $review = $this->reviewRepo->find($cmr_id);
        $review = $this->reviewRepo->checkReviewExist($review);
        if($review){
            $tour = $this->reviewRepo->getReviewTour($cmr_id);
            if (Auth::user()->can('delete', $review)) {
                $this->reviewRepo->delete($cmr_id);
                return redirect()->route('user.tour.show', $tour->tour_id);
            } else {
                Session::flash('Error',trans('language.error_delete_review'));
                return redirect()->route('review.show', $cmr_id);
            }
        } else {
            return redirect()->route('user.tour.index');
        }
    }
}
