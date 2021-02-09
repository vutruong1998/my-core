<?php

namespace MyCore\Core\Database\Seeds;

use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];
        $configs = config('mc_core.permissions') ?? [];
        DB::beginTransaction();
        try {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            DB::table('permissions')->truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            foreach ($configs as $config) {
                foreach ($config as $val) {
                    $data[] = $val;
                }
            }
            DB::table('permissions')->insert($data);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
        }
    }
}
