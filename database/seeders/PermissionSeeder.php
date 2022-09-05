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
                'permission_group_id' => 31
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
            ],
            // Camp
            [
                'name'  => 'list-camp',
                'label' => 'List',
                'permission_group_id' => 7
            ],
            [
                'name'  => 'create-camp',
                'label' => 'Create',
                'permission_group_id' => 7
            ],
            [
                'name'  => 'show-camp',
                'label' => 'Show',
                'permission_group_id' => 7
            ],
            [
                'name'  => 'edit-camp',
                'label' => 'Edit',
                'permission_group_id' => 7
            ],
            [
                'name'  => 'status-camp',
                'label' => 'Status',
                'permission_group_id' => 7
            ],
            [
                'name'  => 'destroy-camp',
                'label' => 'Delete',
                'permission_group_id' => 7
            ],
            // Block
            [
                'name'  => 'list-block',
                'label' => 'List',
                'permission_group_id' => 8
            ],
            [
                'name'  => 'create-block',
                'label' => 'Create',
                'permission_group_id' => 8
            ],
            [
                'name'  => 'edit-block',
                'label' => 'Edit',
                'permission_group_id' => 8
            ],
            [
                'name'  => 'status-block',
                'label' => 'Status',
                'permission_group_id' => 8
            ],
            [
                'name'  => 'destroy-block',
                'label' => 'Delete',
                'permission_group_id' => 8
            ],
            // Facility
            [
                'name'  => 'list-facility',
                'label' => 'List',
                'permission_group_id' => 9
            ],
            [
                'name'  => 'create-facility',
                'label' => 'Create',
                'permission_group_id' => 9
            ],
            [
                'name'  => 'edit-facility',
                'label' => 'Edit',
                'permission_group_id' => 9
            ],
            [
                'name'  => 'status-facility',
                'label' => 'Status',
                'permission_group_id' => 9
            ],
            [
                'name'  => 'destroy-facility',
                'label' => 'Delete',
                'permission_group_id' => 9
            ],
            // Facility Used
            [
                'name'  => 'list-facility-used',
                'label' => 'List',
                'permission_group_id' => 10
            ],
            [
                'name'  => 'create-facility-used',
                'label' => 'Create',
                'permission_group_id' => 10
            ],
            [
                'name'  => 'edit-facility-used',
                'label' => 'Edit',
                'permission_group_id' => 10
            ],
            [
                'name'  => 'status-facility-used',
                'label' => 'Status',
                'permission_group_id' => 10
            ],
            [
                'name'  => 'destroy-facility-used',
                'label' => 'Delete',
                'permission_group_id' => 10
            ],
            // PIT
            [
                'name'  => 'list-pit',
                'label' => 'List',
                'permission_group_id' => 11
            ],
            [
                'name'  => 'create-pit',
                'label' => 'Create',
                'permission_group_id' => 11
            ],
            [
                'name'  => 'edit-pit',
                'label' => 'Edit',
                'permission_group_id' => 11
            ],
            [
                'name'  => 'status-pit',
                'label' => 'Status',
                'permission_group_id' => 11
            ],
            [
                'name'  => 'destroy-pit',
                'label' => 'Delete',
                'permission_group_id' => 11
            ],
            // Structure
            [
                'name'  => 'list-structure',
                'label' => 'List',
                'permission_group_id' => 13
            ],
            [
                'name'  => 'create-structure',
                'label' => 'Create',
                'permission_group_id' => 13
            ],
            [
                'name'  => 'edit-structure',
                'label' => 'Edit',
                'permission_group_id' => 13
            ],
            [
                'name'  => 'status-structure',
                'label' => 'Status',
                'permission_group_id' => 13
            ],
            [
                'name'  => 'destroy-structure',
                'label' => 'Delete',
                'permission_group_id' => 13
            ],
            // Construction
            [
                'name'  => 'list-construction',
                'label' => 'List',
                'permission_group_id' => 14
            ],
            [
                'name'  => 'create-construction',
                'label' => 'Create',
                'permission_group_id' => 14
            ],
            [
                'name'  => 'edit-construction',
                'label' => 'Edit',
                'permission_group_id' => 14
            ],
            [
                'name'  => 'status-construction',
                'label' => 'Status',
                'permission_group_id' => 14
            ],
            [
                'name'  => 'destroy-construction',
                'label' => 'Delete',
                'permission_group_id' => 14
            ],
            // Donor
            [
                'name'  => 'list-donor',
                'label' => 'List',
                'permission_group_id' => 15
            ],
            [
                'name'  => 'create-donor',
                'label' => 'Create',
                'permission_group_id' => 15
            ],
            [
                'name'  => 'edit-donor',
                'label' => 'Edit',
                'permission_group_id' => 15
            ],
            [
                'name'  => 'status-donor',
                'label' => 'Status',
                'permission_group_id' => 15
            ],
            [
                'name'  => 'destroy-donor',
                'label' => 'Delete',
                'permission_group_id' => 15
            ],
            // Latrine
            [
                'name'  => 'list-latrine',
                'label' => 'List',
                'permission_group_id' => 20
            ],
            [
                'name'  => 'create-latrine',
                'label' => 'Create',
                'permission_group_id' => 20
            ],
            [
                'name'  => 'show-latrine',
                'label' => 'Show',
                'permission_group_id' => 20
            ],
            [
                'name'  => 'edit-latrine',
                'label' => 'Edit',
                'permission_group_id' => 20
            ],
            [
                'name'  => 'status-latrine',
                'label' => 'Status',
                'permission_group_id' => 20
            ],
            [
                'name'  => 'destroy-latrine',
                'label' => 'Delete',
                'permission_group_id' => 20
            ],
            // Agency
            [
                'name'  => 'list-agency',
                'label' => 'List',
                'permission_group_id' => 17
            ],
            [
                'name'  => 'create-agency',
                'label' => 'Create',
                'permission_group_id' => 17
            ],
            [
                'name'  => 'show-agency',
                'label' => 'Show',
                'permission_group_id' => 17
            ],
            [
                'name'  => 'edit-agency',
                'label' => 'Edit',
                'permission_group_id' => 17
            ],
            [
                'name'  => 'status-agency',
                'label' => 'Status',
                'permission_group_id' => 17
            ],
            [
                'name'  => 'destroy-agency',
                'label' => 'Delete',
                'permission_group_id' => 17
            ],
            // Team
            [
                'name'  => 'list-team',
                'label' => 'List',
                'permission_group_id' => 18
            ],
            [
                'name'  => 'create-team',
                'label' => 'Create',
                'permission_group_id' => 18
            ],
            [
                'name'  => 'show-team',
                'label' => 'Show',
                'permission_group_id' => 18
            ],
            [
                'name'  => 'edit-team',
                'label' => 'Edit',
                'permission_group_id' => 18
            ],
            [
                'name'  => 'status-team',
                'label' => 'Status',
                'permission_group_id' => 18
            ],
            [
                'name'  => 'destroy-team',
                'label' => 'Delete',
                'permission_group_id' => 18
            ],
            // Position
            [
                'name'  => 'list-position',
                'label' => 'List',
                'permission_group_id' => 19
            ],
            [
                'name'  => 'create-position',
                'label' => 'Create',
                'permission_group_id' => 19
            ],
            [
                'name'  => 'edit-position',
                'label' => 'Edit',
                'permission_group_id' => 19
            ],
            [
                'name'  => 'status-position',
                'label' => 'Status',
                'permission_group_id' => 19
            ],
            [
                'name'  => 'destroy-position',
                'label' => 'Delete',
                'permission_group_id' => 19
            ],
            // Inspection
            [
                'name'  => 'list-inspection',
                'label' => 'List',
                'permission_group_id' => 21
            ],
            [
                'name'  => 'create-inspection',
                'label' => 'Create',
                'permission_group_id' => 21
            ],
            [
                'name'  => 'show-inspection',
                'label' => 'Show',
                'permission_group_id' => 21
            ],
            [
                'name'  => 'edit-inspection',
                'label' => 'Edit',
                'permission_group_id' => 21
            ],
            [
                'name'  => 'status-inspection',
                'label' => 'Status',
                'permission_group_id' => 21
            ],
            [
                'name'  => 'destroy-inspection',
                'label' => 'Delete',
                'permission_group_id' => 21
            ],
            // Desludge
            [
                'name'  => 'list-desludge',
                'label' => 'List',
                'permission_group_id' => 22
            ],
            // [
            //     'name'  => 'create-desludge',
            //     'label' => 'Create',
            //     'permission_group_id' => 22
            // ],
            [
                'name'  => 'show-desludge',
                'label' => 'Show',
                'permission_group_id' => 22
            ],
            // [
            //     'name'  => 'edit-desludge',
            //     'label' => 'Edit',
            //     'permission_group_id' => 22
            // ],
            // [
            //     'name'  => 'status-desludge',
            //     'label' => 'Status',
            //     'permission_group_id' => 22
            // ],
            // [
            //     'name'  => 'destroy-desludge',
            //     'label' => 'Delete',
            //     'permission_group_id' => 22
            // ],
            // Complaint
            [
                'name'  => 'list-complaint',
                'label' => 'List',
                'permission_group_id' => 23
            ],
            [
                'name'  => 'create-complaint',
                'label' => 'Create',
                'permission_group_id' => 23
            ],
            [
                'name'  => 'show-complaint',
                'label' => 'Show',
                'permission_group_id' => 23
            ],
            [
                'name'  => 'edit-complaint',
                'label' => 'Edit',
                'permission_group_id' => 23
            ],
            [
                'name'  => 'status-complaint',
                'label' => 'Status',
                'permission_group_id' => 23
            ],
            [
                'name'  => 'destroy-complaint',
                'label' => 'Delete',
                'permission_group_id' => 23
            ],
            // Transfer
            [
                'name'  => 'list-transfer',
                'label' => 'List',
                'permission_group_id' => 24
            ],
            [
                'name'  => 'create-transfer',
                'label' => 'Create',
                'permission_group_id' => 24
            ],
            [
                'name'  => 'edit-transfer',
                'label' => 'Edit',
                'permission_group_id' => 24
            ],
            [
                'name'  => 'status-transfer',
                'label' => 'Status',
                'permission_group_id' => 24
            ],
            [
                'name'  => 'destroy-transfer',
                'label' => 'Delete',
                'permission_group_id' => 24
            ],
            // season
            [
                'name'  => 'list-season',
                'label' => 'List',
                'permission_group_id' => 25
            ],
            [
                'name'  => 'edit-season',
                'label' => 'Edit',
                'permission_group_id' => 25
            ],
            // sanitation-zone
            [
                'name'  => 'list-sanitation-zone',
                'label' => 'List',
                'permission_group_id' => 26
            ],
            [
                'name'  => 'create-sanitation-zone',
                'label' => 'Create',
                'permission_group_id' => 26
            ],
            [
                'name'  => 'edit-sanitation-zone',
                'label' => 'Edit',
                'permission_group_id' => 26
            ],
            [
                'name'  => 'status-sanitation-zone',
                'label' => 'Status',
                'permission_group_id' => 26
            ],
            [
                'name'  => 'destroy-sanitation-zone',
                'label' => 'Delete',
                'permission_group_id' => 26
            ],
            // reports
            [
                'name'  => 'latrine-report',
                'label' => 'Latrine Report',
                'permission_group_id' => 28
            ],
            [
                'name'  => 'desludge-report',
                'label' => 'Desludge Report',
                'permission_group_id' => 29
            ],
            [
                'name'  => 'sanitation-zone-report',
                'label' => 'Sanitation Zone Report',
                'permission_group_id' => 30
            ],
            // Dashboard
            [
                'name'  => 'list-map',
                'label' => 'Map',
                'permission_group_id' => 32
            ],

        ];

        DB::table('permissions')->insert($data);

        $this->command->info('Permissions has been created!');
    }
}
