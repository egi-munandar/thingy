<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Location extends Model
{
    use HasFactory;
    protected $fillable = [
        'parent_id',
        'instance_id',
        'path',
        'name'
    ];
    /**
     * Get the instance that owns the Location
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function instance(): BelongsTo
    {
        return $this->belongsTo(Instance::class, 'instance_id');
    }
}
