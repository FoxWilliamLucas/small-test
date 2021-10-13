<?php

namespace App\Repositories\Eloquent;

use App\Models\Client;
use App\Helpers\Converter;
use Illuminate\Support\Facades\Redis;
use App\Repositories\Eloquent\BaseRepo;
use App\Repositories\Interfaces\IClientRepo;


class ClientRepo extends BaseRepo implements IClientRepo{


    /**
     * @return mixed
     */
    public function model(){
        return Client::class;
    }

    public function create(array $data){
        $customer = parent::create($data);
        Redis::set('clients/'.$customer->id.'/location', json_encode([$customer->latitude, $customer->longitude]));
        return $customer;
    }

    /**
     * @param mixed $model
     * @param mixed $data
     * 
     * @return mixed
     */
    public function createRelatedUsers($model, $data){
        $model->users()->createMany(Converter::camel($data));
    }
}