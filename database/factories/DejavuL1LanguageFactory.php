<?php

namespace Database\Factories;

use App\Models\DejavuL1Language;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class DejavuL1LanguageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DejavuL1Language::class;

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
            'interface_language_support' => 1,
            'created_at' => $timestamp,
            'updated_at' => $timestamp,
        ];
    }
}
