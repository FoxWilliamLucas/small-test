<?php

namespace Tests\Feature;

use App\Helpers\ResponseStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AccountTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testIndexReturnsDataValidFormat()
    {
        // $response = $this->json('get', 'api/v1/account');
        // dd($response);
        $this->json('get', 'api/v1/account')
        ->assertStatus(ResponseStatus::SUCCESS)
        ->assertJsonStructure([
            'content' => [
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'address1',
                        'address2',
                        'city',
                        'state',
                        'country',
                        'zipCode',
                        'latitude',
                        'longitude',
                        'phoneNo1',
                        'phoneNo2',
                        'totalUser' => ['all', 'active', 'inactive'],
                        'startValidity',
                        'endValidity',
                        'status',
                        'createdAt',
                        'updatedAt',
                    ]
                ]
            ]
        ]);
    }



    public function testClientIsCreatedSuccessfully() {

        $accountPayload = [ 
            'clientName'   => "testName",
            'address1'      => $this->faker->address,
            'address2'      => "#".$this->faker->buildingNumber,
            'city'          => $this->faker->city,
            'state'         => $this->faker->state,
            'country'       => $this->faker->country,
            'latitude'      => $this->faker->latitude($min = -90, $max = 90),
            'longitude'     => $this->faker->longitude($min = -180, $max = 180),
            'phoneNo1'     => (string)$this->faker->numberBetween($min = 100, $max = 999)."-".
                               (string)$this->faker->numberBetween($min = 100, $max = 999)."-".
                               (string)$this->faker->numberBetween($min = 1000, $max = 9999),
            'zip'           => 01010,
            'startValidity'=> \Carbon\Carbon::now()->format('Y-m-d'),
            'endValidity'  => \Carbon\Carbon::now()->addDays(15)->format('Y-m-d'),
            'status'        => 'Active',
        ];

        $users = [
            'users' => [
                0 => [
                    'firstName'             => $this->faker->firstName,
                    'lastName'              => $this->faker->lastName,
                    'email'                  => $this->faker->email,
                    'password'               => "123456",
                    'passwordConfirmation'  => "123456",
                ]
            ]
        ];

        $form = array_merge($accountPayload, $users);
        $s = $this->json('post', 'api/v1/register', $form)
             ->assertStatus(ResponseStatus::SUCCESS)
             ->assertJsonStructure([
                     'content' => [
                        'id',
                        'name',
                        'address1',
                        'address2',
                        'city',
                        'state',
                        'country',
                        'zipCode',
                        'latitude',
                        'longitude',
                        'phoneNo1',
                        'phoneNo2',
                        'totalUser' => ['all', 'active', 'inactive'],
                        'startValidity',
                        'endValidity',
                        'status',
                        'createdAt',
                        'updatedAt',
                     ]
            ]);
    }
}
