<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Courses\Models\Course;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        Course::factory()->count(10)->create();
    }
}
