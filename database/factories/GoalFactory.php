<?php

namespace Database\Factories;

use App\Models\Goal;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class GoalFactory extends Factory
{
    protected $model = Goal::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $timestamp = Carbon::now()->toJSON();

        return [
            'name'        => 'Excel at work / job',
            'description' => '',
            'created_at'  => $timestamp,
            'updated_at'  => $timestamp,
        ];
    }
}
