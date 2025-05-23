<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Housing extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
    ];

    public function books()
    {
        return $this->hasMany(Book::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
