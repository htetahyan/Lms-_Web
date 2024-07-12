<?php

namespace Database\Seeders;

use App\Models\Year;
use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.b
     */
    public function run(): void
    {
        if (Year::count() == 0) {
            for ($i = 1; $i <= 5; $i++) {
                Year::create(['name' => 'Year ' . $i]);
            }
        }

        // Seed 1000 students
        Student::factory()->count(1000)->create();
    }
}
