<?php

namespace App\Models;

use CodeIgniter\Model;

class SubProductVoucher extends Model
{
    protected $table = 'sub_product_vouchers';

    protected $allowedFields = ['product_id', 'sub_product_id', 'code', 'amount'];
}
