<?php

namespace App\Controllers\Member;

use App\Controllers\BaseController;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\Product;
use App\Models\SubProduct;
use App\Models\WeddingTime;
use CodeIgniter\I18n\Time;

class BookingController extends BaseController
{
    public function index($productId, $subProductId)
    {
        $product            = (new Product())->where('id', $productId)->first();
        $subProduct         = (new SubProduct())->where('id', $subProductId)->where('product_id', $productId)->first();
        $weddingTimes       = (new WeddingTime())->findAll();
        $products           = (new Product())->findAll();
        $available          = false;
        $hasQueryParameters = false;

        $weddingDate   = $this->request->getVar('wedding_date');
        $productId     = $this->request->getVar('product_id');
        $weddingTimeId = $this->request->getVar('wedding_time_id');
        $subProductId  = $this->request->getVar('sub_product_id');

        if (!empty($weddingDate) &&
            !empty($weddingTimeId) &&
            !empty($productId) &&
            !empty($subProductId)) {

            $available = (new Booking())->where('product_id', $productId)->where('DATE(wedding_date)', date('Y-m-d', strtotime($weddingDate)))
                                        ->where('is_expired', 0)
                                        ->where('wedding_time_id', $weddingTimeId)->where('sub_product_id', $subProductId)->countAllResults() <= 0;
            $hasQueryParameters = true;
        }

        return view('member/pages/booking/form', compact('subProduct', 'product', 'weddingTimes', 'products', 'available', 'hasQueryParameters'));
    }

    public function store($productId, $subProductId)
    {
        $validator = $this->validator();

        if (!$validator->run($this->request->getVar())) {
            $queryString = http_build_query([
                "sub_product_id"  => $subProductId,
                "product_id"      => $productId,
                "wedding_time_id" => $this->request->getVar('wedding_time_id'),
                "wedding_date"    => $this->request->getVar('wedding_date'),
            ]);

            return redirect()->to(route_to('member.booking.index', $productId, $subProductId) . '?' . $queryString)->withInput()->with('errors', $validator->getErrors());
        }

        $bookingId = (new Booking());
        $bookingId->insert(array_merge($this->request->getVar(), [
            "user_id"          => session()->get('user')->id,
            "payment_status"   => Payment::STATUS_WAITING_PAYMENT,
            "pre_wedding_date" => date('Y-m-d', strtotime($this->request->getVar('pre_wedding_date'))),
            "expired_at"       => Time::now()->addDays(2)->toDateTimeString(),
        ]));

        return redirect()->to(route_to('member.payments.edit', $productId, $subProductId, $bookingId->getInsertID()))->with('success', 'Pemesanan berhasil dilakukan');
    }

    private function validator()
    {
        $validator = \Config\Services::validation();
        $validator->setRules([
            "name" => [
                "rules" => "required",
            ],
            "address" => [
                "rules" => "required",
            ],
            "phone" => [
                "rules" => "required",
            ],
            "identity_card" => [
                "rules" => "required",
            ],
            "wedding_date" => [
                "rules" => "required",
            ],
            "wedding_time_id" => [
                "rules" => "required",
            ],
            "pre_wedding_date" => [
                "rules" => "required",
            ],
        ]);

        return $validator;
    }
}
