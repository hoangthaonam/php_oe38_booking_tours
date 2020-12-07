<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Like extends Model
{
    protected $table = "likes";
    
    protected $primaryKey = "like_id";

    protected $fillable = [ 
        'user_id', 
        'review_id',
        'status',
    ];

    public function review()
    {
        return $this->belongsTo(CommentReview::class,'review_id', 'cmr_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','user_id');
    }

}
