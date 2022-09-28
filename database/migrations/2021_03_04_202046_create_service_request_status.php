<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateServiceRequestStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_request_status', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar');
            $table->string('name_en');
        });

        DB::table('service_request_status')->insert([
            ['name_ar' => 'مقبول', 'name_en' => 'Accepted'],
            ['name_ar' => 'مستبعد', 'name_en' => 'Excluded'],
            ['name_ar' => 'انتظار الموافقة', 'name_en' => 'Waiting'],
            ['name_ar' => 'مكتمل', 'name_en' => 'Completed'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_request_status');
    }
}
