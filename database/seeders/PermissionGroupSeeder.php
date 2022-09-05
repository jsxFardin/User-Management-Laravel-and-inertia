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
            [
                'id' => 5,
                'name' => 'message.Setup',
                'label' => 'Setup',
                'parent_id' => null,
                'sort' => 3,
                'icon' => 'gear',
                'route' => 'setup.block.index|setup.camp.index|setup.facility.index|setup.facility-used.index|setup.pit.index|setup.structure.index|setup.construction.index|setup.donor.index|setup.transfer.index'
            ],
            [
                'id' => 6,
                'name' => 'message.Encampment',
                'label' => 'Encampment',
                'parent_id' => 5,
                'sort' => 1,
                'icon' => 'mountain',
                'route' => null
            ],
            [
                'id' => 7,
                'name' => 'menu.Camp',
                'label' => 'Camp',
                'parent_id' => 6,
                'sort' => 1,
                'icon' => 'campground',
                'route' => 'setup.camp.index'
            ],
            [
                'id' => 8,
                'name' => 'menu.Block',
                'label' => 'Block',
                'parent_id' => 6,
                'sort' => 2,
                'icon' => 'map',
                'route' => 'setup.block.index'
            ],
            [
                'id' => 9,
                'name' => 'menu.Facility',
                'label' => 'Facility',
                'parent_id' => 5,
                'sort' => 2,
                'icon' => 'circle',
                'route' => 'setup.facility.index'
            ],
            [
                'id' => 10,
                'name' => 'menu.Facility Used',
                'label' => 'Facility Used',
                'parent_id' => 5,
                'sort' => 3,
                'icon' => 'circle',
                'route' => 'setup.facility-used.index'
            ],
            [
                'id' => 11,
                'name' => 'menu.PIT',
                'label' => 'PIT',
                'parent_id' => 5,
                'sort' => 4,
                'icon' => 'circle',
                'route' => 'setup.pit.index'
            ],
            // [
            //     'id' => 12,
            //     'name' => 'menu.PWSN',
            //     'label' => 'PWSN',
            //     'parent_id' => 5,
            //     'sort' => 5,
            //     'icon' => 'circle',
            //     'route' => 'setup.pwsn.index'
            // ],
            [
                'id' => 13,
                'name' => 'menu.Structure',
                'label' => 'Structure',
                'parent_id' => 5,
                'sort' => 6,
                'icon' => 'circle',
                'route' => 'setup.structure.index'
            ],
            [
                'id' => 14,
                'name' => 'menu.Construction',
                'label' => 'Construction',
                'parent_id' => 5,
                'sort' => 7,
                'icon' => 'circle',
                'route' => 'setup.construction.index'
            ],
            [
                'id' => 15,
                'name' => 'menu.Donor',
                'label' => 'Donor',
                'parent_id' => 5,
                'sort' => 8,
                'icon' => 'circle',
                'route' => 'setup.donor.index'
            ],
            [
                'id' => 16,
                'name' => 'message.Latrine Management',
                'label' => 'Latrine Management',
                'parent_id' => null,
                'sort' => 4,
                'icon' => 'restroom',
                'route' => 'latrine.index|inspection.index|desludge.index|complaint.index'
            ],
            [
                'id' => 17,
                'name' => 'menu.Agency',
                'label' => 'Agency',
                'parent_id' => null,
                'sort' => 5,
                'icon' => 'house',
                'route' => 'agency.index'
            ],
            [
                'id' => 18,
                'name' => 'menu.Team',
                'label' => 'Team',
                'parent_id' => null,
                'sort' => 6,
                'icon' => 'people-group',
                'route' => 'team.index'
            ],
            [
                'id' => 19,
                'name' => 'menu.Position',
                'label' => 'Position',
                'parent_id' => 2,
                'sort' => 3,
                'icon' => 'street-view',
                'route' => 'position.index'
            ],
            [
                'id' => 20,
                'name' => 'menu.Latrine',
                'label' => 'Latrine',
                'parent_id' => 16,
                'sort' => 1,
                'icon' => 'toilet',
                'route' => 'latrine.index'
            ],
            [
                'id' => 21,
                'name' => 'menu.Inspection',
                'label' => 'Inspection',
                'parent_id' => 16,
                'sort' => 2,
                'icon' => 'lightbulb',
                'route' => 'inspection.index'
            ],
            [
                'id' => 22,
                'name' => 'menu.Desludge',
                'label' => 'Desludge',
                'parent_id' => 16,
                'sort' => 3,
                'icon' => 'person-digging',
                'route' => 'desludge.index'
            ],
            [
                'id' => 23,
                'name' => 'menu.Complaint',
                'label' => 'Complaint',
                'parent_id' => 16,
                'sort' => 4,
                'icon' => 'box-open',
                'route' => 'complaint.index'
            ],
            [
                'id' => 24,
                'name' => 'menu.Transfer',
                'label' => 'Transfer',
                'parent_id' => 5,
                'sort' => 9,
                'icon' => 'circle',
                'route' => 'setup.transfer.index'
            ],
            [
                'id' => 25,
                'name' => 'menu.Season',
                'label' => 'Season',
                'parent_id' => 5,
                'sort' => 10,
                'icon' => 'circle',
                'route' => 'setup.season.index'
            ],
            [
                'id' => 26,
                'name' => 'menu.Sanitation Zone',
                'label' => 'Sanitation Zone',
                'parent_id' => 5,
                'sort' => 11,
                'icon' => 'circle',
                'route' => 'setup.sanitation-zone.index'
            ],
            [
                'id' => 27,
                'name' => 'message.Reports',
                'label' => 'Reports',
                'parent_id' => null,
                'sort' => 6,
                'icon' => 'folder',
                'route' => 'report.latrine.index|report.desludge.index|report.sanitation-zone.index'
            ],
            [
                'id' => 28,
                'name' => 'menu.Latrine Report',
                'label' => 'Latrine Report',
                'parent_id' => 27,
                'sort' => 1,
                'icon' => 'toilet',
                'route' => 'report.latrine.index'
            ],
            [
                'id' => 29,
                'name' => 'menu.Desludge Report',
                'label' => 'Desludge Report',
                'parent_id' => 27,
                'sort' => 2,
                'icon' => 'person-digging',
                'route' => 'report.desludge.index'
            ],
            [
                'id' => 30,
                'name' => 'menu.Sanitation Zone Report',
                'label' => 'Sanitation Zone Report',
                'parent_id' => 27,
                'sort' => 3,
                'icon' => 'circle',
                'route' => 'report.sanitation-zone.index'
            ],
            [
                'id' => 31,
                'name' => 'menu.Home',
                'label' => 'Home',
                'parent_id' => 1,
                'sort' => 1,
                'icon' => 'house-user',
                'route' => 'dashboard'
            ],
            [
                'id' => 32,
                'name' => 'menu.Map',
                'label' => 'Map',
                'parent_id' => 1,
                'sort' => 2,
                'icon' => 'map',
                'route' => 'map'
            ],
        ];

        DB::table('permission_groups')->insert($data);

        $this->command->info('Permission groups has been created!');
    }
}
