<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserHasInstance extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'instance_id',
    ];
}
