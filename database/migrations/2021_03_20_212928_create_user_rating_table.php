<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserRatingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_rating', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rater_user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('rated_user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('request_id')->constrained('requests')->onDelete('cascade');
            $table->integer('rate_speed');
            $table->integer('rate_quality');
            $table->integer('rate_cost');
            $table->double('rating_value');
            $table->text('review_msg');
            $table->boolean('admin_isshown');
            $table->boolean('admin_isread');
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
        Schema::table('user_rating', function (Blueprint $table) {
            $table->dropForeign(['rater_user_id']);
            $table->dropForeign(['rated_user_id']);
            $table->dropForeign(['request_id']);
        });

        Schema::dropIfExists('user_rating');
    }
}
