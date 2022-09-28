<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateServiceCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent')->nullable()->references('id')->on('service_categories');
            $table->foreignId('service_type_id')->constrained('service_types');
            $table->string('service_name_ar');
            $table->string('service_name_en');
            // $table->timestamps();
        });

        //Project services
        DB::table('service_categories')->insert([
            ['service_name_en' => 'Service English 1', 'service_name_ar' => 'نفيذ مشروع كامل',  'service_type_id' => 1],
            ['service_name_en' => 'Service English 1', 'service_name_ar' => 'تقسيم قطعة ارض معلومة المساحة', 'service_type_id' => 1],
            ['service_name_en' => 'Service English 1', 'service_name_ar' => 'تصميم واجهة مبنى', 'service_type_id' => 1],
            ['service_name_en' => 'Service English 1', 'service_name_ar' => 'تعديل على مخطط', 'service_type_id' => 1],
            ['service_name_en' => 'Service English 1', 'service_name_ar' => 'رفع مخططات اتوكاد', 'service_type_id' => 1],
            ['service_name_en' => 'Service English 1', 'service_name_ar' => 'تنفيذ مشروع كامل', 'service_type_id' => 1],
            ['service_name_en' => 'Service English 1', 'service_name_ar' => 'مخططات انشائية', 'service_type_id' => 1],
            ['service_name_en' => 'Service English 1', 'service_name_ar' => 'تصميم مخططات بناية سكنية', 'service_type_id' => 1],
            ['service_name_en' => 'Service English 1', 'service_name_ar' => 'تصميم متجر', 'service_type_id' => 1],
            ['service_name_en' => 'Service English 1', 'service_name_ar' => 'تحويل مخطط لمجسم ثلاثي الابعاد', 'service_type_id' => 1],
            ['service_name_en' => 'Service English 1', 'service_name_ar' => 'تصميم مخططات بناية سكنية', 'service_type_id' => 1],
            ['service_name_en' => 'Service English 1', 'service_name_ar' => 'تقسيم قطعة ارض معلومة المساحة', 'service_type_id' => 1],
            ['service_name_en' => 'Service English 1', 'service_name_ar' => 'تحويل مخطط لمجسم ثلاثي الابعاد', 'service_type_id' => 1],
            ['service_name_en' => 'Service English 1', 'service_name_ar' => 'رفع مخطط ببرنامج اسكتش اب', 'service_type_id' => 1],
            ['service_name_en' => 'Service English 1', 'service_name_ar' => 'تصميم ديكور داخلي', 'service_type_id' => 1],
        ]);

        DB::table('service_categories')->insert([
            ['service_name_en' => 'Service English 1', 'service_name_ar' => 'استشارة ميدانية', 'service_type_id' => 2],
            ['service_name_en' => 'Service English 1', 'service_name_ar' => 'استشارة حول مخطط سكني', 'service_type_id' => 2],
            ['service_name_en' => 'Service English 1', 'service_name_ar' => 'استشارة مباني سكنية', 'service_type_id' => 2],
            ['service_name_en' => 'Service English 1', 'service_name_ar' => 'استشارة فنية', 'service_type_id' => 2],
            ['service_name_en' => 'Service English 1', 'service_name_ar' => 'استشارة تعديل مبني قائم', 'service_type_id' => 2],
            ['service_name_en' => 'Service English 1', 'service_name_ar' => 'استشارة تحمل وزن', 'service_type_id' => 2],
            ['service_name_en' => 'Service English 1', 'service_name_ar' => 'استشارة مشروع تجاري', 'service_type_id' => 2],
            ['service_name_en' => 'Service English 1', 'service_name_ar' => 'استشارة تكلفة تصميم', 'service_type_id' => 2],
            ['service_name_en' => 'Service English 1', 'service_name_ar' => 'استشارة مشاريع كبري', 'service_type_id' => 2],

        ]);

        DB::table('service_categories')->insert([
            ['service_name_en' => 'Service English 1', 'service_name_ar' => 'تحكيم حسب المخططات', 'service_type_id' => 3],
            ['service_name_en' => 'Service English 1', 'service_name_ar' => 'تحكيم بين جهة تنفيذ ومالك', 'service_type_id' => 3],
            ['service_name_en' => 'Service English 1', 'service_name_ar' => 'نوع التحكيم يوضع هنا', 'service_type_id' => 3],
            ['service_name_en' => 'Service English 1', 'service_name_ar' => 'تحكيم مبني تجاري', 'service_type_id' => 3],
            ['service_name_en' => 'Service English 1', 'service_name_ar' => 'تحكيم مبني سكني', 'service_type_id' => 3],
        ]);

        DB::table('service_categories')->insert([
            ['service_name_en' => 'Service English 1', 'service_name_ar' => 'زيارة موقع قيد الانشاء', 'service_type_id' => 4],
            ['service_name_en' => 'Service English 1', 'service_name_ar' => 'زيارة منزل ارضي', 'service_type_id' => 4],
            ['service_name_en' => 'Service English 1', 'service_name_ar' => 'زيارة محل تجاري', 'service_type_id' => 4],
            ['service_name_en' => 'Service English 1', 'service_name_ar' => 'زيارة لرفع مساحة ارض', 'service_type_id' => 4],
            ['service_name_en' => 'Service English 1', 'service_name_ar' => 'زيارة لعلاج خلل فني', 'service_type_id' => 4],
        ]);

        $ConstructionLicense = DB::table('service_categories')->insertGetId(
            ['service_name_en' => 'Service English 1', 'service_name_ar' => 'ترخيص انشاء', 'service_type_id' => 5],
        );

        $ConstructionLicense_ResidentialProjects = DB::table('service_categories')->insertGetId(
            ['service_name_en' => 'Residential Projects', 'service_name_ar' => 'مشاريع سكنية', 'service_type_id' => 5, 'parent' => $ConstructionLicense],
        );
        $ConstructionLicense_CommercialProjects = DB::table('service_categories')->insertGetId(
            ['service_name_en' => 'Commercial Projects', 'service_name_ar' => 'مشاريع تجارية', 'service_type_id' => 5, 'parent' => $ConstructionLicense],
        );
        $ConstructionLicense_LargeProjects = DB::table('service_categories')->insertGetId(
            ['service_name_en' => 'Large Projects', 'service_name_ar' => 'مشاريع كبرى', 'service_type_id' => 5, 'parent' => $ConstructionLicense],
        );

        DB::table('service_categories')->insert([
            ['service_name_en' => 'Service English 1', 'service_name_ar' => 'شهادة دراسة تربة', 'service_type_id' => 5, 'parent' => $ConstructionLicense_ResidentialProjects],
        ]);

        /****************************************************************************** */
        DB::table('service_categories')->insert([
            ['service_name_en' => 'Service English 1', 'service_name_ar' => 'شهادة دراسة تربة', 'service_type_id' => 5, 'parent' => $ConstructionLicense_CommercialProjects],
            ['service_name_en' => 'Service English 1', 'service_name_ar' => 'تراخيص أمن وسلامة', 'service_type_id' => 5, 'parent' => $ConstructionLicense_CommercialProjects],
        ]);

        /****************************************************************************** */

        DB::table('service_categories')->insert([
            ['service_name_en' => 'Service English 1', 'service_name_ar' => 'دراسة تربة', 'service_type_id' => 5, 'parent' => $ConstructionLicense_LargeProjects],
            ['service_name_en' => 'Service English 1', 'service_name_ar' => 'تراخيص أمن وسلامة', 'service_type_id' => 5, 'parent' => $ConstructionLicense_LargeProjects],
            ['service_name_en' => 'Service English 1', 'service_name_ar' => 'تراخيص بيئة ', 'service_type_id' => 5, 'parent' => $ConstructionLicense_LargeProjects],
            ['service_name_en' => 'Service English 1', 'service_name_ar' => 'دراسة سيول ', 'service_type_id' => 5, 'parent' => $ConstructionLicense_LargeProjects],
        ]);


        //OperatingLicense


        $OperatingLicense = DB::table('service_categories')->insertGetId(
            ['service_name_en' => 'Service English 1', 'service_name_ar' => 'ترخيص تشغيل', 'service_type_id' => 5],
        );

        $OperatingLicense_CommercialProjects = DB::table('service_categories')->insertGetId(
            ['service_name_en' => 'Commercial Projects', 'service_name_ar' => 'مشاريع تجارية', 'service_type_id' => 5, 'parent' => $OperatingLicense],
        );
        $OperatingLicense_LargeProjects = DB::table('service_categories')->insertGetId(
            ['service_name_en' => 'Large Projects', 'service_name_ar' => 'مشاريع كبرى', 'service_type_id' => 5, 'parent' => $OperatingLicense],
        );

        /****************************************************************************** */
        DB::table('service_categories')->insert([
            ['service_name_en' => 'Service English 1', 'service_name_ar' => 'مواد حماية', 'service_type_id' => 5, 'parent' => $OperatingLicense_CommercialProjects],
            ['service_name_en' => 'Service English 1', 'service_name_ar' => 'مواد إطفاء حرائق', 'service_type_id' => 5, 'parent' => $OperatingLicense_CommercialProjects],
        ]);

        /****************************************************************************** */

        DB::table('service_categories')->insert([
            ['service_name_en' => 'Service English 1', 'service_name_ar' => 'مواد حماية', 'service_type_id' => 5, 'parent' => $OperatingLicense_LargeProjects],
            ['service_name_en' => 'Service English 1', 'service_name_ar' => 'مواد إطفاء حرائق', 'service_type_id' => 5, 'parent' => $OperatingLicense_LargeProjects],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_categories');
    }
}
