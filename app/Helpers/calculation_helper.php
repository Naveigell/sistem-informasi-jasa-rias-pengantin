<?php

if (!function_exists('calculate_discount')) {
    function calculate_discount($price, $discount) {
        return 100 - abs(($discount / $price) * 100);
    }
}