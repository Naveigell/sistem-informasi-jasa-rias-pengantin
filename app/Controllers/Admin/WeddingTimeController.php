<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\WeddingTime;

class WeddingTimeController extends BaseController
{
    public function index()
    {
        $weddingTimes = (new WeddingTime())->findAll();

        return view('admin/pages/wedding_time/index', compact('weddingTimes'));
    }

    public function create()
    {
        return view('admin/pages/wedding_time/form');
    }

    public function store()
    {
        $validator = $this->validator();

        if (!$validator->run($this->request->getVar())) {
            return redirect()->back()->withInput()->with('errors', $validator->getErrors());
        }

        (new WeddingTime())->insert($this->request->getVar());

        return redirect()->route('admin.wedding-times.index')->withInput()->with('success', 'Jam Rias berhasil ditambah');
    }

    public function edit($weddingTimeId)
    {
        $weddingTime = (new WeddingTime())->where('id', $weddingTimeId)->first();

        return view('admin/pages/wedding_time/form', compact('weddingTime'));
    }

    public function update($weddingTimeId)
    {
        $validator = $this->validator();

        if (!$validator->run($this->request->getVar())) {
            return redirect()->back()->withInput()->with('errors', $validator->getErrors());
        }

        (new WeddingTime())->update($weddingTimeId, $this->request->getVar());

        return redirect()->route('admin.wedding-times.index')->withInput()->with('success', 'Jam Rias berhasil diubah');
    }

    public function destroy($weddingTimeId)
    {
        (new WeddingTime())->delete($weddingTimeId);

        return redirect()->route('admin.wedding-times.index')->withInput()->with('success', 'Jam Rias berhasil dihapus');
    }

    private function validator()
    {
        $validator = \Config\Services::validation();
        $validator->setRules([
            "wedding_time" => [
                "rules" => "required",
            ]
        ]);

        return $validator;
    }
}
