<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateFreelancerProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('freelancer_profile', function (Blueprint $table) {
            $table->string('test_quality_cert_copy')->nullable()->default('');
            $table->string('insurance_copy')->nullable()->default(0);
            $table->string('test_quality_request_status')->nullable()->default(0);
            $table->string('test_quality_confirmed')->nullable()->default(0);
            $table->string('test_build_cert_copy')->nullable()->default('');
            $table->string('test_build_request_status')->nullable()->default(0);
            $table->string('test_build_confirmed')->nullable()->default(0);
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

    }
}
