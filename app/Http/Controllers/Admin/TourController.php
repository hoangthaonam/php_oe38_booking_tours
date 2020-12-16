<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tour;
use App\Models\Category;
use App\Http\Requests\TourRequest;
use App\Repositories\Admin\Tour\TourRepositoryInterface;
use Session;

class TourController extends Controller
{
    protected $tourRepo; 

    public function __construct(TourRepositoryInterface $tourRepo) {
        $this->tourRepo = $tourRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tours = $this->tourRepo->display();
        return view('admin.pages.tour.index', compact('tours'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->tourRepo->getCategory();
        return view('admin.pages.tour.create_tour', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TourRequest $request)
    {
        $tour = $request->all();
        $tour['slug'] = str_slug($request->name);
        $tour['booking_number'] = 0;
        $tour['image'] = $request->file('image') ? $this->getImage($request->file('image')) : 'default.jpg';
        $this->tourRepo->create($tour);
        return redirect()->route('admin.tour.index');
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
        $tour = $this->tourRepo->checkTourExist($id);
        if($tour){
            $categories = $this->tourRepo->getCategory();
            return view('admin.pages.tour.edit_tour', compact('tour','categories'));
        } else {
            return redirect()->route('admin.tour.index');  
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TourRequest $request, $id)
    {
        $tour = $request->except('image');
        $tour['image'] = $request->file('image') ? $this->getImage($request->file('image')) : 'default.jpg';
        $result = $this->tourRepo->update($id, $tour);
        if(!$result){
            Session::flash('Error', trans('language.error.error_find'));
        }
        return redirect()->route('admin.tour.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tour = $this->tourRepo->checkTourExist($id);
        if($tour){
            $this->tourRepo->delete($id);
        }
        return redirect()->route('admin.tour.index');
    }

    public function getImage($imageFile)
    {
        $imageName = 'default.jpg';
        if ($imageFile->isValid()){
            $imageName = $imageFile->getClientOriginalName();
            $imageFile->move('upload', $imageName);
        }
        return $imageName;
    }
}
