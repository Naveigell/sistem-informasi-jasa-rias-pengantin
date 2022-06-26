<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Booking;
use App\Models\Payment;

class BookingController extends BaseController
{
    public function index()
    {
        $bookings = (new Booking())->joinWeddingTime()->joinProduct()->joinSubProduct()->findAll();

        return view('admin/pages/booking/index', compact('bookings'));
    }

    public function show($bookingId)
    {
        $booking = (new Booking())->joinWeddingTime()->joinProduct()->joinSubProduct()->first();
        $payment = (new Payment())->where('booking_id', $bookingId)->first();

        return view('admin/pages/booking/form', compact('booking', 'payment'));
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

        return redirect()->route('admin.bookings.index')->withInput()->with('success', 'Pembayaran berhasil diubah');
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
