<?php

namespace App\Courses\Controllers;

use App\Courses\Exceptions\CourseNotFoundException;
use App\Courses\Resources\CourseResource;
use App\Http\Controllers\Controller;
use App\Courses\Services\CourseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CourseController extends Controller
{
    protected CourseService $courseService;

    public function __construct(CourseService $courseService)
    {
        $this->courseService = $courseService;
    }

    public function createCourse(Request $request): CourseResource
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'status' => 'in:Published,Pending',
            'is_premium' => 'boolean',
        ]);

        return $this->courseService->createCourse($validated);
    }

    public function index(): AnonymousResourceCollection
    {
        $courses = $this->courseService->getCourses();
        return CourseResource::collection($courses);
    }

    /**
     * @throws CourseNotFoundException
     */
    public function showById($id): CourseResource
    {
        return $this->courseService->findById($id);
    }

    /**
     * @throws CourseNotFoundException
     */
    public function updateCourse(Request $request, int $id): CourseResource|JsonResponse
    {
        $validated = $request->validate([
            'title' => 'sometimes|string',
            'description' => 'sometimes|nullable|string',
            'status' => 'sometimes|in:Published,Pending',
            'is_premium' => 'sometimes|boolean',
        ]);

        if (empty($validated)) {
            return response()->json([
                'success' => false,
                'message' => 'At least one field must be provided for update.',
            ], 422);
        }

        $validated['id'] = $id;

        return $this->courseService->updateCourse($validated);
    }

    /**
     * @throws CourseNotFoundException
     */
    public function deleteCourse(int $id): CourseResource
    {
        return $this->courseService->deleteCourse(['id' => $id]);
    }
}
