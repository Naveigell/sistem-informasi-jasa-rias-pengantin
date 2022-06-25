<?php

namespace App\Database\Seeds;

use App\Models\Product;
use CodeIgniter\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = [
            [
                'name' => 'Payas Agung',
                'slug' => 'payas-agung',
            ],
            [
                'name' => 'Payas Idih',
                'slug' => 'payas-idih',
            ],
            [
                'name' => 'Resepsi',
                'slug' => 'resepsi',
            ],
            [
                'name' => 'Prewedding',
                'slug' => 'prewedding',
            ],
        ];

        (new Product())->insertBatch($products);
    }
}
