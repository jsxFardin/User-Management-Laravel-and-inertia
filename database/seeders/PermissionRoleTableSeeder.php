<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionRoleTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('permission_role')->delete();

        DB::table('permission_role')->insert(array(
            array(
                'permission_id' => 1,
                'role_id' => 2,
            ),
            array(
                'permission_id' => 2,
                'role_id' => 2,
            ),
            array(
                'permission_id' => 3,
                'role_id' => 2,
            ),
            array(
                'permission_id' => 4,
                'role_id' => 2,
            ),
            array(
                'permission_id' => 5,
                'role_id' => 2,
            ),
            array(
                'permission_id' => 6,
                'role_id' => 2,
            ),
            array(
                'permission_id' => 7,
                'role_id' => 2,
            ),
            array(
                'permission_id' => 8,
                'role_id' => 2,
            ),
            array(
                'permission_id' => 9,
                'role_id' => 2,
            ),
            array(
                'permission_id' => 10,
                'role_id' => 2,
            ),
            array(
                'permission_id' => 11,
                'role_id' => 2,
            ),
            array(
                'permission_id' => 12,
                'role_id' => 2,
            )
        ));
    }
}
