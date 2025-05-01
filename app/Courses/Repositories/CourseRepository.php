<?php

namespace App\Courses\Repositories;

use App\Courses\Models\Course;
use Illuminate\Support\Collection;

class CourseRepository
{
    public function all(): Collection
    {
        return Course::all();
    }

    public function find($id): ?Course
    {
        return Course::find($id);
    }

    public function create(string $title, ?string $description, string $status, bool $is_premium): Course
    {
        return Course::create([
            'title' => $title,
            'description' => $description,
            'status' => $status,
            'is_premium' => $is_premium,
        ]);
    }

    public function update(int $id, array $data): Course
    {
        $course = Course::findOrFail($id);
        $course->update($data);
        return $course;
    }

    public function delete(int $id): void
    {
        $course = Course::findOrFail($id);
        $course->delete();
    }

    public function titleExists(string $title): bool
    {
        return Course::where('title', $title)->exists();
    }
}
