<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRecruitersJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('recruiters_jobs', function (Blueprint $table) {
            $table->string('image')->default('');
            //$table->string('recruiter_phone')->nullable()->change();
            //$table->string('recruiter_email')->nullable()->change();

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('recruiters_jobs', function (Blueprint $table) {
            $table->dropColumn(['image']);
        });
    }
}
