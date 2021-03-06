<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            // 'id'             => $this->id,
            // 'client_id'      => $this->client_id,
            'firstName'         => $this->first_name,
            'lastName'          => $this->last_name,
            'email'             => $this->email,
            'password'          => $this->password,
            'phone'             => $this->phone,
            'profileUri'        => $this->profile_uri,
            'lastPasswordReset' => $this->last_password_reset,
            'status'            => $this->status,
            'createdAt'         => $this->created_at,
            'updatedAt'         => $this->updated_at,
        ];
    }
}
