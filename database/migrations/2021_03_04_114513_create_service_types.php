<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateServiceTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained('services');
            $table->string('name');
        });

        DB::table('service_types')->insert([
            ['name' => 'خدمات تنفيذ مشاريع', 'service_id' => 1],
            ['name' => 'خدمات طلب استشارة', 'service_id' => 2],
            ['name' => 'خدمات تحكيم بين طرفي', 'service_id' => 3],
            ['name' => 'خدمات طلب زيارة موقع', 'service_id' => 4],
            ['name' => 'خدمات طلب ترخيص', 'service_id' => 5],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_types');
    }
}
