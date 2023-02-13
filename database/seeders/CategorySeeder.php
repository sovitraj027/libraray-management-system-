<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Science Fiction',
                'slug' => 'science_fiction',
            ],
            [
                'name' => 'History',
                'slug' => 'history',
            ],
            [
                'name' => 'Romance',
                'slug' => 'romance',
            ],
            [
                'name' => 'Suspense Thriller',
                'slug' => 'suspense_thriller',
            ],
            [
                'name' => 'Horror',
                'slug' => 'horror',
            ],
            [
                'name' => 'Self Help',
                'slug' => 'self_help',
            ],
        ];

        DB::table('categories')->insert($categories);
    }
}
