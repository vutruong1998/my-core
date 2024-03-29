<?php

namespace MyCore\Core\Database\Seeds;

use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use MyCore\Core\Models\Permission;
use MyCore\Core\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissionIds = [];
        DB::beginTransaction();
        try {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            DB::table('roles')->truncate();
            DB::table('role_has_permissions')->truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            $role = Role::create([
                'name' => 'Admin',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now()
            ]);
            $permissions = Permission::all();
            foreach ($permissions as $permission) {
                $permissionIds[] = $permission->id;
            }
            $role->syncPermissions($permissionIds);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
        }
    }
}
