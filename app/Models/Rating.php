<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rating extends Model
{
    protected $table = "rating";
    
    protected $primaryKey = "rating_id";

    protected $fillable = [
        'name', 
        'user_id', 
        'tour_id',
        'rating',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function tour()
    {
        return $this->belongsTo(Tour::class, 'tour_id', 'tour_id');
    }
}
