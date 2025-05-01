<?php

namespace App\Courses\Services;

use App\Courses\Models\Course;
use App\Courses\Resources\CourseResource;
use Illuminate\Support\Collection;

interface CourseServiceInterface
{
    public function getCourses(): Collection;

    public function findById($id): CourseResource;

    public function createCourse(array $data): CourseResource;

    public function deleteCourse(array $data): CourseResource;

    public function updateCourse(array $data): CourseResource;
}

