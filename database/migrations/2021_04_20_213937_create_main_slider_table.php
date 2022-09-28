<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMainSliderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('main_slider', function (Blueprint $table) {
            $table->id();
            $table->string('title_ar');
            $table->string('title_en');
            $table->string('small_desc_ar');
            $table->string('small_desc_en');
            $table->text('desc_ar');
            $table->text('desc_en');
            $table->string('button_text_ar');
            $table->string('button_text_en');
            $table->string('linkTo');
            $table->string('image');
            $table->integer('order');
            $table->boolean('isenabled');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('main_slider');
    }
}
