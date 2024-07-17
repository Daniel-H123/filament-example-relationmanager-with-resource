<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    public function relatedBooks()
    {
        return $this->hasMany(Book::class, 'category', 'category')->whereNot('id', $this->id);
    }
}
