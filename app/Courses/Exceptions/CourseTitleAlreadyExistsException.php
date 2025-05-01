<?php

namespace App\Courses\Exceptions;

use Exception;

class CourseTitleAlreadyExistsException extends Exception
{
    protected $message = 'Course title already exists.';

}
