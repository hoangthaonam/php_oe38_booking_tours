<?php

namespace App\Repositories\Tour;
use App\Repositories\BaseRepository;
use App\Models\Category;
use Session;

class TourRepository extends BaseRepository implements TourRepositoryInterface{

    public function getModel()
    {
        return \App\Models\Tour::class;
    }

    public function display()
    {
        return $this->model::with('category')->get();
    }

    public function getCategory()
    {
        return $categories = Category::get();
    }

    public function checkTourExist($id)
    {
        $tour = $this->model::find($id);
        if(!$tour){
            Session::flash('Error', trans('language.error.error_find'));
            return false;
        } else {
            return $tour;
        }
    }
}
?>