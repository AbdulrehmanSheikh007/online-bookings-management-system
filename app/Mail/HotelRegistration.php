<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class HotelRegistration extends Mailable
{
    use Queueable, SerializesModels;

    public $hotel;
    public $is_create;

    /**
     * BrandRegistration constructor.
     * @param $brand
     * @param int $is_create
     */
    public function __construct($hotel, $is_create = 0)
    {
        $this->hotel = $hotel;
        $this->is_create = $is_create;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mailable_views.store_registration');
    }
}
