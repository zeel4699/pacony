<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'uploads check']);
        Permission::create(['name' => 'demo request check']);
        Permission::create(['name' => 'whatsapp order request check']);
        Permission::create(['name' => 'blogs check']);
        Permission::create(['name' => 'services check']);
        Permission::create(['name' => 'software check']);
        Permission::create(['name' => 'external url check']);
        Permission::create(['name' => 'banner check']);
        Permission::create(['name' => 'about us check']);
        Permission::create(['name' => 'work processes check']);
        Permission::create(['name' => 'features check']);
        Permission::create(['name' => 'testimonials check']);
        Permission::create(['name' => 'partners check']);
        Permission::create(['name' => 'faq check']);
        Permission::create(['name' => 'currency check']);
        Permission::create(['name' => 'pages check']);
        Permission::create(['name' => 'settings check']);
        Permission::create(['name' => 'contact check']);
        Permission::create(['name' => 'comments check']);
        Permission::create(['name' => 'language check']);
        Permission::create(['name' => 'clear cache check']);

        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'super-admin']);
        // gets all permissions via Gate::before rule; see AuthServiceProvider


        // create demo users
        $user = \App\Models\User::factory()->create([
            'name' => 'Super-Admin User',
            'email' => 'superadmin16@elsecolor.com',
            'password' => Hash::make('superadmin16'),
            'type' => 0,
        ]);
        $user->assignRole($role1);


    }
}
