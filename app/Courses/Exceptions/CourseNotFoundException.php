<?php

namespace App\Courses\Exceptions;

use Exception;

class CourseNotFoundException extends Exception
{
    protected $message = 'Course not found.';
}
