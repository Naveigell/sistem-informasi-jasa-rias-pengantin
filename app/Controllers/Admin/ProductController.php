<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Product;

class ProductController extends BaseController
{
    public function index()
    {
        $products = (new Product())->findAll();

        return view('admin/pages/product/index', compact('products'));
    }

    public function create()
    {
        return view('admin/pages/product/form');
    }

    public function store()
    {
        $validator = $this->validator();

        if (!$validator->run($this->request->getVar())) {
            return redirect()->back()->withInput()->with('errors', $validator->getErrors());
        }

        (new Product())->insert(array_merge($this->request->getVar(), [
            "slug" => str_slug($this->request->getVar('name')),
        ]));

        return redirect()->route('admin.products.index')->withInput()->with('success', 'Jasa berhasil ditambah');
    }

    public function edit($productId)
    {
        $product = (object) (new Product())->where('id', $productId)->first();

        return view('admin/pages/product/form', compact('product'));
    }

    public function update($productId)
    {
        $validator = $this->validator();

        if (!$validator->run($this->request->getVar())) {
            return redirect()->back()->withInput()->with('errors', $validator->getErrors());
        }

        try {
            (new Product())->update($productId, array_merge($this->request->getVar(), [
                "slug" => str_slug($this->request->getVar('name')),
            ]));
        } catch (\ReflectionException $e) {
            var_dump($e->getMessage());
        }

        return redirect()->route('admin.products.index')->withInput()->with('success', 'Jasa berhasil diubah');
    }

    public function destroy($productId)
    {
        (new Product())->delete($productId);

        return redirect()->route('admin.products.index')->withInput()->with('success', 'Jasa berhasil dihapus');
    }

    private function validator()
    {
        $validator = \Config\Services::validation();
        $validator->setRules([
            "name" => [
                "rules" => "required",
            ]
        ]);

        return $validator;
    }
}
