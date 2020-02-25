<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bookings extends Model {

    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    protected $table = 'bookings';

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
        'email',
        'status',
        'cnic',
        'ntn',
        'phone',
        'checkin_at',
        'checkout_at',
        'adults',
        'children',
        'total',
        'advance',
        'notes',
        'created_at',
        'updated_at',
    ];

    /**
     * The roles that belong to the user.
     */
    public function hotel() {
        return $this->belongsTo('App\Hotel', 'hotel_id');
    }

}
