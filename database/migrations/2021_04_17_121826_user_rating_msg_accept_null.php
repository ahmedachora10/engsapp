<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserRatingMsgAcceptNull extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_rating', function (Blueprint $table) {
            if (Schema::hasColumn('user_rating', 'review_msg')) {
                $table->dropColumn(['review_msg']);
            }
        });
        
        Schema::table('user_rating', function (Blueprint $table) {
            $table->text('review_msg')->nullable()->after('rating_value');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
