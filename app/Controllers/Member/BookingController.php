<?php

namespace App\Controllers\Member;

use App\Controllers\BaseController;

class BookingController extends BaseController
{
    public function store()
    {
        dd($this->request->getVar());
    }
}
