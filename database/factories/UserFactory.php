<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $email = $this->faker->unique()->safeEmail();
        $gender = $this->getGender();
        return [
            'name' => $this->faker->name($gender),
            'email' => $email,
            'email_verified_at' => now(),
            'password' => bcrypt($email), // email
            'remember_token' => Str::random(10),
            'status' => $this->getStatus(),
            'gender' => $gender,
            'profile' => $this->getProfile(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }

    private function getStatus() : string {
        $statuses = ['actived','inactived','pre_registred'];
        shuffle($statuses);
        return $statuses[0];
    }

    private function getGender() : string {
        $genders = ['male','female'];
        shuffle($genders);
        return $genders[0];
    }

    private function getProfile() : string {
        $profiles = ['administrator','user'];
        shuffle($profiles);
        return $profiles[0];
    }
}
