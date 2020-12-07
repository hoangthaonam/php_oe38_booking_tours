<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    protected $table = "categories";
    
    protected $primaryKey = "categories_id";

    protected $fillable = [
        'name', 
        'parent_id', 
        'status',
    ];

    public function tours()
    {
        return $this->hasMany(Tour::class,'category_id','categories_id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class,'parent_id','categories_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class,'parent_id','categories_id');
    }
}
