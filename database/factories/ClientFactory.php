<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Client::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'client_name'   => $this->faker->name,
            'address1'      => $this->faker->address,
            'address2'      => "#".$this->faker->buildingNumber,
            'city'          => $this->faker->city,
            'state'         => $this->faker->state,
            'country'       => $this->faker->country,
            'latitude'      => $this->faker->latitude($min = -90, $max = 90),
            'longitude'     => $this->faker->longitude($min = -180, $max = 180),
            'phone_no1'     => (string)$this->faker->numberBetween($min = 100, $max = 999)."-".
                               (string)$this->faker->numberBetween($min = 100, $max = 999)."-".
                               (string)$this->faker->numberBetween($min = 1000, $max = 9999),
            // 'phone_no2'  => $this->faker->,
            'zip'           => $this->faker->postcode,
            'start_validity'=> Carbon::now()->format('Y-m-d'),
            'end_validity'  => Carbon::now()->addDays(15)->format('Y-m-d'),
            'status'        => $this->faker->randomElement(['Active', 'Inactive']),
        ];
    }
}
