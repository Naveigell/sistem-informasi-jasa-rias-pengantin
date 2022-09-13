<?php

namespace App\Models;

use CodeIgniter\Model;

class Booking extends Model
{
    protected $table = 'bookings';

    protected $allowedFields = [
        'user_id', 'product_id', 'sub_product_id', 'name', 'address', 'phone', 'identity_card',
        'wedding_date', 'wedding_time_id', 'pre_wedding_date', 'payment_status', 'is_expired', 'expired_at',
        'is_finish', 'voucher_id',
    ];

    public const STATUS_WAITING_PAYMENT = 'waiting_payment';
    public const STATUS_DOWN_PAYMENT    = 'down_payment';
    public const STATUS_PAID_OFF        = 'paid_off';

    public function joinWeddingTime()
    {
        return $this->join('wedding_times', 'wedding_times.id = bookings.wedding_time_id');
    }

    public function joinProduct()
    {
        return $this->join('products', 'products.id = bookings.product_id');
    }

    public function joinSubProduct()
    {
        return $this->join('sub_products', 'sub_products.id = bookings.sub_product_id')
                    ->select('bookings.*, wedding_times.*, products.*, sub_products.*, products.name AS product_name, sub_products.name AS sub_product_name, bookings.name AS member_name');
    }
}
