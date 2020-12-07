<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommentReview extends Model
{
    protected $table = "commentreviews";
 
    protected $primaryKey = "cmr_id";
    
    protected $fillable = [ 
        'user_id', 
        'tour_id',
        'title',
        'content',
        'type',
        'parent_id',
        'status',
    ];

    public function parent()
    {
        return $this->belongsTo(CommentReview::class,'parent_id','cmr_id');
    }

    public function children()
    {
        return $this->hasMany(CommentReview::class,'parent_id','cmr_id');
    }

    public function likes()
    {
        return $this->hasMany(Like::class,'review_id','cmr_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','user_id');
    }

    public function tour()
    {
        return $this->belongsTo(Tour::class,'tour_id','tour_id');
    }
}
