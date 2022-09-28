<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateWebsitePercentageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('website_percentage', function (Blueprint $table) {
            $table->id();
            $table->decimal('percentage');
            $table->timestamps();
        });
        $main_perc = ['percentage' => 10];
        DB::table('website_percentage')->insert($main_perc);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('website_percentage');
    }
}
