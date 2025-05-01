<?php

namespace App\Courses\DTO;

class ValidationResultDTO
{
    public function __construct(
        private bool $valid,
        private string $message
    ) {}

    public function isValid(): bool
    {
        return $this->valid;
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}
