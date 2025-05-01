<?php

namespace App\Courses\DTO;

class UpdateCourseDTO
{
    public int $id;
    public string $title;
    public ?string $description;
    public string $status;
    public bool $is_premium;

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->title = $data['title'];
        $this->description = $data['description'] ?? null;
        $this->status = $data['status'] ?? 'Pending';
        $this->is_premium = $data['is_premium'] ?? false;
    }
}
