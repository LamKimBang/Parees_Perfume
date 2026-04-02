<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'address',
        'feeship',
        'discount',
        'total',
        'note',
        'created',
        'order_status_id',
        'payment_id',
        'user_id',
        'deleted'
    ];

}
