<?php

namespace App\Controllers\Member;

use App\Controllers\BaseController;
use App\Models\User;

class AccountController extends BaseController
{
    public function index()
    {
        $user = (new User())->where('id', session()->get('user')->id)->first();

        return view('member/pages/account/index', compact('user'));
    }

    public function password()
    {
        $validator = \Config\Services::validation();
        $validator->setRules([
            "old_password" => [
                'rules' => 'required',
            ],
            "new_password" => [
                'rules' => 'required',
            ],
            "repeat_new_password" => [
                'rules' => 'required',
            ],
        ]);

        if (!$validator->run($this->request->getVar())) {
            return redirect()->back()->withInput()->with('errors', $validator->getErrors());
        }

        if (!password_verify($this->request->getVar('old_password'), session()->get('user')->password)) {
            $validator->setError('password', 'Old password not match');

            return redirect()->back()->withInput()->with('errors', $validator->getErrors());
        }

        if ($this->request->getVar('new_password') != $this->request->getVar('repeat_new_password')) {
            $validator->setError('password', 'New password and repeat new password do not match');

            return redirect()->back()->withInput()->with('errors', $validator->getErrors());
        }

        (new User())->update(session()->get('user')->id, [
            "password" => password_hash($this->request->getVar('new_password'), PASSWORD_DEFAULT),
        ]);

        return redirect()->route('member.accounts.index')->with('success', 'Berhasil mengubah password');
    }
}
