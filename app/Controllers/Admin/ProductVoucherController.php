<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Product;
use App\Models\SubProduct;
use App\Models\SubProductVoucher;

class ProductVoucherController extends BaseController
{
    public function index($productId, $subProductId)
    {
        $vouchers = (new SubProductVoucher())->where('product_id', $productId)
                                             ->where('sub_product_id', $subProductId)
                                             ->findAll();

        return view('admin/pages/product_voucher/index', compact('vouchers', 'productId', 'subProductId'));
    }

    public function create($productId, $subProductId)
    {
        $product    = (new Product())->where('id', $productId)->first();
        $subProduct = (new SubProduct())->where('id', $subProductId)->where('product_id', $productId)->first();

        return view('admin/pages/product_voucher/form', compact('product', 'subProduct'));
    }

    public function store($productId, $subProductId)
    {
        $validator = $this->validator();

        if (!$validator->run($this->request->getVar())) {
            return redirect()->back()->withInput()->with('errors', $validator->getErrors());
        }

        (new SubProductVoucher())->insert(array_merge($this->request->getVar(), [
            "product_id"     => $productId,
            "sub_product_id" => $subProductId,
        ]));

        return redirect()->route('admin.product-vouchers.index', [$productId, $subProductId])->withInput()->with('success', 'Voucher berhasil dibuat');
    }

    public function edit($productId, $subProductId, $voucherId)
    {
        $product    = (new Product())->where('id', $productId)->first();
        $subProduct = (new SubProduct())->where('id', $subProductId)->where('product_id', $productId)->first();
        $voucher    = (new SubProductVoucher())->where('id', $voucherId)->where('product_id', $productId)->where('sub_product_id', $subProductId)->first();

        return view('admin/pages/product_voucher/form', compact('product', 'subProduct', 'voucher'));
    }

    public function update($productId, $subProductId, $voucherId)
    {
        $validator = $this->validator();

        if (!$validator->run($this->request->getVar())) {
            return redirect()->back()->withInput()->with('errors', $validator->getErrors());
        }

        (new SubProductVoucher())->update($voucherId, [
            "amount" => $this->request->getVar('amount'),
        ]);

        return redirect()->route('admin.product-vouchers.index', [$productId, $subProductId])->withInput()->with('success', 'Voucher berhasil diubah');
    }

    public function destroy($productId, $subProductId, $voucherId)
    {
        (new SubProductVoucher())->delete($voucherId);

        return redirect()->route('admin.product-vouchers.index', [$productId, $subProductId])->withInput()->with('success', 'Voucher berhasil dihapus');
    }

    private function validator()
    {
        $validator = \Config\Services::validation();
        $validator->setRules([
            "code" => [
                "rules" => "required",
            ],
            "amount" => [
                "rules" => "required",
            ]
        ]);

        return $validator;
    }
}
