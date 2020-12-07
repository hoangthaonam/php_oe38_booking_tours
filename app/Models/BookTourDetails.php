<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookTourDetails extends Model
{
    protected $table = "booktourdetails";
    
    protected $primaryKey = "booktourdetails_id";

    protected $fillable = [ 
        'tour_id', 
        'booktour_id',
        'tour_name',
        'quantity_people',
        'price',
        'status',
    ];

    public function booktour()
    {
        return $this->belongsTo(BookTour::class,'booktour_id','booktour_id');
    }

    public function tour()
    {
        return $this->belongsTo(Tour::class,'tour_id','tour_id');
    }
}
