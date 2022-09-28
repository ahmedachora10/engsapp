<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recruiters_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->date('deadline');
            $table->text('desc');
            $table->string('recruiter_email');
            $table->string('recruiter_phone');
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
            $table->softDeletes();
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
            $table->dropForeign(['user_id']);
            $table->dropSoftDeletes();
        });

        Schema::dropIfExists('recruiters_jobs');
    }
}
