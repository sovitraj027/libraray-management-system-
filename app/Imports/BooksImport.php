<?php

namespace App\Imports;

use App\Models\Book;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\withheadingrow;
use Illuminate\Support\Str;

class BooksImport implements ToModel,withheadingrow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

       $date=Carbon::parse($row['published_at'])->format('Y-m-d');
       
        return new Book([

            'id'=>$row['id'],
            'name'     => $row['name'],
            'slug'    => Str::slug($row['name']),
            'description' => $row['description'],
            'publisher'  => $row['publisher'],
            'published_at'=> $date,
            'quantity'    => $row['quantity'],
            'category_id' => $row['category_id'],
        ]);
    }
}
