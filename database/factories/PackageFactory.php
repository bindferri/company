<?php

namespace Database\Factories;

use App\Models\Package;
use Illuminate\Database\Eloquent\Factories\Factory;

class PackageFactory extends Factory
{
    protected $model = Package::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'limit' => $this->faker->numberBetween(3, 8),
            'uuid' => $this->faker->uuid,
        ];
    }
}
