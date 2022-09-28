<?php

use App\Models\Admin;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;

class DefaultUserpermissionsData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Permission::create(['guard_name' => 'admin', 'name' => 'super-admin']);
        Permission::create(['guard_name' => 'admin', 'name' => 'manage website']);
        Permission::create(['guard_name' => 'admin', 'name' => 'manage cms']);
        Permission::create(['guard_name' => 'admin', 'name' => 'manage blog']);
        Permission::create(['guard_name' => 'admin', 'name' => 'manage users']);
        Permission::create(['guard_name' => 'admin', 'name' => 'manage requests']);

        $super_admin_user = Admin::find(1);
        $super_admin_user->givePermissionTo('super-admin');
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Permission::query()->delete();
    }
}
