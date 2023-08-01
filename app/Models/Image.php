<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function products()
    {
        return $this->belongsTo(Products::class, 'id', 'product_id');
    }
}
