<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Products extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'products';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    protected $fillable = [
        'custom_id',
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

    public function images()
    {
        return $this->hasOne(Image::class, 'product_id', 'id');
    }
}
