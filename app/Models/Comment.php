<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comment';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'content',
        'rate',
        'created',
        'comment_id',
        'product_id',
        'user_id',
        'deleted'
    ];

    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
}
