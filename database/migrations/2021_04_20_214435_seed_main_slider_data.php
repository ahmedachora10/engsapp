<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SeedMainSliderData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        $temp_slides = [
            [
                'title_ar' => 'هل ترغب في تنفيذ مشروع؟',
                'title_en' => 'Slide 1 Text title',
                'small_desc_ar' => 'نقدم لك',
                'small_desc_en' => 'We provide',
                'desc_ar' => "المكاتب الهندسية المعتدمة من الهيئة السعودية للمهندسين\r\nالمهندسون المستقلون و المعتمدين في الهئية السعودية للمهندسين\r\nخبراء للتحكيم بين طرفين مختلفين في مشاريع هندسية بكل شفافية",
                'desc_en' => "English Desc 1",
                'button_text_ar' => 'طلب مشروع',
                'button_text_en' => 'request a project',
                'linkTo' => '#',
                'image' => 'slide1.jpg',
                'order' => 1,
                'isenabled' => true,
            ],
            [
                'title_ar' => 'هل ترغب في استشارة هندسية؟',
                'title_en' => 'Slide 2 Text title',
                'small_desc_ar' => 'استشارة هندسية ناجحة',
                'small_desc_en' => 'We provide 2',
                'desc_ar' => "المكاتب الهندسية المعتدمة من الهيئة السعودية للمهندسين\r\nالمهندسون المستقلون و المعتمدين في الهئية السعودية للمهندسين",
                'desc_en' => "English Desc 2",
                'button_text_ar' => 'طلب مشروع',
                'button_text_en' => 'request a project',
                'linkTo' => '#',
                'image' => 'slide2.jpg',
                'order' => 2,
                'isenabled' => true,
            ]
        ];

        DB::table('main_slider')->insert($temp_slides);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        DB::table('main_slider')->delete();
    }
}
