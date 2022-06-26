<?php

if (!function_exists('render_payment_status')) {
    function render_payment_status ($status) {
        $text = ucwords(str_replace('_', ' ', $status));

        if ($status === \App\Models\Payment::STATUS_PAID_OFF) {
            return '<span class="badge badge-success">' . $text . '</span>';
        } elseif ($status === \App\Models\Payment::STATUS_DOWN_PAYMENT) {
            return '<span class="badge badge-primary">' . $text . '</span>';
        } else {
            return '<span class="badge badge-danger">' . $text . '</span>';
        }
    }
}
