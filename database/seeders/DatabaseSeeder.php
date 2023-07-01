<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user_list = Permission::create(['name'=>'users.list']);
        $user_view = Permission::create(['name'=>'users.view']);
        $user_create = Permission::create(['name'=>'users.create']);
        $user_update = Permission::create(['name'=>'users.update']);
        $user_delete = Permission::create(['name'=>'users.delete']);

        $admin_role = Role::create(['name' => 'admin']);
        $admin_permission = [
            $user_create,
            $user_list,
            $user_update,
            $user_view,
            $user_delete
        ];

        $raica = User::create([
            'full_name' => 'Rai Ca',
            'email' => 'raica@raica.com',
            'phone' => '0999999999',
            'password' => bcrypt('raica1212')
        ]);

        $chipchip = User::create([
            'full_name' => 'Rai Ca',
            'email' => 'chipchip@raica.com',
            'phone' => '0888888888',
            'password' => bcrypt('raica1212')
        ]);

        $raica->assignRole($admin_role);
        $raica->givePermissionTo($admin_permission);
        $admin_role->givePermissionTo($admin_permission);

        $chipchip->assignRole($admin_role);
        $chipchip->givePermissionTo($admin_permission);
        $admin_role->givePermissionTo($admin_permission);

        $user = User::create([
            'full_name' => 'Nam Nam',
            'email' => 'user@user.com',
            'phone' => '0123456780',
            'password' => bcrypt('password')
        ]);

        $user_role = Role::create(['name' => 'user']);
        $user_permission = [
            $user_view,
            $user_update,
        ];

        $user->assignRole($user_role);
        $user->givePermissionTo($user_permission);
        $user_role->givePermissionTo($user_permission);

        $this->call([
            StoreSeeder::class,
            CategorySeeder::class,
            MenuItemSeeder::class,
        ]);
    }
}
