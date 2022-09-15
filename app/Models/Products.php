<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $table = 'products';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    protected $fillable = [
        'product_cat',
        'product_gender',
        'product_brand',
        'product_title',
        'product_harga',
        'product_desc',
        'product_image',
        'stock',
        'weight',
    ];
}
