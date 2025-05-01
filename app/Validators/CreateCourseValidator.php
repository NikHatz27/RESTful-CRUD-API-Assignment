<?php

namespace App\Validators;

use App\Courses\Repositories\CourseRepository;
use App\Courses\DTO\ValidationResultDTO;

class CreateCourseValidator
{
public function __construct(
protected CourseRepository $repository
) {}

public function validate(string $title): ValidationResultDTO
{
if ($this->repository->titleExists($title)) {
return new ValidationResultDTO(false, 'Course title already exists.');
}

return new ValidationResultDTO(true, 'valid');
}
}
