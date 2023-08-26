<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Cliente;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cliente>
 */
class ClienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cpf'=>$this->faker->randomNumber(3) .".".$this->faker->randomNumber(3) .".".$this->faker->randomNumber(3) ."-" . $this->faker->randomNumber(2),
            'nome'=>$this->faker->name,
            'nascimento'=>$this->faker->dateTimeBetween($startDate = '-100 years', $endDate = '-18 years')->format('Y-m-d'),
            'sexo'=>$this->faker->randomElement(['M', 'F']),
            'endereco'=>$this->faker->address,
            'estado'=>$this->faker->randomElement(['SP']),
            'cidade'=>$this->faker->randomElement(['Piracicaba', 'Campinas', 'São Paulo'])
        ];
    }
}
