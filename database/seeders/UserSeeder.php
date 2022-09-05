<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        User::query()->truncate();
        Schema::enableForeignKeyConstraints();

        $data = [
            [
                'id_no' => '12345678',
                'name' => 'Superadmin',
                'username' => 'user_001',
                'email' => 'superadmin@test.com',
                'mobile' => '098765432',
                'password'  => app('hash')->make('12345678'),
                'email_verified_at' => now(),
                'remember_token' => null,
            ]
        ];

        DB::table('users')->insert($data);
        // User::factory()->count(200)->create();
        DB::table('role_user')->insert([
            [
                'role_id' => 1,
                'user_id' => 1
            ]
        ]);

        $this->command->info('User data created');
    }
}
