<?php

namespace App\Models;

use CodeIgniter\Model;

class SubProduct extends Model
{
    protected $table = 'sub_products';

    protected $allowedFields = ['product_id', 'name', 'slug', 'price', 'discount', 'description'];
}
