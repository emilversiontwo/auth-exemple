<?php

namespace App\Services\Cotalog\Http;

use App\Models\Cotalog;
use App\Services\Cotalog\Dto\GetDto;
use App\Services\Cotalog\Dto\UpdateDto;

class UpdateHttpService
{
    /**
     * @var GetHttpService
     */
    private GetHttpService $getHttpService;

    public function __construct(GetHttpService $getHttpService){
        $this->getHttpService = $getHttpService;
    }

    public function update(UpdateDto $dto): Cotalog
    {
        $model = $this->getHttpService->get(new GetDto(['cotalogId' => $dto->cotalogId]));

        $model->name = $dto->name;
        $model->price = $dto->price;
        $model->quantity = $dto->quantity;

        $model->save();

        return $model;
    }
}
