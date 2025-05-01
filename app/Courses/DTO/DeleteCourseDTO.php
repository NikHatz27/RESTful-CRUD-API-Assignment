<?php


namespace App\Courses\DTO;

class DeleteCourseDTO
{
    public int $id;

    public function __construct(array $data)
    {
        $this->id = $data['id'];
    }
}
