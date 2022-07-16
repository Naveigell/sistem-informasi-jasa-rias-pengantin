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
                    "discount" => "30000",
                ],
                [
                    "name"  => "Exclusive",
                    "slug"  => "exclusive",
                    "price" => "1000000",
                    "discount" => "400000",
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
                    "discount" => "400000",
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

        foreach (array_keys($subProducts) as $slug) {
            $product = (new Product())->where('slug', $slug)->first();

            foreach ($subProducts[$slug] as $subProduct) {

                (new SubProduct())->insert(array_merge($subProduct, [
                    "product_id"  => $product['id'],
                    "description" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus quis ex est. Nam finibus elit eu ultricies fringilla. Fusce dictum magna lacinia enim consectetur, nec faucibus dui interdum. Aenean vel odio congue, scelerisque enim tincidunt, aliquam ex. Sed suscipit viverra metus, id volutpat erat aliquet a. Curabitur nec hendrerit ex. Interdum et malesuada fames ac ante ipsum primis in faucibus. Quisque bibendum in turpis vitae lobortis. Curabitur imperdiet nulla non tortor posuere interdum. Mauris tincidunt, ex sit amet efficitur ultrices, velit libero tincidunt tortor, quis laoreet libero turpis a sapien. Integer vitae auctor elit.",
                ]));
            }
        }
    }
}
