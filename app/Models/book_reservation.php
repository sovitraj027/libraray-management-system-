<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class book_reservation extends Model
{
    use HasFactory;
   protected $fillbale=['user_id','book_id','reserve_date','reservation_date'];


   public function users(){
    return $this->hasMany(User::class);
   }
}
