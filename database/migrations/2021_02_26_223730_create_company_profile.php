<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyProfile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_profile', function (Blueprint $table) {
            $table->id();

            $table->string('licensenumber');
            $table->string('license_copy');
            $table->string('address')->nullable();
            $table->string('owner_name')->nullable();
            $table->string('contact_person_name')->nullable();
            $table->string('arbitration_cert_copy')->nullable();
            $table->boolean('arbitrationcert_request_status')->nullable();
            $table->boolean('arbitrationcert_confirmed')->nullable();
            $table->dateTime('arbitrationcert_confirmed_date')->nullable();
            $table->string('company_twitter')->nullable();
            $table->string('company_facebook')->nullable();
            $table->string('company_instagram')->nullable();

            $table->foreignId('company_admission_id')->constrained('company_admission_type');
            $table->foreignId('user_id')->constrained('users');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_profile');
    }
}
