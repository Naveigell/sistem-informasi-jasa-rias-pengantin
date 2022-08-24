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
        if ($this->request->getVar('month')) {
            $month = explode('-', $this->request->getVar('month'))[1];
            $year  = explode('-', $this->request->getVar('month'))[0];

            $incomes = (new Payment())->where('status', Payment::STATUS_PAID_OFF)
                ->where('MONTH(created_at)', $month)
                ->where('YEAR(created_at)', $year)->findAll();
        } else {
            $incomes = (new Payment())->where('status', Payment::STATUS_PAID_OFF)->findAll();
        }

        return $incomes;
    }
}
