<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Gallery;

class GalleryController extends BaseController
{
    public function index()
    {
        $galleries = (new Gallery())->findAll();

        return view('admin/pages/gallery/index', compact('galleries'));
    }

    public function create()
    {
        return view('admin/pages/gallery/form');
    }

    public function store()
    {
        $validator = $this->validator();

        if (!$validator->run($this->request->getVar())) {
            return redirect()->back()->withInput()->with('errors', $validator->getErrors());
        }

        $image     = $this->request->getFile('image');
        $imageName = str_random(40) . '.' . $image->getClientExtension();

        $image->move(ROOTPATH . 'public/uploads/images/galleries', $imageName);

        try {
            (new Gallery())->insert([
                "media" => $imageName,
            ]);
        } catch (\ReflectionException $e) {
            var_dump($e->getMessage());
        }

        return redirect()->route('admin.galleries.index')->withInput()->with('success', 'Media berhasil ditambahkan');
    }

    public function destroy($id)
    {
        (new Gallery())->delete($id);

        return redirect()->route('admin.galleries.index')->withInput()->with('success', 'Media berhasil dihapus');
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
