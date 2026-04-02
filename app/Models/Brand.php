<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brand';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'brand_name',
        'brand_image',
        'deleted'
    ];
}

?>