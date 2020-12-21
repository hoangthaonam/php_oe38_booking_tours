<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BookTour;
use App\Models\BookTourDetails;
use App\Http\Requests\BookTourRequest;
use App\Repositories\User\BookTour\BookTourRepositoryInterface;
use Auth;

class BookTourController extends Controller
{
    protected $booktourRepo;

    public function __construct(BookTourRepositoryInterface $booktourRepo) {
        $this->booktourRepo = $booktourRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $booktours = $this->booktourRepo->getOwnerBookTour();
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
        $data = $request->all();
        $booktourdetails = $this->booktourRepo->createNewBookTour($data);
        return redirect()->route('booking.infor',$booktourdetails->booktourdetails_id);
    }
    
    public function displayBookingInformation($id)
    {
        $booktourdetails = $this->booktourRepo->find($id);
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
