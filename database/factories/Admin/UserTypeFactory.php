<?php

namespace Database\Factories\Admin;

use App\Models\Admin\UserType;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserTypeFactory extends Factory
{
    protected $model = UserType::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
        ];
    }
}
