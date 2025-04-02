<?php

namespace App\Services\Cotalog\Dto;

use App\Dto\BaseDto;
use App\Models\Cotalog;

class UpdateDto extends BaseDto
{
    /** @var string */
    public string $name;

    /** @var int */
    public int $price;

    /** @var int */
    public int $quantity;

    /** @var int */
    public int $cotalogId;
}
