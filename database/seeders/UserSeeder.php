<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        Permission::create([
            'name'          => 'remision.index',
            // 'guard_name'   => 'web',
        ]);
        Permission::create([
            'name'          => 'remision.store',
            // 'guard_name'   => 'web',
        ]);
        Permission::create([
            'name'          => 'printRemision',
            // 'guard_name'   => 'web',
        ]);
        Permission::create([
            'name'          => 'listRemisiones',
            // 'guard_name'   => 'web',
        ]);

        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123'),
        ]);

        $user->givePermissionTo('remision.index', 'remision.store', 'printRemision', 'listRemisiones');
    }
}
