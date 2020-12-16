<?php

namespace App\Repositories\Admin\Category;
use App\Repositories\BaseRepository;
use App\Repositories\Admin\Category\CategoryRepositoryInterface;
use App\Models\Category;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface{

    public function getModel() 
    {        
        return \App\Models\Category::class;
    }

    public function getAllCategory()
    {
        return Category::with('parent')->get();
    }

    public function get()
    {
        return Category::get();
    }

    public function findExceptCategory($id)
    {
        return Category::where('categories_id','<>',$id)->get();
    }

    public function checkCategoryExist($id)
    {
        $cate = Category::find($id);
        if(!$cate){
            Session::flash('Error', trans('language.error.error_find'));
            return false;
        } else {
            return $cate;
        }
    }
}   
?>
