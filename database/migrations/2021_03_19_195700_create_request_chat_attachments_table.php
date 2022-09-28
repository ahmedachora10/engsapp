<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestChatAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_chat_attachments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('message_id')->constrained('request_chat_msgs')->onDelete('cascade');;
            $table->string('filename');
            $table->string('hashName');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('request_chat_attachments', function (Blueprint $table) {
            $table->dropForeign(['message_id']);
        });
        Schema::dropIfExists('request_chat_attachments');
    }
}
