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
            'name' => 'TSANGAMILA Tokin',
            'email' => 'tokin@gmail.com',
            'password' => bcrypt('23@tokin.DEV')
        ];

        User::insert($users);

    }
}
