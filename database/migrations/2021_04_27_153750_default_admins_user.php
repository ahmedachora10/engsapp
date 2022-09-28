<?php

use App\Models\Admin;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class DefaultAdminsUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        $adminUser = new Admin();

        $adminUser->name = 'administrator';
        $adminUser->email = 'admin@manasaarch.com';
        $adminUser->password = Hash::make('admin');
        $adminUser->active = true;
        $adminUser->type = 'super_admin';
        $adminUser->save();
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
