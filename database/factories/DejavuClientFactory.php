<?php

namespace Database\Factories;

use App\Models\DejavuClient;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class DejavuClientFactory extends Factory
{
    protected $model = DejavuClient::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $timestamp = Carbon::now()->toJSON();

        return [
            'uuid' => 'c0953330-0da5-11eb-b6f1-bfc603d97543',
            'client_name' => 'Dejavu Users',
            'enabled' => 1,
            'created_at' => $timestamp,
            'updated_at' => $timestamp,
        ];
    }
}
