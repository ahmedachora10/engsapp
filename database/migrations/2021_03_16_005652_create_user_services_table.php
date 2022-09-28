<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('service_category_id')->constrained('service_categories');
            // $table->foreignId('request_id')->constrained('requests');
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
        Schema::table('user_services', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['service_category_id']);
            // $table->dropSoftDeletes();
        });
        
        Schema::dropIfExists('user_services');
    }
}
