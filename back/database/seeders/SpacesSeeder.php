<?php

namespace Database\Seeders;

use App\Models\Space;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpacesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Space::create([
            'name' => 'Salón Principal',
            'description' => 'Un amplio salón para eventos.',
            'capacity' => 100,
            'type_id' => 1,
            'photos' => json_encode(['url1.jpg', 'url2.jpg']),
        ]);

        Space::create([
            'name' => 'Teatro Colon',
            'description' => 'Auditorio del teatro colon',
            'capacity' => 500,
            'type_id' => 2,
            'photos' => json_encode(['url1.jpg', 'url2.jpg']),
        ]);

        Space::create([
            'name' => 'Orbita coworking',
            'description' => 'Sala de reuniones',
            'capacity' => 30,
            'type_id' => 3,
            'photos' => json_encode(['url1.jpg', 'url2.jpg']),
        ]);
    }
}
