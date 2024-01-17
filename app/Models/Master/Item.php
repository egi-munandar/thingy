<?php

namespace App\Models\Master;

use App\Models\User;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Eloquence\Behaviours\CamelCasing;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Item extends Model
{
    use CrudTrait;
    use HasFactory, CamelCasing;
    protected $fillable = [
        'asset_id',
        'archived',
        'name',
        'qty',
        'description',
        'purchase_price',
        'purchase_from',
        'purchase_time',
        'manufacturer',
        'model_number',
        'serial_number',
        'lifetime_warranty',
        'warranty_expires',
        'warranty_details',
        'sold_to',
        'sold_price',
        'sold_time',
        'sold_notes',
        'bom',
        'user_id',
    ];
    /**
     * Get the user that owns the Item
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
