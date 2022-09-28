<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitReportAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visit_report_attachments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visit_report_id')->constrained('visit_report')->onDelete('cascade');;
            $table->string('filename');
            $table->string('hashName');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('visit_report_attachments', function (Blueprint $table) {
            $table->dropForeign(['visit_report_id']);
        });

        Schema::dropIfExists('visit_report_attachments');
    }
}
