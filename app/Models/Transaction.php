<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table = 'transaction';
    protected $fillable = [
        'orders_id',
        'transaction_detail_id',
        'product_id',
        'qty',
        'created_at',
        'updated_at',
    ];
}
