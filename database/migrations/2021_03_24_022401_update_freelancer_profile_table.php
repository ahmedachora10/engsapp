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
            $table->string('membership_copy_filename')->default('')->after('membership_copy');
            $table->boolean('membership_confirmed')->default(false)->after('membership_copy_filename');
            $table->dateTime('membership_confirmed_date')->nullable()->after('membership_confirmed');
            $table->string('address')->nullable()->after('occupation');
            $table->text('bio_text')->nullable()->after('address');
            $table->string('arbitration_cert_copy')->nullable()->after('bio_text');
            $table->boolean('arbitrationcert_request_status')->nullable()->after('arbitration_cert_copy');
            $table->boolean('arbitrationcert_confirmed')->nullable()->after('arbitrationcert_request_status');
            $table->dateTime('arbitrationcert_confirmed_date')->nullable()->after('arbitrationcert_confirmed');
            $table->string('freelancer_twitter')->nullable()->after('arbitrationcert_confirmed_date');
            $table->string('freelancer_facebook')->nullable()->after('freelancer_twitter');
            $table->string('freelancer_instagram')->nullable()->after('freelancer_facebook');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('freelancer_profile', function (Blueprint $table) {
            $table->dropColumn(['membership_copy_filename']);
            $table->dropColumn(['membership_confirmed']);
            $table->dropColumn(['membership_confirmed_date']);
            $table->dropColumn(['address']);
            $table->dropColumn(['bio_text']);
            $table->dropColumn(['arbitration_cert_copy']);
            $table->dropColumn(['arbitrationcert_request_status']);
            $table->dropColumn(['arbitrationcert_confirmed']);
            $table->dropColumn(['arbitrationcert_confirmed_date']);
            $table->dropColumn(['freelance_twitter']);
            $table->dropColumn(['freelance_facebook']);
            $table->dropColumn(['freelance_instagram']);
        });
    }
}
