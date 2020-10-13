<?php

namespace Database\Factories;

use App\Models\DejavuL2Language;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class DejavuL2LanguageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DejavuL2Language::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $timestamp = Carbon::now()->toJSON();
        return [
            'name' => 'English',
            'short_name' => 'EN',
            'created_at' => $timestamp,
            'updated_at' => $timestamp,
        ];
    }
}
