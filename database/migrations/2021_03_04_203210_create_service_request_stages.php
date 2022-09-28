<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateServiceRequestStages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_request_stages', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar');
            $table->string('name_en');
        });

        DB::table('service_request_stages')->insert([
            ['name_ar' => 'تلقي العروض', 'name_en' => 'Waiting offers'],
            ['name_ar' => 'قبول العرض', 'name_en' => 'Accepting offers'],
            ['name_ar' => 'التنفيذ', 'name_en' => 'Implementation'],
            ['name_ar' => 'التسليم', 'name_en' => 'Delivering'],
            ['name_ar' => 'مكتمل', 'name_en' => 'Completed'],
            ['name_ar' => 'تم الالغاء', 'name_en' => 'Canceled'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_request_stages');
    }
}
