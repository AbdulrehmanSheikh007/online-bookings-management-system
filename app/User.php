<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable {

    use Notifiable;

use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'hotel_id',
        'first_name',
        'last_name',
        'username',
        'email',
        'cnic',
        'ntn',
        'address_line_1',
        'address_line_2',
        'state',
        'postal_code',
        'phone',
        'status',
        'password',
        'email_verified_at',
        '_token',
        '_token_expiry',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The users that belong to the hotel.
     */
    public function hotel() {
        return $this->belongsTo('App\Hotel', 'hotel_id');
    }

    public static function boot() {
        parent::boot();

        static::deleting(function($user) { // before delete() method call this
            
        });
    }

}
