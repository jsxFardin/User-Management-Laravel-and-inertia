<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            PermissionGroupSeeder::class,
            PermissionSeeder::class,
            SeasonSeader::class,
            PermissionRoleTableSeeder::class,
            CampsTableSeeder::class,
            BlocksTableSeeder::class,
            DonorsTableSeeder::class,
            ConstructionStatusTableSeeder::class,
            FacilityTypesTableSeeder::class,
            FacilityUsedsTableSeeder::class,
            LatrineStructuresTableSeeder::class,
            PitTypesTableSeeder::class,
            SludgeTransfersTableSeeder::class,
            SanitationZonesTableSeeder::class,
            LatrinesTableSeeder::class
        ]);
    }
}
