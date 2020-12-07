<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';

    protected $primaryKey = "user_id";

    protected $fillable = [
        'username',
        'email', 
        'name', 
        'password',
        'address',
        'phone',
        'image',
        'role',
        'status',
        'provider', 
        'provider_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function ratings()
    {
        return $this->hasMany(Rating::class, 'user_id', 'user_id');
    }

    public function booktours()
    {
        return $this->hasMany(BookTour::class, 'user_id', 'user_id');
    }

    public function commentreviews()
    {
        return $this->hasMany(CommentReview::class, 'user_id', 'user_id');
    }

    public function likes()
    {
        return $this->hasMany(Like::class, 'user_id', 'user_id');
    }

    public function isAdmin()
    {
        return Auth::user()->role == config('app.admin_role');
    }
}
