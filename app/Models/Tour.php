<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tour extends Model
{
    protected $table = "tours";

    protected $primaryKey = "tour_id";

    protected $fillable = [
        'name', 
        'image', 
        'slug', 
        'place_from', 
        'place_to', 
        'place_tobe', 
        'duration', 
        'price',
        'hotel_star',
        'des', 
        'quantity_people',
        'booking_number',
        'category_id',
        'status',
    ];

    public function bookdetails()
    {
        return $this->hasMany(BookTourDetails::class,'tour_id','tour_id');
    }

    public function commentreviews()
    {
        return $this->hasMany(CommentReview::class,'tour_id','tour_id');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class,'tour_id','tour_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id','categories_id');
    }
}
