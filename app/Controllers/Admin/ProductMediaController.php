<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProductMedia;

class ProductMediaController extends BaseController
{
    public function index($productId, $subProductId)
    {
        $medias = (new ProductMedia())->where('product_id', $productId)->where('sub_product_id', $subProductId)->findAll();

        return view('admin/pages/product_media/index', compact('medias', 'productId', 'subProductId'));
    }

    public function create($productId, $subProductId)
    {
        return view('admin/pages/product_media/form', compact('productId', 'subProductId'));
    }

    public function store($productId, $subProductId)
    {
        $validator = $this->validator();

        if (!$validator->run($this->request->getVar())) {
            return redirect()->back()->withInput()->with('errors', $validator->getErrors());
        }

        $image     = $this->request->getFile('image');
        $imageName = str_random(40) . '.' . $image->getClientExtension();

        $image->move(ROOTPATH . 'public/uploads/images/products', $imageName);

        try {
            (new ProductMedia())->insert([
                "media"          => $imageName,
                "type"           => ProductMedia::TYPE_IMAGE,
                "product_id"     => $productId,
                "sub_product_id" => $subProductId,
            ]);
        } catch (\ReflectionException $e) {
            var_dump($e->getMessage());
        }

        return redirect()->route('admin.product-medias.index', [$productId, $subProductId])->withInput()->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit($productId, $subProductId, $mediaId)
    {
        $media = (new ProductMedia())->where('id', $mediaId)->first();

        return view('admin/pages/product_media/form', compact('productId', 'subProductId', 'media'));
    }

    public function update($productId, $subProductId, $mediaId)
    {
        $validator = $this->validator();

        if (!$validator->run($this->request->getVar())) {
            return redirect()->back()->withInput()->with('errors', $validator->getErrors());
        }

        $image     = $this->request->getFile('image');
        $imageName = str_random(40) . '.' . $image->getClientExtension();

        $image->move(ROOTPATH . 'public/uploads/images/products', $imageName);

        (new ProductMedia())->update($mediaId, [
            "media"          => $imageName,
            "type"           => ProductMedia::TYPE_IMAGE,
            "product_id"     => $productId,
            "sub_product_id" => $subProductId,
        ]);

        return redirect()->route('admin.product-medias.index', [$productId, $subProductId])->withInput()->with('success', 'Produk berhasil diubah');
    }

    public function destroy($productId, $subProductId, $mediaId)
    {
        (new ProductMedia())->delete($mediaId);

        return redirect()->route('admin.product-medias.index', [$productId, $subProductId])->withInput()->with('success', 'Produk berhasil diubah');
    }

    private function validator()
    {
        $validator = \Config\Services::validation();
        $validator->setRules([
            "image" => [
                "rules" => "uploaded[image]|mime_in[image,image/png,image/jpg,image/jpeg]",
            ]
        ]);

        return $validator;
    }
}
