<?php

namespace Database\Factories;

use App\Models\MemoryLevel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class MemoryLevelFactory extends Factory
{
    protected $model = MemoryLevel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $timestamp = Carbon::now()->toJSON();

        return [
            'name'       => 'Sensory memory',
            'description' => 'test',
            'created_at' => $timestamp,
            'updated_at' => $timestamp,
        ];
    }
}
