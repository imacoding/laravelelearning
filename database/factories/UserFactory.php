<?php

namespace Database\Factories;

use App\Models\Auth\User;
use Faker\Generator;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Webpatser\Uuid\Uuid;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'uuid' => Uuid::generate(4)->string,
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->safeEmail,
            'password' => 'secret',
            'password_changed_at' => null,
            'remember_token' => Str::random(10),
            'confirmation_code' => md5(uniqid(mt_rand(), true)),
            'active' => 1,
            'confirmed' => 1,
        ];
    }

    public function active()
    {
        return $this->state(function (array $attributes) {
            return [
                'active' => 1,
            ];
        });
    }

    public function inactive()
    {
        return $this->state(function (array $attributes) {
            return [
                'active' => 0,
            ];
        });
    }

    public function confirmed()
    {
        return $this->state(function (array $attributes) {
            return [
                'confirmed' => 1,
            ];
        });
    }

    public function unconfirmed()
    {
        return $this->state(function (array $attributes) {
            return [
                'confirmed' => 0,
            ];
        });
    }

    public function softDeleted()
    {
        return $this->state(function (array $attributes) {
            return [
                'deleted_at' => \Illuminate\Support\Carbon::now(),
            ];
        });
    }
}
