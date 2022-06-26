<?php

namespace App\Models;

use CodeIgniter\Model;

class Payment extends Model
{
    protected $table = 'payments';

    protected $allowedFields = ['booking_id', 'proof', 'sender_bank', 'sender_account_number', 'sender_name', 'merchant_bank', 'status'];

    public const STATUS_WAITING_PAYMENT = 'waiting_payment';
    public const STATUS_DOWN_PAYMENT    = 'down_payment';
    public const STATUS_PAID_OFF        = 'paid_off';
}
