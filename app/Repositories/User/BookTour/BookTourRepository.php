<?php

namespace App\Repositories\User\BookTour;
use App\Repositories\BaseRepository;
use App\Repositories\User\BookTour\BookTourRepositoryInterface;
use App\Models\BookTour;
use App\Models\BookTourDetails;
use Auth;

class BookTourRepository extends BaseRepository implements BookTourRepositoryInterface{

    public function getModel()
    {
        return \App\Models\BookTour::class;
    }

    public function getOwnerBookTour()
    {
        return BookTour::with('payment')->where('user_id', Auth::user()->user_id)->get();
    }

    public function createNewBookTour($data)
    {
        $booktour['user_id'] = Auth::user()->user_id;
        $newBooktour = BookTour::create($booktour);
        $data['booktour_id'] = $newBooktour->booktour_id;
        return $booktourdetails =  BookTourDetails::create($data);
    }
}
?>
