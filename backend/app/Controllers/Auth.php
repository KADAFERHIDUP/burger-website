<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        if (session()->get('admin')) {
            return redirect()->to(site_url('admin'));
        }

        return view('auth/login', ['title' => 'Login Admin']);
    }

    public function attempt()
    {
        $rules = [
            'email'    => 'required|valid_email',
            'password' => 'required',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Isi email dan password dengan benar.');
        }

        $user = (new UserModel())->where('email', $this->request->getPost('email'))->first();

        if ($user === null || ! password_verify((string) $this->request->getPost('password'), $user['password_hash'])) {
            return redirect()->back()->withInput()->with('error', 'Email atau password salah.');
        }

        session()->regenerate();
        session()->set('admin', ['id' => $user['id'], 'name' => $user['name']]);

        return redirect()->to(site_url('admin'));
    }

    public function logout()
    {
        session()->remove('admin');

        return redirect()->to(site_url('admin/login'))->with('success', 'Kamu sudah logout.');
    }
}
