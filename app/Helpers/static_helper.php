<?php

if (!function_exists('shop_information')) {
    function shop_information() {
        return [
            'shop_name'  => 'Dewi Sri Salon & Spa',
            'shop_owner' => 'Riza Rachmatin',
            'shop_city'  => 'Gianyar',
        ];
    }
}

if (!function_exists('payment_statuses')) {
    function payment_statuses() {
        return [
            \App\Models\Payment::STATUS_PAID_OFF        => 'sudah lunas',
            \App\Models\Payment::STATUS_DOWN_PAYMENT    => 'dp',
            \App\Models\Payment::STATUS_WAITING_PAYMENT => 'menunggu pembayaran',
        ];
    }
}