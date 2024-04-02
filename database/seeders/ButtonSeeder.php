<?php

namespace Database\Seeders;

use App\Models\ButtonActive;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ButtonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('button_actives')->delete();

        $btn = 
        [
            [
                'nom' => 'StartBtnDay',
                'actif' => true
            ],
            [
                'nom' => 'EndBtnDay',
                'actif' => false
            ]

        ];

        ButtonActive::insert($btn);
    }
}
