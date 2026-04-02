<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class OrdersDetail extends Model
{
    protected $table = 'order_detail';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'price',
        'quantity',
        'product_id',
        'order_id',
        'deleted'
    ];
}
