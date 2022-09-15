<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Booking;
use App\Models\BookingNotification;
use App\Models\Payment;
use App\Models\SubProductVoucher;

class BookingController extends BaseController
{
    public function index()
    {
        $bookings = (new Booking())->select('wedding_times.*, products.*, sub_products.*, bookings.id AS booking_id')->orderBy('booking_id', 'DESC')->joinWeddingTime()->joinProduct()->joinSubProduct()->findAll();

        return view('admin/pages/booking/index', compact('bookings'));
    }

    public function show($bookingId)
    {
        $booking = (new Booking())->where('bookings.id', $bookingId)->select('wedding_times.*, products.*, sub_products.*, bookings.id AS booking_id')->orderBy('booking_id')->joinWeddingTime()->joinProduct()->joinSubProduct()->first();
        $voucher = $booking['voucher_id'] ? (new SubProductVoucher())->where('id', $booking['voucher_id'])->first() : null;
        $payment = (new Payment())->where('booking_id', $bookingId)->first();

        (new BookingNotification())->builder()->where('booking_id', $bookingId)->update([
            "is_read" => 1,
        ]);

        return view('admin/pages/booking/form', compact('booking', 'payment', 'voucher'));
    }

    public function update($bookingId)
    {
        $validator = $this->validator();

        if (!$validator->run($this->request->getVar())) {
            return redirect()->back()->withInput()->with('errors', $validator->getErrors());
        }

        (new Booking())->update($bookingId, [
            "payment_status" => $this->request->getVar('status'),
        ]);

        $payment = (new Payment())->where('booking_id', $bookingId)->first();

        (new Payment())->update($payment['id'], $this->request->getVar());
        (new Booking())->update($bookingId, ["payment_status" => $this->request->getVar('status')]);

        return redirect()->route('admin.bookings.index')->withInput()->with('success', 'Pembayaran berhasil diubah');
    }

    public function finish($bookingId)
    {
        (new Booking())->builder()->where('id', $bookingId)->update(["is_finish" => 1]);

        return redirect()->route('admin.bookings.index')->with('success', 'Berhasil menyelesaikan pesanan');
    }

    private function validator()
    {
        $validator = \Config\Services::validation();
        $validator->setRules([
            "status" => [
                "rules" => "required",
            ]
        ]);

        return $validator;
    }
}
