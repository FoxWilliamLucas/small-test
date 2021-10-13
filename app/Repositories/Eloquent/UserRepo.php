<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Eloquent\BaseRepo;
use App\Repositories\Interfaces\IUserRepo;


class UserRepo extends BaseRepo implements IUserRepo{


    /**
     * @return mixed
     */
    public function model(){
        return User::class;
    }
}