<?php
namespace App\Http\ValidationRules;



class ClientRules {





    public static function registerRules(){
        return [
            'clientName'            =>  'required|regex:/(^[A-Za-z\s]+$)/',
            'address1'              =>  'required|regex:/(^[-0-9A-Za-z.,\s]+$)/',
            'address2'              =>  'required|regex:/(^[#0-9]+$)/',
            'city'                  =>  'required|regex:/(^[A-Za-z\s]+$)/',
            'state'                 =>  'required|regex:/(^[A-Za-z\s]+$)/',
            'country'               =>  'required|regex:/(^[A-Za-z\s]+$)/',
            'latitude'              =>  'required|numeric',
            'longitude'             =>  'required|numeric',
            'phoneNo1'              =>  'required|regex:/^(\d{3}-\d{3}-\d{4})$/',
            'phoneNo2'              =>  'regex:/^(\d{3}-\d{3}-\d{4})$/',
            'zip'                   =>  'required|numeric',
            'users'                         => 'required|array',
            'users.*.firstName'             => 'required|alpha',
            'users.*.lastName'              => 'required|alpha',
            'users.*.email'                 => 'required|regex:/(.+)@(.+)\.(.+)/i|unique:users,email',
            'users.*.password'                      => 'required|string|min:6',
            'users.*.passwordConfirmation'          => 'same:users.*.password',
            'users.*.phone'                 => 'regex:/^(\d{3}-\d{3}-\d{4})$/',
            // 'status'        =>  '',
            // 'deleted_at'    =>  '',
        ];
    }
} 