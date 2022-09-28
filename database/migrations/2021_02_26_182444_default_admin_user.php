<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class DefaultAdminUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        $adminUser = new User();

        $adminUser->name = 'administrator';
        $adminUser->email = 'admin@manasaarch.com';
        $adminUser->password = Hash::make('admin');
        $adminUser->phone_number = '00000';
        $adminUser->confirmed = true;
        $adminUser->user_type = 'admin';

        $adminUser->save();

        // DB::table('users')->insert([
        //     'name' => 'administrator',
        //     'email' => 'admin@manasaarch.com',
        //     'password' => Hash::make('admin'),
        //     'phone_number' => '00000',
        //     'confirmed' => true,
        //     'user_type' => 'admin'
        // ]);
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
