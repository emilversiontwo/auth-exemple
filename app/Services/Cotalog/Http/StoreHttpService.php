<?php

namespace App\Services\Cotalog\Http;

use App\Models\Cotalog;
use App\Services\Cotalog\Dto\StoreDto;

class StoreHttpService
{
    public function store(StoreDto $dto)
    {
        $item = new Cotalog();

        $item->name = $dto->name;
        $item->price = $dto->price;
        $item->quantity = $dto->quantity;

        $item->save();

        return $item;
    }
}
