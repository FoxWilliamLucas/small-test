<?php
namespace App\Http\ValidationRules;



class UserRules {





    public static function rules(){
        return [
            // 'client_id'             => 'required|exists:clients,id',
            'firstName'            => 'required|alpha',
            'lastName'             => 'required|alpha',
            'email'                 => 'required|regex:/(.+)@(.+)\.(.+)/i|unique:users,email',
            'password'              => 'required|string|min:6',
            'passwordConfirmation'  => 'same:password',
            'phone'                 => 'regex:/^(\d{3}-\d{3}-\d{4})$/',
            // 'profile_uri'           => ,
            // 'status'                => ,
            // 'deleted_at'            => ,
        ];
    }
} 