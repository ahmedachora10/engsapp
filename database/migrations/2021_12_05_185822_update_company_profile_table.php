<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCompanyProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_profile', function (Blueprint $table) {
            $table->string('city')->default('');
            $table->string('area')->default('');
        });

        Schema::table('freelancer_profile', function (Blueprint $table) {
            $table->string('city')->default('');
            $table->string('area')->default('');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
