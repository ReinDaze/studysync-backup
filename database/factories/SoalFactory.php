<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Soal;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Soal>
 */
class SoalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Soal::class;

    public function definition()
    {
        return [
            'soal' => $this->faker->sentence,
            'jawaban_1' => $this->faker->word,
            'gaya_belajar_1' => 'Visual',
            'nilai_jawaban_1' => $this->faker->numberBetween(1, 10),
            'jawaban_2' => $this->faker->word,
            'gaya_belajar_2' => 'Auditori',
            'nilai_jawaban_2' => $this->faker->numberBetween(1, 10),
            'jawaban_3' => $this->faker->word,
            'gaya_belajar_3' => 'Kinestetik',
            'nilai_jawaban_3' => $this->faker->numberBetween(1, 10),
        ];
    }
}
