<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateRequestsLatlangColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('requests', function (Blueprint $table) {
            // $table->point('latlng_point')
            $table->float('xPoint', 10, 6)->nullable()->after('address');
            $table->float('yPoint', 10, 6)->nullable()->after('xPoint');
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
            $table->dropColumn(['xPoint']);
            $table->dropColumn(['yPoint']);
        });
    }
}
