<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BookTour;
use App\Models\BookTourDetails;
use App\Http\Requests\BookTourRequest;
use Auth;

class BookTourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $booktours = BookTour::with('payment')->where('user_id', Auth::user()->user_id)->get();
        return view('client.layouts.mytour', compact('booktours'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookTourRequest $request)
    {
        $booktour['user_id'] = Auth::user()->user_id;
        $newBooktour = BookTour::create($booktour);
        $booktourdetails['tour_id'] = $request->tour_id;
        $booktourdetails['booktour_id'] = $newBooktour->booktour_id;
        $booktourdetails['tour_name'] = $request->name;
        $booktourdetails['quantity_people'] = $request->quantity_people;
        $booktourdetails['price'] = $request->amount;
        $booktourdetails =  BookTourDetails::create($booktourdetails);
        return redirect()->route('booking.infor',$booktourdetails->booktourdetails_id);
    }
    
    public function displayBookingInformation($id)
    {
        $booktourdetails = BookTourDetails::find($id);
        return view('client.layouts.booktour_detail', compact('booktourdetails'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
