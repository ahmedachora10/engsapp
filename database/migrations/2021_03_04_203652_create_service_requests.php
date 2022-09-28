<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceRequests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->id();

            $table->foreignId('service_id')->constrained('services');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('service_request_stage_id')->constrained('service_request_stages');

            $table->string('title');
            $table->string('expected_period')->nullable();
            $table->decimal('budget_min')->nullable();
            $table->decimal('budget_max')->nullable();
            $table->date('deadline_date');
            $table->text('description')->nullable();
            $table->string('address')->nullable();
            $table->decimal('location_lat')->nullable();
            $table->decimal('location_lng')->nullable();
            $table->boolean('canceled')->default(0);

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
        Schema::table('requests', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['service_id']);
            $table->dropForeign(['service_request_stage_id']);
        });
        Schema::dropIfExists('requests');
    }
}
