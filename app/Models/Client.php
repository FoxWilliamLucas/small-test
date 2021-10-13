<?php

namespace App\Models;

use App\Models\BaseModel as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_name',
        'address1',
        'address2',
        'city',
        'state',
        'country',
        'latitude',
        'longitude',
        'phone_no1',
        'phone_no2',
        'zip',
        'start_validity',
        'end_validity',
        'status',
    ];


    public function getAllUsersAttribute(){
        return $this->users->where('client_id', $this->id)->count();
    }
    public function getActiveUsersAttribute(){
        return $this->users->where('client_id', $this->id)->where('status', 'Active')->count();
    }
    public function getInactiveUsersAttribute(){
        return $this->users->where('client_id', $this->id)->where('status', 'Inactive')->count();
    }

    public function users(){
        return $this->hasMany(User::class);
    }
}