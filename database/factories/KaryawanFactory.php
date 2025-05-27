<?php

namespace Database\Factories;

use App\Models\Karyawan;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Karyawan>
 */
class KaryawanFactory extends Factory
{
    protected $model = Karyawan::class;

    public function definition(): array
    {
        $jabatan = $this->faker->randomElement(['head', 'manager', 'staff']);

        return [
            'nik' => $this->faker->unique()->numerify('#####'),
            'email' => $this->faker->unique()->userName() . '@gmail.com',
            'nama_lengkap' => $this->faker->name(),
            'jabatan' => $jabatan,
            'no_hp' => $this->faker->phoneNumber(),
            'password' => Hash::make('12345'),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
