<?php

namespace App\Courses\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    public function toArray($request): array
    {
        if (is_array($this->resource)) {
            return [
                'success' => $this->resource['success'] ?? false,
                'message' => $this->resource['message'] ?? null,
                'id' => $this->resource['id'] ?? null,
                'title' => $this->resource['title'] ?? null,
                'description' => $this->resource['description'] ?? null,
                'status' => $this->resource['status'] ?? null,
                'is_premium' => $this->resource['is_premium'] ?? null,
                'created_at' => $this->resource['created_at'] ?? null,
            ];
        }

        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
            'is_premium' => $this->is_premium,
            'created_at' => $this->created_at,
        ];
    }

}
