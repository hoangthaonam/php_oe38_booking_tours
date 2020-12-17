<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tour;
use App\Models\CommentReview;
use App\Component\CommentRecursive;
use App\Repositories\User\Tour\TourRepositoryInterface;
use Auth;

class TourController extends Controller
{
    protected $tourRepo;

    public function __construct(TourRepositoryInterface $tourRepo) {
        $this->tourRepo = $tourRepo;
    }
    
    public function index()
    {
        $tours = $this->tourRepo->getTourPaginate();
        return view('client.pages.tour.index', compact('tours'));
    }

    public function show($id)
    {
        $tour = $this->tourRepo->checkTourExist($id);
        if($tour){
            $reviews = $this->tourRepo->getTourReview($id);
            $comments = $this->tourRepo->getTourComment($id);
            $commentRecursive = new CommentRecursive();
            $comment_data = $commentRecursive->recursive($comments);
            return view('client.layouts.tour_details', compact('tour', 'reviews', 'comment_data'));
        }
    }
}
