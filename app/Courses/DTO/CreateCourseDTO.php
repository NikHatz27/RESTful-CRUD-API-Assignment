<?php

namespace App\Courses\DTO;

class CreateCourseDTO
{
    public string $title;
    public ?string $description;
    public string $status;
    public bool $is_premium;

    public function __construct(array $data)
    {
        $this->title = $data['title'];
        $this->description = $data['description'] ?? null;
        $this->status = $data['status'] ?? 'Pending';
        $this->is_premium = $data['is_premium'] ?? false;
    }
}