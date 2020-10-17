<?php

namespace Database\Factories;

use App\Models\Interest;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class InterestFactory extends Factory
{
    protected $model = Interest::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $timestamp = Carbon::now()->toJSON();

        return [
            'name'        => 'General',
            'description' => '',
            'created_at'  => $timestamp,
            'updated_at'  => $timestamp,
        ];
    }
}
