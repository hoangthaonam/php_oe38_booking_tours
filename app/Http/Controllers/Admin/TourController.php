<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tour;
use App\Models\Category;
use App\Http\Requests\TourRequest;
use Session;

class TourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tours = Tour::with('category')->get();
        return view('admin.pages.tour.index', compact('tours'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();
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
        Tour::create($tour);
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
        $tour = $this->checkTourExist($id);
        if($tour){
            $categories = Category::get();
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
        $tour = $this->checkTourExist($id);
        if($tour){
            $tour->fill($request->except('image'));
            $tour['image'] = $request->file('image') ? $this->getImage($request->file('image')) : 'default.jpg';
            $tour->save();
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
        Tour::find($id)->delete();
        return redirect()->route('admin.tour.index');
    }

    public function checkTourExist($id)
    {
        $tour = Tour::find($id);
        if(!$tour){
            Session::flash('Error', trans('language.error.error_find'));
            return false;
        } else {
            return $tour;
        }
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
