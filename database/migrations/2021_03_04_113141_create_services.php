<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateServices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar');
            $table->string('name_en');
        });

        DB::table('services')->insert([
            ['name_ar' => 'تنفيذ مشاريع', 'name_en' => 'Projects implementation'],
            ['name_ar' => 'طلب استشارة', 'name_en' => 'Request a consultation '],
            ['name_ar' => 'تحكيم بين طرفي', 'name_en' => 'Eng. Arbitration'],
            ['name_ar' => 'طلب زيارة موقع', 'name_en' => 'Visit location'],
            ['name_ar' => 'طلب ترخيص', 'name_en' => 'Request a licence'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
}
