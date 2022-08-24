<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\SubProduct;
use App\Models\User;

class DashboardController extends BaseController
{
    public function index()
    {
        $chartDatas = [];
        $dates      = range(date('m'), max(1, date('m') - 5));

        $payments = (new Payment())->whereIn('MONTH(created_at)', $dates)->where('status', Payment::STATUS_PAID_OFF)->findAll();

        foreach ($dates as $date) {
            $chartDatas[date('F', mktime(0, 0, 0, $date, 1))] = 0;
        }

        foreach ($payments as $payment) {
            $booking    = (new Booking())->where('id', $payment['booking_id'])->first();
            $subProduct = (new SubProduct())->where('id', $booking['sub_product_id'])->first();

            $month = date('F', strtotime($payment['created_at']));
            $chartDatas[$month] += $subProduct['discount'] ?? $subProduct['price'];
        }

        $chartDatas = array_reverse($chartDatas);

        $totalBooking  = (new Booking())->countAllResults();
        $totalServices = (new SubProduct())->countAllResults();
        $totalUsers    = (new User())->countAllResults();

        return view('admin/pages/dashboard/index', compact('chartDatas', 'totalBooking', 'totalServices', 'totalUsers'));
    }
}
