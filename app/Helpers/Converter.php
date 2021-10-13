<?php
namespace App\Helpers;

use Illuminate\Support\Str;

class Converter
{

    /**
     * @param mixed $input
     * 
     * @return string
     */
    public static function fromSnakeToCamel($input){
        return lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $input))));
    }



    public static function camel($data){
        $userData = [];
        foreach($data as $key => $value){
            if(is_array($value)){
                $userData[$key] =self::camel($value);
            } else{
                $userData[Str::snake($key)] = $value;
            }
        }
        return $userData;
    }
}