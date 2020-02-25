<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hotel extends Model {

    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'logo',
        'status',
        'email',
        'UAN',
        'contact_first_name',
        'contact_last_name',
        'contact_number_1',
        'contact_number_2',
        'contact_email',
        'address_line_1',
        'address_line_2',
        'city',
        'state',
        'postal_code',
        'country',
        'website_uri',
        'created_at',
        'updated_at',
    ];

    /**
     * The roles that belong to the user.
     */
    public function passengers() {
        return $this->hasMany('App\User', 'hotel_id');
    }

    /**
     * The roles that belong to the user.
     */
    public function bookings() {
        return $this->hasMany('App\Bookings', 'hotel_id');
    }

    // this is a recommended way to declare event handlers
    public static function boot() {
        parent::boot();

        static::deleting(function($hotel) { // before delete() method call this
            $hotel->passengers()->delete();
            $hotel->bookings()->delete();
        });
    }

}
