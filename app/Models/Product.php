<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'product_name',
        'price',
        'discount',
        'image',
        'description_short',
        'description',
        'origin',
        'quantity',
        'created',
        'brand_id',
        'gender_id',
        'category_id',
        'deleted'
    ];

    public function comment()
    {
        return $this->hasMany('App\Models\Comment');
    }
}
