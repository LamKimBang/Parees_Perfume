<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    
    protected $table = 'user';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'username',
        'password',
        'date_of_birth',
        'full_name',
        'gender_id',
        'email',
        'phone',
        'home_address',
        'company_address',
        'user_status_id',
        'role_id',
        'deleted'
    ];
}
