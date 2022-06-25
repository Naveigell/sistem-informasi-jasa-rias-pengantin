<?php

namespace App\Database\Seeds;

use App\Models\Product;
use App\Models\SubProduct;
use CodeIgniter\Database\Seeder;

class SubProductSeeder extends Seeder
{
    public function run()
    {
        $subProducts = [
            "payas-agung" => [
                [
                    "name"  => "Reguler",
                    "slug"  => "reguler",
                    "price" => "4000000",
                ],
                [
                    "name"  => "Exclusive",
                    "slug"  => "exclusive",
                    "price" => "7000000",
                ],
            ],
            "payas-idih" => [
                [
                    "name"  => "Reguler",
                    "slug"  => "reguler",
                    "price" => "500000",
                ],
                [
                    "name"  => "Exclusive",
                    "slug"  => "exclusive",
                    "price" => "1000000",
                ],
            ],
            "resepsi" => [
                [
                    "name"  => "Tipe 1",
                    "slug"  => "tipe-1",
                    "price" => "1000000",
                ],
                [
                    "name"  => "Tipe 2",
                    "slug"  => "tipe-2",
                    "price" => "2000000",
                ],
            ],
            "prewedding" => [
                [
                    "name"  => "Tema 1",
                    "slug"  => "tema-1",
                    "price" => "1000000",
                ],
                [
                    "name"  => "Tema 2",
                    "slug"  => "tema-2",
                    "price" => "1500000",
                ],
                [
                    "name"  => "Tema 3",
                    "slug"  => "tema-3",
                    "price" => "2200000",
                ],
            ],
        ];

        foreach ($subProducts as $productSlug => $subProduct) {
            $product = (new Product())->where('slug', $productSlug)->first();

            (new SubProduct())->insert(array_merge($subProducts, [
                "product_id" => $product['id'],
            ]));
        }
    }
}
