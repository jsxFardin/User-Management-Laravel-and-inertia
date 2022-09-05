<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('permission_groups')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $data = [
            [
                'id' => 1,
                'name' => 'message.Dashboard',
                'label' => 'Dashboard',
                'parent_id' => null,
                'sort' => 1,
                'icon' => 'border-all',
                'route' => 'dashboard|map'
            ],
            [
                'id' => 2,
                'name' => 'message.User Management',
                'label' => 'User Management',
                'parent_id' => null,
                'sort' => 2,
                'icon' => 'users',
                'route' => 'user.index|role.index|position.index'
            ],
            [
                'id' => 3,
                'name' => 'menu.User',
                'label' => 'User',
                'parent_id' => 2,
                'sort' => 1,
                'icon' => 'user',
                'route' => 'user.index'
            ],
            [
                'id' => 4,
                'name' => 'menu.Role',
                'label' => 'Role',
                'parent_id' => 2,
                'sort' => 2,
                'icon' => 'user-tag',
                'route' => 'role.index'
            ],
        ];

        DB::table('permission_groups')->insert($data);

        $this->command->info('Permission groups has been created!');
    }
}
