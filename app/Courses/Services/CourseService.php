<?php

namespace App\Courses\Services;

use App\Courses\DTO\CreateCourseDTO;
use App\Courses\DTO\UpdateCourseDTO;
use App\Courses\DTO\DeleteCourseDTO;
use App\Courses\Exceptions\CourseNotFoundException;
use App\Courses\Models\Course;
use App\Courses\Repositories\CourseRepository;
use App\Courses\Resources\CourseResource;
use Illuminate\Support\Collection;

class CourseService
{
    protected CourseRepository $courseRepository;

    public function __construct(CourseRepository $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    public function createCourse(array $data): CourseResource
    {
        $dto = new CreateCourseDTO($data);

        $course = $this->courseRepository->create(
            $dto->title,
            $dto->description,
            $dto->status,
            $dto->is_premium
        );

        return new CourseResource($course);
    }

    public function getCourses(): Collection
    {
        return $this->courseRepository->all();
    }

    /**
     * @throws CourseNotFoundException
     */
    public function findById($id): CourseResource
    {
        $course = $this->courseRepository->find($id);

        if (!$course) {
            throw new CourseNotFoundException();
        }

        return new CourseResource($course);
    }

    /**
     * @throws CourseNotFoundException
     */
    public function updateCourse(array $data): CourseResource
    {
        $dto = new UpdateCourseDTO($data);
        $course = $this->courseRepository->find($dto->id);

        if (!$course) {
            throw new CourseNotFoundException();
        }

        $updated = $this->courseRepository->update($dto->id, $data);

        return new CourseResource($updated);
    }

    /**
     * @throws CourseNotFoundException
     */
    public function deleteCourse(array $data): CourseResource
    {
        $dto = new DeleteCourseDTO($data);

        $course = $this->courseRepository->find($dto->id);

        if (!$course) {
            throw new CourseNotFoundException();
        }

        $this->courseRepository->delete($dto->id);

        return new CourseResource([
            'success' => true,
            'message' => "Course with ID {$dto->id} deleted successfully."
        ]);
    }
}
