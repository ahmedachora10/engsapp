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
            $table->string('licence_copy_fileName')->default('')->after('license_copy');
            $table->boolean('licence_confirmed')->default(false)->after('licence_copy_fileName');
            $table->dateTime('licence_confirmed_date')->nullable()->after('licence_confirmed');
            $table->text('bio_text')->nullable()->after('address');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company_profile', function (Blueprint $table) {
            $table->dropColumn(['licence_copy_fileName']);
            $table->dropColumn(['licence_confirmed']);
            $table->dropColumn(['licence_confirmed_date']);
            $table->dropColumn(['bio_text']);
        });
    }
}
