<?php

namespace App\Models;

use App\Models\Master\Item;
use App\Models\Master\Location;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItemInventory extends Model
{
    use CrudTrait;
    use HasFactory;
    protected $fillable = [
        'location_id',
        'item_id',
        'qty',
        'date',
        'note',
        'user_id',
    ];
    /**
     * Get the user that owns the ItemInventory
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    /**
     * Get the location that owns the ItemInventory
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class, 'location_id');
    }
    /**
     * Get the item that owns the ItemInventory
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
}
