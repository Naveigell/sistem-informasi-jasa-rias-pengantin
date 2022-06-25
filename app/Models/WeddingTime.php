<?php

namespace App\Models;

use CodeIgniter\Model;

class WeddingTime extends Model
{
    protected $table = 'wedding_times';

    protected $allowedFields = ['wedding_time'];
}
