<?php

namespace MyCore\Core\Database\Seeds;

use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use MyCore\Core\Models\Role;
use MyCore\Core\Models\User;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleIds = [];
        DB::beginTransaction();
        try {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            DB::table('users')->truncate();
            DB::table('model_has_roles')->truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            $user = User::create([
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make(123456),
                'active' => User::STATUS_ACTIVE,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            $roles = Role::all();
            foreach ($roles as $role) {
                $roleIds[] = $role->id;
            }
            $user->syncRoles($roleIds);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
        }
    }
}
