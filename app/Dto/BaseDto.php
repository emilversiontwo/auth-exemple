<?php

namespace App\Dto;

use App\Dto\Dto\Dto;
use ReflectionClass;
use ReflectionProperty;

abstract class BaseDto implements Dto
{
    public function __construct(array $data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    public static function fromArray(array $data): static
    {
        return new static($data);
    }

    public function toArray(): array
    {
        $reflection = new ReflectionClass($this);

        $properties = $reflection->getProperties(ReflectionProperty::IS_PUBLIC);

        $data = [];
        foreach ($properties as $property) {
            $data[$property->getName()] = $this->{$property->getName()};
        }

        return $data;
    }
}
