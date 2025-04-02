<?php

namespace App\Dto\Dto;

interface Dto
{
    public function __construct(array $data);

    public static function fromArray(array $data): static;

    public function toArray(): array;
}
