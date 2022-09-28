<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('profile_img')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone_number');
            $table->string('whatsapp_number')->nullable();
            $table->boolean('confirmed');
            $table->dateTime('confirmed_date')->nullable();
            $table->string('ipan_number')->nullable();
            $table->string('user_type');
            $table->string('nationality')->nullable();
            // $table->unsignedBigInteger('country_id')->nullable();
            // $table->foreign('country_id')->nullable()->references('id')->on('countries');
            // $table->foreignId('country_id')->nullable()->constrained('countries');

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
