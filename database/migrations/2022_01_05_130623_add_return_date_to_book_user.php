<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReturnDateToBookUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('book_user', function (Blueprint $table) {
            $table->dateTime('return_date')->after('borrow_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
        if(Schema::hasColumn('book_user','return_date')){
            Schema::table('book_user', function (Blueprint $table) {
               $table->dropColumn('return_date');
            });
        }
        // Schema::table('book_user', function (Blueprint $table) {
            
        // });
    }
}
