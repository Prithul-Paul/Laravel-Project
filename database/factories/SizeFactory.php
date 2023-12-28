<?php

namespace Database\Factories;

use App\Models\Admin\Size;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class SizeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Size::class;
    public function definition(): array
    {
        return [
            'size'=>fake()->name(),
            'status'=>1
        ];
    }
}
