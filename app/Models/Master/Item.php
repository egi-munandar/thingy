<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
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
    ];
}
