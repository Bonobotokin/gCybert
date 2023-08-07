<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->delete();

        $users = [
            'name' => 'Ny Avo',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin1234'),
            'role' => 0
        ];

        User::insert($users);

    }
}
