<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

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
        
        $subscriber_permissions = [
                'create comment',
                'edit comment',
                'delete comment',
        ];
        
        $admin_permissions = [
            'edit posts',
            'delete posts',
            'publish posts',
            'unpublish posts',
            'delete users',
            'edit roles',
            'create comment',
            'edit comment',
            'delete comment',
        ];


        $roles = [
            'admin',
            'subscriber',
        ];

        foreach ($subscriber_permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        foreach ($admin_permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }        

        foreach ($roles as $user_role) {
            $role = Role::create(['name' => $user_role]);

            if ($role == 'subscriber') {
                foreach ($subscriber_permissions as $permission) {
                    $role->givePermissionTo($permission['name']);
                }
            }

            if ($role == 'admin') {
                foreach ($admin_permissions as $permission) {
                    $role->givePermissionTo($permission['name']);
                }
            }
        }
    }
}
