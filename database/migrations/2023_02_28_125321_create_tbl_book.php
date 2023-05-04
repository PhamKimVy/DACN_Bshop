<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblBook extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_book', function (Blueprint $table) {
            $table->increments('book_id');
            $table->integer('publisher_id');
            $table->integer('category_id');
            $table->string('book_name');
            $table->string('book_price');
            $table->string('book_image');
            $table->text('book_desc');//mô tả sách
            $table->text('book_content');// nội dung sách
            $table->integer('book_status');
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
        Schema::dropIfExists('tbl_book');
    }
}
