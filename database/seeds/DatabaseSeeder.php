<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder {

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {

        //Add super admin user 
        DB::table('users')->insert([
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'username' => 'super_admin',
            'email' => 'sheikhabdulrehman8@gmail.com',
            'cnic' => '35202-34568529-9',
            'ntn' => 'ABC00753691',
            'address_line_1' => 'Lahore, Punjab Pakistan.',
            'phone' => '+923111111111',
            'status' => 1,
            'email_verified_at' => date('Y-m-d H:i:s'),
            'password' => Hash::make('Admin@123'),
            '_token' => null,
            '_token_expiry' => null,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        //Add dummy hotel
        DB::table('hotels')->insert([
            'name' => 'Pearl Continental (PC)',
            'status' => true,
            'email' => 'sheikhabdulrehman8@gmail.com',
            'UAN' => '03464357146',
            'contact_first_name' => 'Abdulrehman',
            'contact_last_name' => 'Sheikh',
            'contact_number_1' => '03464357146',
            'contact_number_2' => '03464357146',
            'contact_email' => 'sheikhabdulrehman8@gmail.com',
            'address_line_1' => 'Mian Mir',
            'address_line_2' => 'Upper Mall Road',
            'city' => 'Lahore',
            'state' => 'Punjab',
            'postal_code' => '54000',
            'country' => 'Pakistan',
            'website_uri' => 'https://facebook.com/computersworm',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }

}