<?php

namespace App\Models\Master;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Eloquence\Behaviours\CamelCasing;

class Currency extends Model
{
    use CrudTrait;
    use HasFactory, CamelCasing;
    protected $fillable = [
        'symbol',
        'name',
        'symbol_native',
        'decimal_digits',
        'rounding',
        'code',
        'name_plural',
    ];
}
