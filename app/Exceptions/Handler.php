<?php

namespace App\Exceptions;


use App\Courses\Exceptions\CourseNotFoundException;
use App\Courses\Exceptions\CourseTitleAlreadyExistsException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    public function render($request, Throwable $exception)
    {
        if ($request->expectsJson() || $request->is('api/*')) {
            if ($exception instanceof CourseTitleAlreadyExistsException) {
                return response()->json([
                    'success' => false,
                    'message' => $exception->getMessage()
                ], 409);
            }

            if ($exception instanceof CourseNotFoundException) {
                return response()->json([
                    'success' => false,
                    'message' => $exception->getMessage()
                ], 404);
            }
        }

        return parent::render($request, $exception);
    }


}
