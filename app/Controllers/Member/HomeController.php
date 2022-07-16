<?php

namespace App\Controllers\Member;

use App\Controllers\BaseController;
use App\Models\Booking;
use App\Models\Product;
use App\Models\SubProduct;
use App\Models\WeddingTime;

class HomeController extends BaseController
{
    public function index()
    {
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

        $discountSubProducts = (new SubProduct())->where('discount IS NOT NULL', null, false)->limit(3)->findAll();

        return view('member/pages/home/index', compact('weddingTimes', 'products', 'available', 'hasQueryParameters', 'discountSubProducts'));
    }
}
