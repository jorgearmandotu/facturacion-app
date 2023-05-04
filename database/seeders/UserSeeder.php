<?php

namespace Database\Seeders;

use App\Models\CategoriesDischarge;
use App\Models\CompanyData;
use App\Models\Resolution;
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

        //remision permission
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

        //gestion inventario permission
        Permission::create([
            'name'          => 'gestion-inventario',
            // 'guard_name'   => 'web',
        ]);
        Permission::create([
            'name'          => 'lines.index',
            // 'guard_name'   => 'web',
        ]);
        Permission::create([
            'name'          => 'lines.store',
            // 'guard_name'   => 'web',
        ]);
        Permission::create([
            'name'          => 'lines.update',
            // 'guard_name'   => 'web',
        ]);
        Permission::create([
            'name'          => 'groups.index',
            // 'guard_name'   => 'web',
        ]);
        Permission::create([
            'name'          => 'groups.store',
            // 'guard_name'   => 'web',
        ]);
        Permission::create([
            'name'          => 'groups.update',
            // 'guard_name'   => 'web',
        ]);
        Permission::create([
            'name'          => 'locations.index',
            // 'guard_name'   => 'web',
        ]);
        Permission::create([
            'name'          => 'locations.store',
            // 'guard_name'   => 'web',
        ]);
        Permission::create([
            'name'          => 'locations.update',
            // 'guard_name'   => 'web',
        ]);

        Permission::create([
            'name'          => 'list-prices',
            // 'guard_name'   => 'web',
        ]);
        Permission::create([
            'name'          => 'products-list',
            // 'guard_name'   => 'web',
        ]);
        Permission::create([
            'name'          => 'products.index',
            // 'guard_name'   => 'web',
        ]);
        Permission::create([
            'name'          => 'products.store',
            // 'guard_name'   => 'web',
        ]);
        Permission::create([
            'name'          => 'products.update',
            // 'guard_name'   => 'web',
        ]);

        Permission::create([
            'name'          => 'suppliers-list',
            // 'guard_name'   => 'web',
        ]);
        Permission::create([
            'name'          => 'suppliers.index',
            // 'guard_name'   => 'web',
        ]);


        Permission::create([
            'name'          => 'shopping-invoices.store',
            // 'guard_name'   => 'web',
        ]);

        Permission::create([
            'name'          => 'list-terceros',
            // 'guard_name'   => 'web',
        ]);
        Permission::create([
            'name'          => 'terceros.index',
            // 'guard_name'   => 'web',
        ]);
        Permission::create([
            'name'          => 'terceros.store',
            // 'guard_name'   => 'web',
        ]);
        Permission::create([
            'name'          => 'terceros.show',
            // 'guard_name'   => 'web',
        ]);
        Permission::create([
            'name'          => 'terceros.update',
            // 'guard_name'   => 'web',
        ]);

        Permission::create([
            'name'          => 'invoices.store',
            // 'guard_name'   => 'web',
        ]);
        Permission::create([
            'name'          => 'invoices.index',
            // 'guard_name'   => 'web',
        ]);
        Permission::create([
            'name'          => 'print-invoices',
            // 'guard_name'   => 'web',
        ]);
        Permission::create([
            'name'          => 'pending-invoices',
            // 'guard_name'   => 'web',
        ]);

        //receipt
        Permission::create([
            'name'          => 'receipt.index',
            // 'guard_name'   => 'web',
        ]);
        Permission::create([
            'name'          => 'receipt.store',
            // 'guard_name'   => 'web',
        ]);
        Permission::create([
            'name'          => 'print-receipt',
            // 'guard_name'   => 'web',
        ]);
        //configuracion empresa
        Permission::create([
            'name'          => 'resolution-store',
            // 'guard_name'   => 'web',
        ]);
        Permission::create([
            'name'          => 'config-company.index',
            // 'guard_name'   => 'web',
        ]);
        Permission::create([
            'name'          => 'config-company.store',
            // 'guard_name'   => 'web',
        ]);

        Permission::create([
            'name'          => 'exports',
            // 'guard_name'   => 'web',
        ]);
        Permission::create([
            'name'          => 'exports-invoice',
            // 'guard_name'   => 'web',
        ]);
        Permission::create([
            'name'          => 'exports-receipt',
            // 'guard_name'   => 'web',
        ]);

        //gestion de usuarios
        Permission::create([
            'name'          => 'admin-users.index',
            // 'guard_name'   => 'web',
        ]);
        Permission::create([
            'name'          => 'admin-users.store',
            // 'guard_name'   => 'web',
        ]);
        //gestion documentos
        Permission::create([
            'name'          => 'gestion-documents',
            // 'guard_name'   => 'web',
        ]);
        Permission::create([
            'name'          => 'discharges',
            // 'guard_name'   => 'web',
        ]);
        Permission::create([
            'name'          => 'transferLocations',
            // 'guard_name'   => 'web',
        ]);
        Permission::create([
            'name'          => 'profile',
            // 'guard_name'   => 'web',
        ]);


        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123'),
        ]);

        $user->givePermissionTo('remision.index', 'remision.store', 'printRemision',
        'listRemisiones', 'gestion-inventario', 'lines.index', 'lines.store', 'lines.update', 'groups.index',
        'groups.store', 'groups.update', 'locations.index', 'locations.store', 'locations.update', 'list-prices',
        'products-list', 'products.index', 'products.store', 'products.update', 'suppliers-list', 'suppliers.index',
        'shopping-invoices.store', 'list-terceros', 'terceros.index', 'terceros.store', 'terceros.show', 'terceros.update',
        'invoices.store', 'invoices.index', 'print-invoices', 'pending-invoices', 'receipt.index', 'receipt.store',
        'print-receipt', 'resolution-store', 'config-company.index', 'config-company.store', 'exports',
        'exports-invoice' , 'exports-receipt', 'admin-users.index', 'admin-users.store', 'gestion-documents', 'discharges', 'transferLocations', 'profile');

        //crear datos de compania
        $dataCompany = CompanyData ::create([
            'name_view' => 'Aetius',
            'razon_social' => 'La casa del estampado',
            'dni' => '9.547.458-3',
            'address' => 'calle 16 #23-15',
            'phone' => '315 8465 247',
            'regimen' => 'simplificado',
            'actividad_economica' => '04753',
            'email' => 'empresa@email.com',
        ]);

        //crear datos de resolucion
        $resolution = Resolution::create([
            'number'=> '18764024704502',
            'date_resolution' => '2023-01-29',
            'expiration_date' => '2024-01-29',
            'validity' => '24 meses',
            'prefijo' => 'FP',
            'initial_number' => '1',
            'final_number' => '1000',]);

    }
}
