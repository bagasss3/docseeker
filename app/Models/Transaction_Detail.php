<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction_Detail extends Model
{
    use HasFactory;
    protected $table = 'transaction_detail';

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'street_address',
        'country',
        'province',
        'city',
        'zip_code',
        'payment_id',
    ];
}
