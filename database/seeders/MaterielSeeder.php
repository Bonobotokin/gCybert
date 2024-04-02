<?php

namespace Database\Seeders;

use App\Models\Materiels;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaterielSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('materiels')->delete();

        $materiels = [
            
        ];

        Materiels::insert($materiels);
    }
}
