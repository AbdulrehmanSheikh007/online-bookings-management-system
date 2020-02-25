<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        /*
         * Database Schema 
         * Hotels Management
         */
        Schema::create('hotels', function (Blueprint $table) {
            //Primary Information
            $table->increments('id');
            $table->string('name');
            $table->string('logo', 500)->nullable();
            $table->boolean('status')->default(false);
            $table->string('email');
            $table->string('UAN')->nullable();
            $table->string('folder_path')->nullable();

            //Contact Information
            $table->string('contact_first_name')->nullable();
            $table->string('contact_last_name')->nullable();
            $table->string('contact_number_1')->nullable();
            $table->string('contact_number_2')->nullable();
            $table->string('contact_email')->nullable();

            // Address Information
            $table->text('address_line_1')->nullable();
            $table->text('address_line_2')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('country')->nullable();

            //Website Platform
            $table->string('website_uri', 150)->nullable();

            $table->softDeletes();
            $table->timestamps();
        });

        /*
         * Database Schema 
         * Users & Passengers Management
         * If hotel id exists then passengers
         * Else admin user
         */
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('hotel_id')->nullable()->coment("NULL = Admin, Not NULL = Passenger");
            $table->string('first_name');
            $table->string('last_name');
            $table->string('username');
            $table->string('email');
            $table->string('cnic');
            $table->string('ntn')->nullable();
            $table->string('profile_img')->nullable();

            // Address fields
            $table->text('address_line_1')->nullable();
            $table->text('address_line_2')->nullable();
            $table->string('state')->nullable();
            $table->string('postal_code')->nullable();

            $table->string('phone')->nullable();
            $table->boolean('status')->default(false);
            $table->string('password');
            $table->rememberToken();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('_token')->nullable();
            $table->timestamp('_token_expiry')->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('hotel_id')->references('id')->on('hotels')->onDelete('cascade');
        });

        /*
         * Database Schema 
         * Bookings Management
         * 
         */
        Schema::create('bookings', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('hotel_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->boolean('status')->default(false);
            $table->string('email');
            $table->string('cnic');
            $table->string('ntn')->nullable();
            $table->string('phone')->nullable();

            //Checkin Details
            $table->string('checkin_at')->nullable();
            $table->string('checkout_at')->nullable();
            $table->integer('adults')->nullable();
            $table->integer('children')->nullable();

            //Payment Details
            $table->double('total')->default(0);
            $table->double('advance')->default(0);
            $table->string('notes')->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('hotel_id')->references('id')->on('hotels')->onDelete('cascade');
        });

        /*
         * Database Schema 
         * Hotel Images
         * 
         */
        Schema::create('images', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('hotel_id');
            $table->string('image');

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('hotel_id')->references('id')->on('hotels')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('images');
        Schema::dropIfExists('bookings');
        Schema::dropIfExists('users');
        Schema::dropIfExists('hotels');
    }

}
