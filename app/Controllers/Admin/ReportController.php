<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Payment;

class ReportController extends BaseController
{
    public function index()
    {
        $incomes = $this->incomes();

        return view('admin/pages/report/index', compact('incomes'));
    }

    public function print()
    {
        $incomes = $this->incomes();

        return view('admin/pages/report/print', compact('incomes'));
    }

    private function incomes()
    {
        if ($this->request->getVar('from_date') && $this->request->getVar('to_date')) {

            $fromDate = $this->request->getVar('from_date');
            $toDate   = $this->request->getVar('to_date');

            $incomes = (new Payment())->where('status', Payment::STATUS_PAID_OFF)
                ->where('DATE(created_at) >=', $fromDate)
                ->where('DATE(created_at) <=', $toDate)->findAll();
        } else {
            $incomes = (new Payment())->where('status', Payment::STATUS_PAID_OFF)->findAll();
        }

        return $incomes;
    }
}
