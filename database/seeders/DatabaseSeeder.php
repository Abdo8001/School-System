<?php

namespace Database\Seeders;
use Database\Seeders\blood_type;
use Database\Seeders\nationalities;
use Database\Seeders\religionTableSeeder;
use Database\Seeders\GenderTableSeeder;
use Database\Seeders\SpecilizationSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\GradeSeeder;
use Database\Seeders\ParentsTableSeeder;
use Database\Seeders\SectionsTableSeeder;
use Database\Seeders\ClassroomTableSeeder;
use Database\Seeders\StudentsTableSeeder;
use Database\Seeders\SettingSeeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(UserSeeder::class);
        $this->call(GradeSeeder::class);
        $this->call(ClassroomTableSeeder::class);
        $this->call(SectionsTableSeeder::class);
        $this->call(blood_type::class);
        $this->call(nationalities::class);
        $this->call(religionTableSeeder::class);
        $this->call(GenderTableSeeder::class);
        $this->call(SpecilizationSeeder::class);
        $this->call(ParentsTableSeeder::class);
        $this->call(StudentsTableSeeder::class);
        $this->call(SettingSeeder::class);
    }
}
