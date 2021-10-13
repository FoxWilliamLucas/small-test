<?php

namespace App\Repositories\Interfaces;

use App\Repositories\Interfaces\IRepo;



interface IClientRepo extends IRepo{

    /**
     * @param mixed $model
     * @param mixed $data
     * 
     * @return mixed
     */
    public function createRelatedUsers($model, $data);

}