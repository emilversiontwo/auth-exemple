<?php

namespace App\Services\Cotalog\Dto;

use App\Dto\BaseDto;

class StoreDto extends BaseDto
{
    /** @var string */
    public string $name;

    /** @var int */
    public int $price;

    /** @var int */
    public int $quantity;
}
