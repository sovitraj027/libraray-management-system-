<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'image', 'description', 'publisher_name','rack_number','author_name','price','subject_name', 'published_at', 'quantity', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function rating(){
       return $this->belongsTo(Rating::class,'id','book_id');
    }
}
