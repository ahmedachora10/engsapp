<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateBanks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banks', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar');
            $table->string('name_en');
            $table->timestamps();
        });

        DB::table('banks')->insert([
            ['name_ar' => 'البنك الأهلي التجاري', 'name_en' => 'The National Commercial Bank'],
            ['name_ar' => 'البنك السعودي البريطاني - ساب', 'name_en' => 'The Saudi British Bank (SABB)'],
            ['name_ar' => 'البنك السعودي للاستثمار', 'name_en' => 'Saudi Investment Bank'],
            ['name_ar' => 'بنك الإنماء', 'name_en' => 'Alinma bank'],
            ['name_ar' => 'البنك السعودي الفرنسي', 'name_en' => 'Banque Saudi Fransi'],
            ['name_ar' => 'بنك الرياض', 'name_en' => 'Riyad Bank'],
            ['name_ar' => 'مجموعة سامبا المالية', 'name_en' => 'Samba Financial Group (Samba)'],
            ['name_ar' => 'البنك الأول', 'name_en' => 'Alawwal bank'],
            ['name_ar' => 'بنك الراجحي', 'name_en' => 'Al Rajhi Bank'],
            ['name_ar' => 'البنك العربي الوطني', 'name_en' => 'Arab National Bank'],
            ['name_ar' => 'بنك البلاد', 'name_en' => 'Bank AlBilad'],
            ['name_ar' => 'بنك الجزيرة', 'name_en' => 'Bank AlJazira'],
            ['name_ar' => 'بنك الخليج الدولي - السعودية', 'name_en' => 'Gulf International Bank Saudi Arabia (GIB-SA)'],
        ]);


        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('bank_id')->nullable()->constrained('banks');
            $table->string('iban_code')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['bank_id']);
            $table->dropColumn('bank_id');
            $table->dropColumn('iban_code');
        });

        Schema::dropIfExists('banks');
    }
}
