<?php

namespace App\Controllers\Member;

use App\Controllers\BaseController;
use App\Models\Booking;
use App\Models\Product;
use App\Models\SubProduct;
use App\Models\WeddingTime;

class ProductController extends BaseController
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
                                        ->where('wedding_time_id', $weddingTimeId)->where('sub_product_id', $subProductId)->countAllResults() <= 0;
            $hasQueryParameters = true;
        }

        return view('member/pages/product/index', compact('subProduct', 'product', 'weddingTimes', 'products', 'available', 'hasQueryParameters'));
    }
}
