<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsTrendingToBooks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('books', function (Blueprint $table) {
            $table->tinyInteger('is_trending')->default('0')->after('category_id')->comment('1=trending,0=not trending');
            $table->tinyInteger('status')->default('0')->after('is_trending')->comment('1=visible,0=Invisible');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('books', function (Blueprint $table) {
                  $table->dropColumn('is_trending');
                  $table->dropColumn('status');

        });
    }
}
