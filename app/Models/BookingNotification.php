<?php

namespace App\Models;

use CodeIgniter\Model;

class BookingNotification extends Model
{
    protected $table = 'booking_notifications';

    protected $allowedFields = ['booking_id', 'is_read'];
}
