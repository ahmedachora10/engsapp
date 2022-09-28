<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('offer_status_id')->constrained('offer_status');
            $table->foreignId('request_id')->constrained('requests');
            $table->decimal('offer_price');
            $table->string('expected_period')->nullable();
            $table->decimal('offer_price_total');
            $table->text('offer_desc');
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

        Schema::table('offers', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['offer_status_id']);
            $table->dropForeign(['request_id']);
            $table->dropSoftDeletes();
        });



        Schema::dropIfExists('offers');
    }
}
