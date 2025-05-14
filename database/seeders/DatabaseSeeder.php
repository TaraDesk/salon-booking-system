<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(20)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@mirra.com',
            'password' => 'admin123',
            'is_admin' => true
        ]);

        $services = [
            [
                'name' => 'Classic Manicure',
                'time' => 30,
                'price' => 200000,
                'image_url' => 'services/classic_manicure.jpg'
            ],
            [
                'name' => 'Spa Pedicure',
                'time' => 45,
                'price' => 300000,
                'image_url' => 'services/spa_pedicure.jpg'
            ],
            [
                'name' => 'Haircut and Style',
                'time' => 60,
                'price' => 500000,
                'image_url' => 'services/haircut_and_style.jpg'
            ],
            [
                'name' => 'Hair Coloring',
                'time' => 120,
                'price' => 800000,
                'image_url' => 'services/hair_coloring.jpg'
            ],
            [
                'name' => 'Deep Conditioning Treatment',
                'time' => 30,
                'price' => 250000,
                'image_url' => 'services/deep_conditioning.jpg'
            ],
            [
                'name' => 'Facial Treatment',
                'time' => 60,
                'price' => 450000,
                'image_url' => 'services/facial_treatment.jpg'
            ],
            [
                'name' => 'Hair Perming',
                'time' => 120,
                'price' => 900000,
                'image_url' => 'services/hair_perming.jpg'
            ],
            [
                'name' => 'Hair Straightening',
                'time' => 150,
                'price' => 1000000,
                'image_url' => 'services/hair_straightening.jpg'
            ],
            [
                'name' => 'Scalp Treatment',
                'time' => 45,
                'price' => 350000,
                'image_url' => 'services/scalp_treatment.jpg'
            ],
            [
                'name' => 'Nail Art Design',
                'time' => 60,
                'price' => 400000,
                'image_url' => 'services/nail_art.jpg'
            ],
        ];

        foreach ($services as $service) {
            Service::factory()->create($service);
        }
    }
}
