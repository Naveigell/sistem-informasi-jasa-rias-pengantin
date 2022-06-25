<?php

if (!function_exists('format_currency')) {
    function format_currency($price, $prefix = 'Rp. ', $decimal = 0, $decimal_separator = ',' , $thousands_separator = '.'): string {
        return ($prefix ?? '') . number_format($price, $decimal, $decimal_separator, $thousands_separator);
    }
}