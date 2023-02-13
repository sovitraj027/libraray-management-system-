<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class book_history extends Model
{
    use HasFactory;
    protected $fillbale=['book_id','quantity','user_id'];
}
