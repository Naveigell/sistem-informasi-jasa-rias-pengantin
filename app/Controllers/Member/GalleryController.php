<?php

namespace App\Controllers\Member;

use App\Controllers\BaseController;
use App\Models\Gallery;

class GalleryController extends BaseController
{
    public function index()
    {
        $galleries = (new Gallery())->findAll();

        return view('member/pages/gallery/index', compact('galleries'));
    }
}
