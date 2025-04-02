<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $name
 * @property int $price
 * @property int $quantity
 */
class Cotalog extends Model
{
    protected $fillable = [
      'name',
      'price',
      'quantity',
    ];
}
