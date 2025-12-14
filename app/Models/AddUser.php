<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AddUser extends Model
{
    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'role',
        'password'
    ];
}
