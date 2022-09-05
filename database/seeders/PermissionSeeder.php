<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('permissions')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $data = [
            // Dashboard
            [
                'name'  => 'list-dashboard',
                'label' => 'Home',
                'permission_group_id' => 1
            ],
            // User
            [
                'name'  => 'list-user',
                'label' => 'List',
                'permission_group_id' => 3
            ],
            [
                'name'  => 'create-user',
                'label' => 'Create',
                'permission_group_id' => 3
            ],
            [
                'name'  => 'show-user',
                'label' => 'Show',
                'permission_group_id' => 3
            ],
            [
                'name'  => 'edit-user',
                'label' => 'Edit',
                'permission_group_id' => 3
            ],
            [
                'name'  => 'status-user',
                'label' => 'Status',
                'permission_group_id' => 3
            ],
            [
                'name'  => 'destroy-user',
                'label' => 'Delete',
                'permission_group_id' => 3
            ],
            // Role
            [
                'name'  => 'list-role',
                'label' => 'List',
                'permission_group_id' => 4
            ],
            [
                'name'  => 'create-role',
                'label' => 'Create',
                'permission_group_id' => 4
            ],
            [
                'name'  => 'edit-role',
                'label' => 'Edit',
                'permission_group_id' => 4
            ],
            [
                'name'  => 'status-role',
                'label' => 'Status',
                'permission_group_id' => 4
            ],
            [
                'name'  => 'destroy-role',
                'label' => 'Delete',
                'permission_group_id' => 4
            ]

        ];

        DB::table('permissions')->insert($data);

        $this->command->info('Permissions has been created!');
    }
}
