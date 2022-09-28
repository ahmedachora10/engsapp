<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestChatMsgsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_chat_msgs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sender_user_id')->constrained('users');
            $table->foreignId('recipient_user_id')->constrained('users');
            $table->foreignId('request_id')->constrained('requests');
            $table->text('message');
            $table->boolean('isread');
            $table->dateTime('read_at')->nullable();
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
        Schema::table('request_chat_msgs', function (Blueprint $table) {
            $table->dropForeign(['sender_user_id']);
            $table->dropForeign(['recipient_user_id']);
            $table->dropForeign(['request_id']);
        });

        Schema::dropIfExists('request_chat_msgs');
    }
}
