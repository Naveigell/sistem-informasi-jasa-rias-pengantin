<?php

if (!function_exists('render_payment_status')) {
    function render_payment_status ($status) {
        $text = ucwords(str_replace('_', ' ', $status));

        if ($status === \App\Models\Payment::STATUS_PAID_OFF) {
            return '<span class="badge badge-success">' . payment_statuses()[$status] . '</span>';
        } elseif ($status === \App\Models\Payment::STATUS_DOWN_PAYMENT) {
            return '<span class="badge badge-primary">' . payment_statuses()[$status] . '</span>';
        } else {
            return '<span class="badge badge-danger">' . payment_statuses()[$status] . '</span>';
        }
    }
}
