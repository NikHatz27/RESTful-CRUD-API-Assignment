<?php

namespace Tests\Unit;

use App\Courses\Controllers\CourseController;
use App\Courses\Models\Course;
use App\Courses\Resources\CourseResource;
use App\Courses\Services\CourseService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Mockery;
use Tests\TestCase;

class CourseControllerTest extends TestCase
{
    protected $courseService;
    protected $controller;

    public function setUp(): void
    {
        parent::setUp();
        $this->courseService = Mockery::mock(CourseService::class);
        $this->controller = new CourseController($this->courseService);
    }

    public function testCreateCourse()
    {
        $validatedData = [
            'title' => 'New Course',
            'description' => 'Course description',
            'status' => 'Published',
            'is_premium' => true,
        ];

        $request = \Mockery::mock(Request::class);
        $request->shouldReceive('validate')
            ->once()
            ->with(\Mockery::on(function ($rules) {
                return $rules === [
                        'title' => 'required|string',
                        'description' => 'nullable|string',
                        'status' => 'in:Published,Pending',
                        'is_premium' => 'boolean',
                    ];
            }))
            ->andReturn($validatedData);

        $course = new \App\Courses\Models\Course($validatedData);

        $this->courseService->shouldReceive('createCourse')
            ->once()
            ->with($validatedData)
            ->andReturn(new \App\Courses\Resources\CourseResource($course));

        $response = $this->controller->createCourse($request);

        $this->assertInstanceOf(\App\Courses\Resources\CourseResource::class, $response);
    }


    public function testIndex()
    {
        $this->courseService->shouldReceive('getCourses')
            ->once()
            ->andReturn(collect([new Course()]));

        $response = $this->controller->index();
        $this->assertInstanceOf(AnonymousResourceCollection::class, $response);
    }

    public function testShowById()
    {
        $this->courseService->shouldReceive('findById')
            ->once()
            ->with(1)
            ->andReturn(new CourseResource(new Course()));

        $response = $this->controller->showById(1);

        $this->assertInstanceOf(CourseResource::class, $response);
    }

    public function testUpdateCourse()
    {
        $request = \Mockery::mock(Request::class);
        $request->shouldReceive('validate')
            ->once()
            ->with([
                'title' => 'sometimes|string',
                'description' => 'sometimes|nullable|string',
                'status' => 'sometimes|in:Published,Pending',
                'is_premium' => 'sometimes|boolean',
            ])
            ->andReturn([
                'title' => 'Updated Course',
            ]);

        $validatedData = [
            'title' => 'Updated Course',
            'id' => 1,
        ];

        $course = new Course($validatedData);

        $this->courseService->shouldReceive('updateCourse')
            ->once()
            ->with($validatedData)
            ->andReturn(new CourseResource($course));

        $response = $this->controller->updateCourse($request, 1);

        $this->assertInstanceOf(CourseResource::class, $response);
    }
    public function testDeleteCourse()
    {
        $course = new Course([
            'id' => 1,
            'title' => 'Course to Delete',
            'description' => 'Description',
            'status' => 'Published',
            'is_premium' => false,
        ]);

        $this->courseService->shouldReceive('deleteCourse')
            ->once()
            ->with(['id' => 1])
            ->andReturn(new CourseResource($course));

        $response = $this->controller->deleteCourse(1);

        $this->assertInstanceOf(CourseResource::class, $response);
    }

}
