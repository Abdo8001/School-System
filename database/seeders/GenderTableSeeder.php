<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\genders;
class GenderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('genders')->delete();

        $genders = [
            ['en'=> 'Male', 'ar'=> 'ذكر'],
            ['en'=> 'Female', 'ar'=> 'انثي'],

        ];
        foreach ($genders as $ge) {
            genders::create(['Name' => $ge]);
        }
    }
}
