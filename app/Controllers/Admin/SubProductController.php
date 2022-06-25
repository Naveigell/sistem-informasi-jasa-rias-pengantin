<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Product;
use App\Models\SubProduct;

class SubProductController extends BaseController
{
    public function index($productId)
    {
        $subProducts = (new SubProduct())->where('product_id', $productId)->findAll();

        return view('admin/pages/subproduct/index', compact('subProducts', 'productId'));
    }

    public function create($productId)
    {
        $product = (new Product())->where('id', $productId)->first();

        return view('admin/pages/subproduct/form', compact('product'));
    }

    public function store($productId)
    {
        $validator = $this->validator();

        if (!$validator->run($this->request->getVar())) {
            return redirect()->back()->withInput()->with('errors', $validator->getErrors());
        }

        try {
            (new SubProduct())->insert(array_merge($this->request->getVar(), [
                "slug"       => str_slug($this->request->getVar('name')),
                "product_id" => $productId,
            ]));
        } catch (\ReflectionException $e) {
            var_dump($e->getMessage());
        }

        return redirect()->route('admin.sub-products.index', [$productId])->withInput()->with('success', 'Sub Jasa berhasil ditambah');
    }

    public function edit($productId, $subProductId)
    {
        $product    = (new Product())->where('id', $productId)->first();
        $subProduct = (new SubProduct())->where('id', $subProductId)->where('product_id', $productId)->first();

        return view('admin/pages/subproduct/form', compact('product', 'subProduct'));
    }

    public function update($productId, $subProductId)
    {
        $validator = $this->validator();

        if (!$validator->run($this->request->getVar())) {
            return redirect()->back()->withInput()->with('errors', $validator->getErrors());
        }

        (new SubProduct())->update($subProductId, array_merge($this->request->getVar(), [
            "slug" => str_slug($this->request->getVar('name')),
        ]));

        return redirect()->route('admin.sub-products.index', [$productId])->withInput()->with('success', 'Sub Jasa berhasil diubah');
    }

    public function destroy($productId, $subProductId)
    {
        (new SubProduct())->delete($subProductId);

        return redirect()->route('admin.sub-products.index', [$productId])->withInput()->with('success', 'Sub Jasa berhasil dihapus');
    }

    private function validator()
    {
        $validator = \Config\Services::validation();
        $validator->setRules([
            "name" => [
                "rules" => "required",
            ],
            "price" => [
                "rules" => "required",
            ],
            "description" => [
                "rules" => "required",
            ]
        ]);

        return $validator;
    }
}
