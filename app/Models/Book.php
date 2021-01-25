<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Models\User;

class Book extends Model
{
    use HasFactory;
    public function users()
    {
        return $this->belongsToMany(User::class,'rent_books','book_id','user_id')->withPivot('rent_date','return_book');
        
    }
}
