<?php

namespace App\Models\Master;

use Eloquence\Behaviours\CamelCasing;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Instance extends Model
{
    use HasFactory, CamelCasing;
    protected $fillable = [
        'name',
        'currency_code',
        'currency',
        'currency_symbol',
    ];
    /**
     * Get the currency that owns the Instance
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function curr(): BelongsTo
    {
        return $this->belongsTo(Currency::class, 'currency_code', 'code');
    }
}
