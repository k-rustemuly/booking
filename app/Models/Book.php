<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'housing_id',
        'check_in',
        'check_out',
        'user_id',
    ];

    protected $casts = [
        'check_in' => 'datetime',
        'check_out' => 'datetime',
    ];

    public function housing()
    {
        return $this->belongsTo(Housing::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
