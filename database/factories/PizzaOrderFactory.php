<?php

namespace Database\Factories;

use App\Models\Kind;
use App\Models\Pizza;
use App\Models\Size;
use Database\Seeders\PizzaSeeder;
use Database\Seeders\SizeSeeder;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PizzaOrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $pizzas = Pizza::pluck('id')->toArray();
        $sizes = Size::pluck('id')->toArray();

        $randomPizzaId = $this->faker->randomElement($pizzas);
        $randomSizeId = $this->faker->randomElement($sizes);

        $pizzaKind = Pizza::find($randomPizzaId)->kind_id;
        $kindMultiplier = Kind::find($pizzaKind)->multiplier;
        $sizeValue = Size::find($randomSizeId)->value;

        return [
            'pizza_id' => $randomPizzaId,
            'size_id' => $randomSizeId,
            'value' => $kindMultiplier * $sizeValue
        ];
    }
}
