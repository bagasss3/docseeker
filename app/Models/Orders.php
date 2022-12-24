<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    protected $fillable = [
        'custom_id',
        'transaction_id',
        'status',
        'created_at',
        'updated_at',
    ];
}
