<?php

namespace App\Repositories;


use App\Profile;

class ProfileRepository extends BaseRepository
{
    

    /**
     * ProfileRepository constructor.
     * @param Profile $profile
     */
    public function __construct(Profile $profile)
    {
       $this->model = $profile;
    }

}