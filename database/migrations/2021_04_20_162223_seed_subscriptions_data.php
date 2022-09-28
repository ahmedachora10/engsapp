<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SeedSubscriptionsData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $subs_enabled = [
            [
                'page_name' => 'main_page_subscriptions',
                'page_name_text' => 'الاشتراكات',
                'section_name' => 'subscriptions_enabled',
                'section_name_text' => 'تفعيل الاشتراكات',
                'paragraph_name' => 'subs_enabled',
                'paragraph_name_text' => 'تفعيل الاشتراكات',
                'content_ar' => '1',
                'content_en' => '1',
                'icon_name' => NULL,
            ],
        ];

        $user_subs = [
            [
                'page_name' => 'main_page_subscriptions',
                'page_name_text' => 'الاشتراكات',
                'section_name' => 'user_subscriptions',
                'section_name_text' => 'اشتراك المستخدم',
                'paragraph_name' => 'user_subs_price',
                'paragraph_name_text' => 'سعر اشتراك المستخدم',
                'content_ar' => 'مجاناً',
                'content_en' => 'مجاناً',
                'icon_name' => NULL,
            ],
            [
                'page_name' => 'main_page_subscriptions',
                'page_name_text' => 'الاشتراكات',
                'section_name' => 'user_subscriptions',
                'section_name_text' => 'اشتراك المستخدم',
                'paragraph_name' => 'user_subs_curr',
                'paragraph_name_text' => 'عملة اشتراك المستخدم',
                'content_ar' => '0',
                'content_en' => '0',
                'icon_name' => NULL,
            ],
            [
                'page_name' => 'main_page_subscriptions',
                'page_name_text' => 'الاشتراكات',
                'section_name' => 'user_subscriptions',
                'section_name_text' => 'اشتراك المستخدم',
                'paragraph_name' => 'user_subs_terms',
                'paragraph_name_text' => 'شروط اشتراك المستخدم',
                'content_ar' => 'أحد الشروط يوضع هنا',
                'content_en' => 'term inserted here',
                'icon_name' => NULL,
            ],
        ];


        $company_subs = [
            [
                'page_name' => 'main_page_subscriptions',
                'page_name_text' => 'الاشتراكات',
                'section_name' => 'company_subscriptions',
                'section_name_text' => 'اشتراك المكتب الهندسي',
                'paragraph_name' => 'company_subs_price',
                'paragraph_name_text' => 'سعر اشتراك المكتب الهندسي',
                'content_ar' => '0.0',
                'content_en' => '0.0',
                'icon_name' => NULL,
            ],
            [
                'page_name' => 'main_page_subscriptions',
                'page_name_text' => 'الاشتراكات',
                'section_name' => 'company_subscriptions',
                'section_name_text' => 'اشتراك المكتب الهندسي',
                'paragraph_name' => 'company_subs_curr',
                'paragraph_name_text' => 'عملة اشتراك المكتب الهندسي',
                'content_ar' => 'ر.س /شهر',
                'content_en' => 'ر.س /شهر',
                'icon_name' => NULL,
            ],
            [
                'page_name' => 'main_page_subscriptions',
                'page_name_text' => 'الاشتراكات',
                'section_name' => 'company_subscriptions',
                'section_name_text' => 'اشتراك المكتب الهندسي',
                'paragraph_name' => 'company_subs_terms',
                'paragraph_name_text' => 'شروط اشتراك المكتب الهندسي',
                'content_ar' => 'أحد الشروط يوضع هنا',
                'content_en' => 'term inserted here',
                'icon_name' => NULL,
            ],
        ];


        $freelancer_subs = [
            [
                'page_name' => 'main_page_subscriptions',
                'page_name_text' => 'الاشتراكات',
                'section_name' => 'freelancer_subscriptions',
                'section_name_text' => 'اشتراك المستقلين',
                'paragraph_name' => 'freelancer_subs_price',
                'paragraph_name_text' => 'سعر اشتراك المستقلين',
                'content_ar' => '0.0%',
                'content_en' => '0.0%',
                'icon_name' => NULL,
            ],
            [
                'page_name' => 'main_page_subscriptions',
                'page_name_text' => 'الاشتراكات',
                'section_name' => 'freelancer_subscriptions',
                'section_name_text' => 'اشتراك المستقلين',
                'paragraph_name' => 'freelancer_subs_curr',
                'paragraph_name_text' => 'عملة اشتراك المستقلين',
                'content_ar' => 'نسبة من العمل',
                'content_en' => 'نسبة من العمل',
                'icon_name' => NULL,
            ],
            [
                'page_name' => 'main_page_subscriptions',
                'page_name_text' => 'الاشتراكات',
                'section_name' => 'freelancer_subscriptions',
                'section_name_text' => 'اشتراك المستقلين',
                'paragraph_name' => 'freelancer_subs_terms',
                'paragraph_name_text' => 'شروط اشتراك المستقلين',
                'content_ar' => 'أحد الشروط يوضع هنا',
                'content_en' => 'term inserted here',
                'icon_name' => NULL,
            ],
        ];

        DB::table('website_content')->insert($subs_enabled);
        DB::table('website_content')->insert($user_subs);
        DB::table('website_content')->insert($company_subs);
        DB::table('website_content')->insert($freelancer_subs);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('website_content')->where('page_name', 'main_page_subscriptions')->delete();
    }
}
