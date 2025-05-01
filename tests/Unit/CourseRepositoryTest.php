<?php

namespace Tests\Unit;

use App\Courses\Repositories\CourseRepository;
use App\Courses\Models\Course;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Mockery;

class CourseRepositoryTest extends TestCase
{
    use RefreshDatabase;
    protected $courseRepository;

    public function setUp(): void
    {
        parent::setUp();
        $this->courseRepository = new CourseRepository();
    }

    public function testFind()
    {
        $course = Course::create([
            'title' => 'Sample Course',
            'description' => 'A description',
            'status' => 'Published',
            'is_premium' => false,
        ]);

        $result = $this->courseRepository->find($course->id);

        $this->assertInstanceOf(Course::class, $result);
        $this->assertEquals($course->id, $result->id);
    }


    public function testCreate()
    {
        $this->assertDatabaseCount('courses', 0);

        $data = [
            'title' => 'New Course',
            'description' => 'Description',
            'status' => 'Published',
            'is_premium' => true,
        ];

        $course = $this->courseRepository->create(
            $data['title'],
            $data['description'],
            $data['status'],
            $data['is_premium']
        );

        $this->assertDatabaseHas('courses', [
            'title' => 'New Course',
            'description' => 'Description',
            'status' => 'Published',
            'is_premium' => true,
        ]);

        $this->assertEquals('New Course', $course->title);
    }
    public function testUpdate()
    {
        $course = Course::create([
            'title' => 'Original Title',
            'description' => 'Initial Description',
            'status' => 'Published',
            'is_premium' => false,
        ]);

        $updated = $this->courseRepository->update($course->id, [
            'title' => 'Updated Title',
        ]);

        $this->assertEquals('Updated Title', $updated->title);
        $this->assertDatabaseHas('courses', [
            'id' => $course->id,
            'title' => 'Updated Title',
        ]);
    }

    public function testDelete()
    {
        $course = Course::create([
            'title' => 'Sample',
            'description' => 'Desc',
            'status' => 'Published',
            'is_premium' => false,
        ]);

        $this->courseRepository->delete($course->id);

        $this->assertSoftDeleted('courses', ['id' => $course->id]);
    }
}
