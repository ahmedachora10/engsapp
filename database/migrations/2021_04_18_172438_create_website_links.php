<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateWebsiteLinks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('website_links', function (Blueprint $table) {
            $table->id();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
            $table->string('snapchat')->nullable();
            $table->string('contactus_email')->nullable();
            $table->string('contactus_address')->nullable();
            $table->string('contactus_phone')->nullable();
            $table->timestamps();
        });


        $links = [
            [
                'facebook' => '#facebook',
                'twitter' => '#twitter',
                'instagram' => '#instagram',
                'snapchat' => '#snapchat',
                'contactus_email' => 'info@archmanasa.net',
                'contactus_phone' => '+966 59879789478',
                'contactus_address' => 'الرياض ، منطقة ، صندوق بريد 15412',
            ],
        ];

        DB::table('website_links')->insert($links);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('website_links');
    }
}
