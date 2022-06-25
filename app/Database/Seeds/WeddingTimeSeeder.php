<?php

namespace App\Database\Seeds;

use App\Models\WeddingTime;
use CodeIgniter\Database\Seeder;

class WeddingTimeSeeder extends Seeder
{
    public function run()
    {
        $times = [
            [
                "wedding_time" => "01:00",
            ],
            [
                "wedding_time" => "03:30",
            ],
            [
                "wedding_time" => "05:30",
            ]
        ];

        (new WeddingTime())->insertBatch($times);
    }
}
