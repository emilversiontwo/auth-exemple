<?php

namespace App\Services\Cotalog\Http;

use App\Dto\BaseDto;
use App\Models\Cotalog;
use App\Services\Cotalog\Dto\GetDto;

class GetHttpService
{
    /**
     * This get Method
     * @param GetDto $dto
     * @return Cotalog
     */
    public function get(GetDto $dto): Cotalog
    {
        $query = Cotalog::query();

        $model = $query->where('id', '=', $dto->cotalogId)->firstOrFail();

        return $model;
    }
}
