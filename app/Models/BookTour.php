<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookTour extends Model
{
    use SoftDeletes;

    protected $table = "booktour";

    protected $primaryKey = "booktour_id";
    
    protected $fillable = [ 
        'user_id', 
        'payment_id',
        'status',
    ];

    public function booktourdetails()
    {
        return $this->hasMany(BookTourDetails::class,'booktour_id','booktour_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class, 'booktour_id', 'booktour_id');
    }
}
