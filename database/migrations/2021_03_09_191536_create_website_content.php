<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebsiteContent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('website_content', function (Blueprint $table) {
            $table->id();
            $table->string('page_name');
            $table->string('page_name_text');
            $table->string('section_name');
            $table->string('section_name_text');
            $table->string('paragraph_name');
            $table->string('paragraph_name_text');
            $table->text('content_ar');
            $table->text('content_en');
            $table->string('icon_name')->nullable();
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('website_content');
    }
}
