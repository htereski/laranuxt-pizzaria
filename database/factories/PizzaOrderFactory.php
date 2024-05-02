<?php

namespace Database\Factories;

use App\Models\Kind;
use App\Models\Pizza;
use App\Models\Size;
use App\Models\User;
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
        $users = User::pluck('id')->toArray();

        $randomPizzaId = $this->faker->randomElement($pizzas);
        $randomSizeId = $this->faker->randomElement($sizes);
        $randomUserId = $this->faker->randomElement($users);

        $pizzaKind = Pizza::find($randomPizzaId)->kind_id;
        $kindMultiplier = Kind::find($pizzaKind)->multiplier;
        $sizeValue = Size::find($randomSizeId)->value;

        return [
            'pizza_id' => $randomPizzaId,
            'size_id' => $randomSizeId,
            'user_id' => $randomUserId,
            'value' => $kindMultiplier * $sizeValue
        ];
    }
}
