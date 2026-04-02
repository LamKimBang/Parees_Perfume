<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class User_status extends Model
{
    protected $table = 'user_status';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'status_name',
        'deleted'
    ];
}
