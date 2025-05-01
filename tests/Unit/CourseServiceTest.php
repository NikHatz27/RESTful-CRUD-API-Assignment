<?php


namespace Tests\Unit;

use App\Courses\Exceptions\CourseNotFoundException;
use App\Courses\Resources\CourseResource;
use App\Courses\Services\CourseService;
use App\Courses\Repositories\CourseRepository;
use App\Courses\Models\Course;
use PHPUnit\Framework\TestCase;
use Mockery;

class CourseServiceTest extends TestCase
{
    protected CourseRepository $courseRepository;
    protected CourseService $courseService;

    public function setUp(): void
    {
        parent::setUp();
        $this->courseRepository = Mockery::mock(CourseRepository::class);
        $this->courseService = new CourseService($this->courseRepository);
    }

    public function testCreateCourse()
    {
        $courseData = [
            'title' => 'New Course',
            'description' => 'Description',
            'status' => 'Published',
            'is_premium' => true,
        ];

        $this->courseRepository->shouldReceive('create')
            ->once()
            ->with($courseData['title'], $courseData['description'], $courseData['status'], $courseData['is_premium'])
            ->andReturn(new Course($courseData));

        $response = $this->courseService->createCourse($courseData);
        $this->assertInstanceOf(CourseResource::class, $response);
    }

    /**
     * @throws CourseNotFoundException
     */
    public function testFindById()
    {
        $this->courseRepository->shouldReceive('find')
            ->once()
            ->with(1)
            ->andReturn(new Course(['id' => 1, 'title' => 'Course 1']));

        $response = $this->courseService->findById(1);
        $this->assertInstanceOf(CourseResource::class, $response);
    }

    /**
     * @throws CourseNotFoundException
     */
    public function testUpdateCourse()
    {
        $updateData = ['id' => 1, 'title' => 'Updated Title'];

        $this->courseRepository->shouldReceive('find')
            ->once()
            ->with(1)
            ->andReturn(new Course(['id' => 1, 'title' => 'Old Title']));

        $this->courseRepository->shouldReceive('update')
            ->once()
            ->with(1, ['id' => 1, 'title' => 'Updated Title'])
            ->andReturn(new Course(['id' => 1, 'title' => 'Updated Title']));


        $response = $this->courseService->updateCourse($updateData);
        $this->assertInstanceOf(CourseResource::class, $response);
    }

    /**
     * @throws CourseNotFoundException
     */
    public function testDeleteCourse()
    {
        $this->courseRepository->shouldReceive('find')
            ->once()
            ->with(1)
            ->andReturn(new Course(['id' => 1]));

        $this->courseRepository->shouldReceive('delete')
            ->once()
            ->with(1)
            ->andReturnNull();

        $response = $this->courseService->deleteCourse(['id' => 1]);
        $this->assertInstanceOf(CourseResource::class, $response);
    }
}
