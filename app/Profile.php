<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{

    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'country',
        'city',
        'address',
        'phone',
        'email_verified_at',
        'password',
        'address',
        'remember_token',
        'created_at',
        'updated_at',
    ];
}
