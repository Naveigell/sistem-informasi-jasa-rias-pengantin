<?php

namespace App\Controllers\Member;

use App\Controllers\BaseController;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\Product;
use App\Models\SubProduct;
use App\Models\WeddingTime;

class PaymentController extends BaseController
{
    public function index()
    {
        $bookings = (new Booking())->where('user_id', session()->get('user')->id)->findAll();

        return view('member/pages/payment/index', compact('bookings'));
    }

    public function edit($productId, $subProductId, $bookingId)
    {
        $booking     = (new Booking())->where('product_id', $productId)->where('sub_product_id', $subProductId)->where('user_id', session()->get('user')->id)->first();
        $product     = (new Product())->where('id', $productId)->first();
        $subProduct  = (new SubProduct())->where('id', $subProductId)->where('product_id', $productId)->first();
        $weddingTime = (new WeddingTime())->where('id', $booking['wedding_time_id'])->first();

        return view('member/pages/payment/form', compact('booking', 'product', 'subProduct', 'weddingTime'));
    }

    public function store($productId, $subProductId, $bookingId)
    {
        $validator = $this->validator();

        if (!$validator->run($this->request->getVar())) {
            return redirect()->back()->withInput()->with('errors', $validator->getErrors());
        }

        $image     = $this->request->getFile('proof');
        $imageName = str_random(40) . '.' . $image->getClientExtension();

        $image->move(ROOTPATH . 'public/uploads/images/payments', $imageName);

        $payment = new Payment();
        $payment->insert(array_merge($this->request->getVar(), [
            "status"     => Payment::STATUS_DOWN_PAYMENT,
            "proof"      => $imageName,
            "booking_id" => $bookingId,
        ]));

        (new Booking())->update($bookingId, [
            "payment_status" => Booking::STATUS_DOWN_PAYMENT,
        ]);

        return redirect()->to(route_to('member.payments.edit', $productId, $subProductId, $bookingId))->with('success', 'Pembayaran berhasil dilakukan');
    }

    public function validator()
    {
        $validator = \Config\Services::validation();
        $validator->setRules([
            'proof' => [
                'rules' => 'uploaded[proof]|mime_in[proof,image/png,image/jpg,image/jpeg]',
            ],
            'sender_bank' => [
                'rules' => 'required',
            ],
            'sender_account_number' => [
                'rules' => 'required',
            ],
            'merchant_bank' => [
                'rules' => 'required',
            ],
            'sender_name' => [
                'rules' => 'required',
            ],
        ]);

        return $validator;
    }
}
