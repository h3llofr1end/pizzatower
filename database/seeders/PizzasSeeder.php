<?php

namespace Database\Seeders;

use App\Models\Pizza;
use Illuminate\Database\Seeder;

class PizzasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pizzas = [
            [
                'name' => 'English breakfast',
                'description' => 'Sauce, Bacon, Cheese, Olives, Mushrooms, Green onions, Egg',
                'price_usd' => 3.80,
                'image' => '/img/pizzas/1.jpg'
            ],
            [
                'name' => 'Venice',
                'description' => 'Sauce, Chicken fillet, Ham, Cheese, Zucchini',
                'price_usd' => 3.50,
                'image' => '/img/pizzas/2.jpg'
            ],
            [
                'name' => 'Hawaiian',
                'description' => 'Sauce, Chicken fillet, Pineapple, Cheese',
                'price_usd' => 3.90,
                'image' => '/img/pizzas/3.jpg'
            ],
            [
                'name' => 'Classic',
                'description' => 'Sauce, Chicken fillet, Cheese, Mushrooms',
                'price_usd' => 3.40,
                'image' => '/img/pizzas/4.jpg'
            ],
            [
                'name' => 'Margarita',
                'description' => 'Sauce, Tomato, Cheese',
                'price_usd' => 3.00,
                'image' => '/img/pizzas/5.jpg'
            ],
            [
                'name' => 'Milano',
                'description' => 'Sauce, Salami, Ham, Cheese, Olives, Mushrooms, Bulgarian pepper',
                'price_usd' => 4.00,
                'image' => '/img/pizzas/6.jpg'
            ],
            [
                'name' => 'Meat',
                'description' => 'Sauce, Chicken fillet, Salami, Hunting sausages, Ham, Greens, Cheese, Mushrooms',
                'price_usd' => 4.50,
                'image' => '/img/pizzas/7.jpg'
            ],
            [
                'name' => 'Vegetable',
                'description' => 'Sauce, Tomato, Greens, Cheese, Olives, Mushrooms, Zucchini',
                'price_usd' => 3.50,
                'image' => '/img/pizzas/8.jpg'
            ],
            [
                'name' => 'Spicy',
                'description' => 'Sauce, Salami, Chili pepper, Cheese, Mushrooms',
                'price_usd' => 3.50,
                'image' => '/img/pizzas/9.jpg'
            ]
        ];

        foreach($pizzas as $pizza) {
            Pizza::create($pizza);
        }
    }
}
