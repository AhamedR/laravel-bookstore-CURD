<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblbooks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->year('year_of_publish');
            $table->double('amount', 8, 2);
            $table->string('isbn')->unique();
            $table->string('medium');
            $table->string('image');
            $table->string('author_id');
            $table->string('cat_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
