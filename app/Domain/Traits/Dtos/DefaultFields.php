<?php

namespace App\Domain\Traits\Dtos;

use App\Support\Utils\DateFormat\DateFormat;

trait DefaultFields
{
    public int $id = 0;
    public ?string $createdAt = "";
    public ?string $updatedAt = "";

    protected function mapCommonFields(array $data): void
    {
        $this->createdAt = DateFormat::dateFormat($data['created_at'] ?? '') ?? '';
        $this->updatedAt = DateFormat::dateFormat($data['updated_at'] ?? '') ?? '';
    }
}
