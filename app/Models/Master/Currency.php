<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Eloquence\Behaviours\CamelCasing;

class Currency extends Model
{
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
